<?php

namespace Webdecero\Webcms\Controllers\Utilities;

use Exception;
use Throwable;
use Validator;
use ZipArchive;
use Illuminate\Http\Request;
use Webdecero\Webcms\Models\Image;
use Webdecero\Webcms\Disk\DynamicDisk;
use Webdecero\Webcms\Traits\ResponseApi;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Webdecero\Webcms\Controllers\Controller;
use Intervention\Image\Facades\Image as InterventionImage;

class AssetsController extends Controller
{
    use ResponseApi;

    public function uploadAssetsZip(Request $request)
    {
        try {
            $file = $request->file('file');

            $path = "uploads/chunks/{$file->getClientOriginalName()}";
            Log::info($path);
            $content = $file->get();
            if($content == false) throw new Exception('Error de contenido', 422);

            $dynamicDisk = new DynamicDisk();
            $disk = $dynamicDisk->createDisk();
            $isSave = $disk->put($path, '');
            if (!$isSave) throw new \Exception('No storage', 500);
            $path = 'storage-webcms/'.$path;

            \File::append($path, $content);

            if ($request->has('is_last') && $request->boolean('is_last')) {
                $name = pathinfo($path, PATHINFO_FILENAME);
                $dir = pathinfo($path, PATHINFO_DIRNAME );
                //open zip
                $zip = new ZipArchive();
                $status = $zip->open($path);
                if ($status !== true) throw new Exception($this->_messageZip($status).' '.$path.' '.$message, 422);
                
                //extract zip
                $destinationPath = 'storage-webcms/uploads/assets/';
                $files = [];
                $zip->extractTo($destinationPath);
                
                for ($i = 0; $i < $zip->numFiles; $i++) {
                    $filename = $zip->getNameIndex($i);
                    array_push($files, $filename);
                }
                $zip->close();

                $delete = Storage::delete($path);

                //register images
                dispatch(function () use ($files, $destinationPath) {
                    foreach ($files as $file) {
                        $ext = pathinfo($file, PATHINFO_EXTENSION);
                        if($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg') {
                            $path = $destinationPath.$file;
                            $img = InterventionImage::make($path);
                            $data = [];
                            $name = pathinfo($file, PATHINFO_FILENAME );
                            $data['name'] = $name;
                            $data['originalName'] = $name.'.'.$ext;
                            $data['alt'] = 'Image Asset';
                            $data['title'] = 'Image';
                            $data['extension'] = $img->mime();
                            $data['width'] = $img->width();
                            $data['height'] = $img->height();
                            $data['orientation'] = 'default';
                            $data['format'] = $ext;
                            $data['isPublic'] = true;
                            $data['disk'] = 'webcms';
                            $data['size'] = $img->filesize();
                            $data['pathFile'] = $path;
                            $data['quality'] = 100;
                            $data['folder'] = 'uploads/assets/'.pathinfo($file, PATHINFO_DIRNAME);

                            $image = Image::where('originalName', $data['originalName'])->first();
                            if(empty($image)) $image = new Image();
                            $image->fill($data);
                            $image->save();
                        }
                    }
                })->afterResponse();
            }

            return $this->sendResponse(true, 'Archivo cargado al servidor');
            
        } catch (\Exception $th) {
            return $this->sendError('AssetsController uploadAssetsZip', $th->getMessage(), $th->getCode());
        }
    }

    private function _messageZip($code)
    {
        switch ($code)
            {
                case 0:
                return 'No error';
                
                case 1:
                return 'Multi-disk zip archives not supported';
                
                case 2:
                return 'Renaming temporary file failed';
                
                case 3:
                return 'Closing zip archive failed';
                
                case 4:
                return 'Seek error';
                
                case 5:
                return 'Read error';
                
                case 6:
                return 'Write error';
                
                case 7:
                return 'CRC error';
                
                case 8:
                return 'Containing zip archive was closed';
                
                case 9:
                return 'No such file';
                
                case 10:
                return 'File already exists';
                
                case 11:
                return 'Can\'t open file';
                
                case 12:
                return 'Failure to create temporary file';
                
                case 13:
                return 'Zlib error';
                
                case 14:
                return 'Malloc failure';
                
                case 15:
                return 'Entry has been changed';
                
                case 16:
                return 'Compression method not supported';
                
                case 17:
                return 'Premature EOF';
                
                case 18:
                return 'Invalid argument';
                
                case 19:
                return 'Not a zip archive';
                
                case 20:
                return 'Internal error';
                
                case 21:
                return 'Zip archive inconsistent';
                
                case 22:
                return 'Can\'t remove file';
                
                case 23:
                return 'Entry has been deleted';
                
                default:
                return 'An unknown error has occurred('.intval($code).')';
            }               
    }

    public function listFiles(Request $request)
    {
        try {
            $root = 'webcms/uploads/assets';
            $path = $request->input('path', $root);
            $folder = $request->input('folder', null);

            if($folder == '..') $path = pathinfo($path, PATHINFO_DIRNAME );

            $data = [];

            $files = Storage::files($path);
            $files = $this->_getFilesName($files);
            $dirRoot = [
                'path' => $path,
                'name' => '/',
                'files' => $files
            ];
            if($path != $root) $dirRoot['folders'] = ['..'];
            array_push($data, $dirRoot);

            $folders = Storage::directories($path);
            foreach ($folders as $folder) {
                $nameF = pathinfo($folder, PATHINFO_BASENAME );
                $foldersF = Storage::directories($folder);
                $foldersF = $this->_getFilesName($foldersF);
                $files = Storage::files($folder);
                $files = $this->_getFilesName($files);
                $directory = [
                    'path' => $folder,
                    'name' => $nameF,
                    'files' => $files,
                    'folders' => $foldersF
                ];
                array_push($data, $directory);
            }
            
            return $this->sendResponse($data, 'Lista de assets');
        } catch (\Exception $th) {
            return $this->sendError('AssetsController listFiles', $th->getMessage(), $th->getCode());
        }
    }

    private function _getFilesName($arrayPaths) 
    {
        $arrayOutput = [];
        foreach ($arrayPaths as $path) {
            $nameF = pathinfo($path, PATHINFO_BASENAME );
            array_push($arrayOutput, $nameF);
        }
        return $arrayOutput;
    }


    public function removeFolder(Request $request)
    {
        try {
            $input = $request->all();

            $rules = array(
                'path' => 'required|string'
            );

            $validator = Validator::make($input, $rules);
            if ($validator->fails()) return $this->sendError('Validator', $validator->errors()->all(), 422);
            
            $deleteImageDB =$this->_recursiveDelete($input['path']);

            $delete = Storage::deleteDirectory($input['path']);
            
            return $this->sendResponse($delete, 'Directorio eliminado');
        } catch (\Exception $th) {
            return $this->sendError('AssetsController removeFolder', $th->getMessage(), $th->getCode());
        }
    }

    private function _recursiveDelete($pathFolder)
    {
        $files = Storage::files($pathFolder);

        foreach($files as $file) {
            $ext = pathinfo($file, PATHINFO_EXTENSION);
            if($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg') {
                $this->_deleteImage($file, $ext);
            }
        }

        $folders = Storage::directories($pathFolder);
        foreach ($folders as $folder) {
            $delete = $this->_recursiveDelete($folder);
        }
        return true;
    }

    public function removeFile(Request $request)
    {
        try {
            $input = $request->all();

            $rules = array(
                'path' => 'required|string'
            );

            $validator = Validator::make($input, $rules);
            if ($validator->fails()) return $this->sendError('Validator', $validator->errors()->all(), 422);
            
            $ext = pathinfo($input['path'], PATHINFO_EXTENSION );

            if($ext == 'jpg' || $ext == 'png' || $ext == 'jpeg') {
                $this->_deleteImage($input['path'], $ext);
            }

            $delete = Storage::delete($input['path']);
            
            return $this->sendResponse(true, 'Archivo eliminado');
        } catch (\Exception $th) {
            return $this->sendError('AssetsController removeFolder', $th->getMessage(), $th->getCode());
        }
    }

    private function _deleteImage($path, $ext)
    {
        $filename = pathinfo($path, PATHINFO_FILENAME );
        $originalName = $filename.'.'.$ext;
        $image = Image::where('originalName', $originalName)->first();
        if(!empty($image)) {
            if(!empty($image->thumbPathFile)) Storage::delete($image->thumbPathFile);
            $image->delete();
        }
    }
}