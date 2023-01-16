<?php

namespace Webdecero\Webcms\Controllers\Images;

//Providers

//Models
//Helpers and Class

// use Illuminate\Filesystem\Filesystem;
use Validator;
use Webdecero\Webcms\Models\Image;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use Webdecero\Webcms\Disk\DynamicDisk;
use Illuminate\Support\Facades\Storage;
use Webdecero\Webcms\Controllers\Utilities\ToolsController;
use Webdecero\Webcms\Controllers\Manager\ManagerController;
use Intervention\Image\Facades\Image as InterventionImage;


class ImagesController extends ManagerController
{
    public function search(Request $request)
    {
        try {
            $paginate = (int)$request->get('item', 25);

            $query = $request->input('query', null);
            $initDate = $request->input('initDate', null);
            $endDate = $request->input('endDate', null);

            $queryMongo = [];

            if (!empty($query)) {

                $queryMongo['$or'] = [
                    [
                        "name" => ['$regex' => "$query", '$options' => 'i']
                    ]
                ];
            }
            if (!empty($initDate)) {


                $queryMongo['$and'][]
                    = [
                        'created_at' => [
                            '$gte' => new UTCDateTime(new Carbon($initDate)),
                        ]
                    ];
            }
            if (!empty($endDate)) {

                $queryMongo['$and'][]
                    = [
                        'created_at' => [
                            '$lt' => new UTCDateTime(Carbon::parse($endDate)->addHour(23)),
                        ]
                    ];
            }

            if (!empty($queryMongo)) {
                $images = Image::whereRaw($queryMongo)->orderBy('_id', 'desc')->paginate($paginate);
            } else {
                $images = Image::orderBy('_id', 'desc')->paginate($paginate);
            }
            return $this->sendResponse($images, 'Images');
        } catch (Exception $th) {

            return $this->sendError('ImagesController Index', $th->getMessage(), $th->getCode());
        }
    }

    public function show(Request $request, $id)
    {
        try {
            
            $image = Image::where('_id', $id)->first();
            if(empty($image)) throw new Exception('Image no encontrada', 404);
            
            return $this->sendResponse($image, 'Image encontrada');
        } catch (Exception $th) {

            return $this->sendError('ImagesController Index', $th->getMessage(), $th->getCode());
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            
            $image = Image::where('_id', $id)->first();
            if(empty($image)) throw new Exception('Image no encontrada', 404);

            $tools = resolve(ToolsController::class);
            
            $tools->removeFile($image->pathFile);
            $tools->removeFile($image->thumbPathFile);
            $image->delete();
            
            return $this->sendResponse($image, 'Image eliminada');
        } catch (Exception $th) {

            return $this->sendError('ImagesController Index', $th->getMessage(), $th->getCode());
        }
    }

    public function store(Request $request)
    {

        try {

            $input = $request->all();

            $rules = [
                'name' => 'required|string',
                'thumbName' => 'required|string',
                'originalName' => 'required|string',
                'alt' => 'required|string',
                'title' => 'required|string',
                'extension' => 'required|string',
                'orientation' => 'required|string',
                'format' => 'required|string',
                'isPublic' => 'required|boolean'
            ];
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) return $this->sendError('Error de validación', $validator->errors()->all(), 422);

            
            $input['folder']  = $request->input('folder', 'uploads/assets/img');
            $input['quality'] = $request->input('quality', 100);
            $input['resize']  = $request->input('resize', 'widen');
            //$input['disk']  = $request->input('disk', 'webcms');


            $img = InterventionImage::make($input['image']);
            $input['width'] = $img->width();
            $input['height'] = $img->height();

            $img = $this->_getImageResize($img, $input['resize'], $input['width'], $input['height']);


            $widenThumbnail = $this->_getPercentage($input['width'], 30);
            $heightThumbnail = $this->_getPercentage($input['height'], 30);

            $imgThumbnail  =  $this->_getImageResize(clone $img, 'widen', $widenThumbnail, $heightThumbnail);

            $fileData = (string) $img->encode($input['format'], (int)$input['quality']);
            $fileDataThumbnail = (string) $imgThumbnail->encode($input['format'], (int)$input['quality']);

            $path = $this->_getPath($input['name'], $input['folder'], $input['format']);
            $pathThumb = $this->_getPath($input['thumbName'], $input['folder'] . DIRECTORY_SEPARATOR . 'thumb', $input['format']);

            
            
            if (empty($input['disk'])) {
                $input['disk'] = 'webcms';
                $dynamicDisk = new DynamicDisk();
                $disk = $dynamicDisk->createDisk();

                $isSave = $disk->put($path, $fileData);
                $disk->put($pathThumb, $fileDataThumbnail);

                $path = 'storage-webcms/' . $path;
                $pathThumb = 'storage-webcms/' . $pathThumb;
            }
            else {
               
                $isSave = Storage::disk($input['disk'])->put($path, $fileData);
                Storage::disk($input['disk'])->put($pathThumb, $fileDataThumbnail);

                $path = 'storage/' . $path;
                $pathThumb = 'storage/' . $pathThumb;
            }

            if (!$isSave) throw new Exception('Error al guardar imagen', 500);
            
            $input['size'] = filesize($path);

            $image = Image::where('originalName', $input['originalName'])->first();
            
            if(empty($image)) $image = new Image();
            
            $image->fill($input);
            $image->pathFile = $path;
            $image->thumbPathFile = $pathThumb;
            $image->save();


            return $this->sendResponse($image, "ImageController image");
        } catch (Exception $e) {
            return $this->sendError('ImagesController store', $e->getMessage(), $e->getCode());
        }
    }

    public function update(Request $request, $id)
    {
        try {

            $input = $request->all();
            $rules = [
                'title' => 'required|string',
                'alt' => 'required|string',
                'image' => 'required|image'
            ];
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) return $this->sendError('Error de validación', $validator->errors()->all(), 422);
            
            $image = Image::where('_id', $id)->first();
            if(empty($image)) throw new Exception('Image no encontrada', 404);

            $input['resize']  = $request->input('resize', $image->resize);
            $input['width']  = $request->input('width', $image->width);
            $input['height']  = $request->input('height', $image->height);
            $input['quality'] = $request->input('quality', $image->quality);
            $input['format']  = $request->input('format', $image->format);
            $input['disk']  = $request->input('disk', 'public');

            $img = InterventionImage::make($input['image']);
            $img = $this->_getImageResize($img, $input['resize'], $input['width'], $input['height']);

            $widenThumbnail = $this->_getPercentage($input['width'], 30);
            $heightThumbnail = $this->_getPercentage($input['height'], 30);

            $imgThumbnail  =  $this->_getImageResize(clone $img, 'widen', $widenThumbnail, $heightThumbnail);

            $fileData = (string) $img->encode($input['format'], (int)$input['quality']);
            $fileDataThumbnail = (string) $imgThumbnail->encode($input['format'], (int)$input['quality']);

            $pathClean = str_replace('storage/', '', $image->path);
            $pathThumbClean = str_replace('storage/', '', $image->pathThumb);

            $isSave = Storage::disk($input['disk'])->put($pathClean, $fileData);
            Storage::disk($input['disk'])->put($pathThumbClean, $fileDataThumbnail);

            if (!$isSave) throw new Exception('Error al guardar imagen', 500);
            $image->fill($input);
            $image->save();

            return $this->sendResponse($image, 'Image actualizada');
        } catch (Exception $th) {

            return $this->sendError('ImagesController Index', $th->getMessage(), $th->getCode());
        }
    }

    private function _getTemporalFile($input, $fSetup)
    {
        $tmpImage = (string) InterventionImage::make($input['image'])->encode($input['format']);
        fwrite($fSetup, $tmpImage);
        $path = stream_get_meta_data($fSetup)['uri'];
        $file =  new File($path);
        return $file;
    }

    public function uploadImageBase64(Request $request)
    {

        try {

            $input = $request->all();

            $rules = [
                'name' => 'required|string',
                'thumbName' => 'required|string',
                'originalName' => 'required|string',
                'alt' => 'required|string',
                'title' => 'required|string',
                'extension' => 'required|string',
                'width' => 'required|numeric',
                'height' => 'required|numeric',
                'orientation' => 'required|string',
                'format' => 'required|string',
                'isPublic' => 'required|boolean'
            ];
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) return $this->sendError('Error de validación', $validator->errors()->all(), 422);

            
            $input['folder']  = $request->input('folder', 'uploads/assets/img');
            $input['quality'] = $request->input('quality', 100);
            $input['resize']  = $request->input('resize', 'widen');

            /*$input = $request->all();

            $input['title']   = $request->input('title', '');
            $input['alt']   = $request->input('alt', '');
            $input['disk']  = $request->input('disk', 'public');
            $input['folder']  = $request->input('folder', 'images');
            $input['quality'] = $request->input('quality', 100);
            $input['format']  = $request->input('format', 'jpg');
            $input['resize']  = $request->input('resize', 'widen');
            $input['isTemp']  = $request->input('isTemp', true);

            $input['isSave']  = $request->input('isSave', true);


            $rules = [
                'image' => ['required'],
                'resize ' => [Rule::in([false, 'fit', 'widen', 'heighten', 'resize'])],
                'format' => ['required'],
                'quality' => ['between:1,100'],
                'width' => ['required', 'min:1'],
                'height' => ['required', 'min:1']
            ];*/

            $tmpInputImage = $input['image'];
            if (isset($input['backRules']) && is_array($input['backRules'])) {

                $backRulesImage = array_column($input['backRules'], 'value');

                $rules['image']  = array_merge($rules['image'], $backRulesImage);

                $fSetup = tmpfile();
                $input['image']  = $this->_getTemporalFile($input, $fSetup);
            }


            /*$validator = Validator::make($input, $rules);

            if ($validator->fails())  return $this->sendError('Validator', $validator->errors()->all(), 422);*/

            $input['image'] = $tmpInputImage;


            $image = $this->_makeImage($input);
            //if ($input['isSave'])
            $image->save();


            return $this->sendResponse($image, "ImageController uploadImageBase64");
        } catch (Exception $e) {
            return $this->sendError('ImageController store', $e->getMessage(), $e->getCode());
        }
    }


    private function _makeImage($input)
    {

        try {

            $img = InterventionImage::make($input['image']);
            
            if ($input['resize'] != false)
                $img = $this->_getImageResize($img, $input['resize'], $input['width'], $input['height']);



            $widenThumbnail = $this->_getPercentage($input['width'], 30);
            $heightThumbnail = $this->_getPercentage($input['height'], 30);

            $imgThumbnail  =  $this->_getImageResize(clone $img, 'widen', $widenThumbnail, $heightThumbnail);

            $fileData = (string) $img->encode($input['format'], (int)$input['quality']);
            $fileDataThumbnail = (string) $imgThumbnail->encode($input['format'], (int)$input['quality']);

            //$nameFile = $this->_generateName();

            $path = $this->_getPath($input['name'], $input['folder'], $input['format']);
            $pathThumb = $this->_getPath($input['thumbName'], $input['folder'] . DIRECTORY_SEPARATOR . 'thumb', $input['format']);

            /*$isSave = Storage::disk($input['disk'])->put($path, $fileData);
            Storage::disk($input['disk'])->put($pathThumb, $fileDataThumbnail);


            if ($input['disk'] == 'public') $path = 'storage/' . $path;
            if ($input['disk'] == 'public') $pathThumb = 'storage/' . $pathThumb;

            if (!$isSave) throw new Exception(trans('webcms::storage.notstorage'), 500);*/
            if (empty($input['disk'])) {
                $input['disk'] = 'webcms';
                $dynamicDisk = new DynamicDisk();
                $disk = $dynamicDisk->createDisk();

                $isSave = $disk->put($path, $fileData);
                $disk->put($pathThumb, $fileDataThumbnail);

                $path = 'storage-webcms/' . $path;
                $pathThumb = 'storage-webcms/' . $pathThumb;
            }
            else {
               
                $isSave = Storage::disk($input['disk'])->put($path, $fileData);
                Storage::disk($input['disk'])->put($pathThumb, $fileDataThumbnail);

                $path = 'storage/' . $path;
                $pathThumb = 'storage/' . $pathThumb;
            }

            if (!$isSave) throw new Exception('Error al guardar imagen', 500);
            
            $input['size'] = filesize($path);

            $image = Image::where('originalName', $input['originalName'])->first();
            
            if(empty($image)) $image = new Image();

            $image->fill($input);
            $image->pathFile = $path;
            $image->thumbPathFile = $pathThumb;

            return $image;
        } catch (Exception $e) {
            throw $e;
        }
    }






    private function _getPath($name, $path = null, $extension = null)
    {
        if ($path) {
            $path = rtrim($path, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
        }

        $ext = (is_null($extension)) ? '' : '.' . $extension;

        return $path . $name . $ext;
    }


    private function _generateName($numBytes = 15)
    {
        $bytes = random_bytes($numBytes);
        return bin2hex($bytes);
    }

    private function _getPercentage($total, $percentage)
    {
        if ($total > 0) {
            $tmp = ($percentage / 100) * $total;
            return round($tmp, 2);
        } else {
            return 0;
        }
    }

    private function _getImageResize($img, $resize, $width, $height)
    {

        switch ($resize) {
            case 'fit':
                $img = $img->fit((int) $width, (int) $height);
                break;
            case 'widen':
                $img = $img->widen((int) $width);
                break;
            case 'heighten':
                $img = $img->heighten((int) $height);
                break;
            case 'resize':
                $img = $img->resize((int) $width, (int) $height);
                break;
        }

        return $img;
    }
}