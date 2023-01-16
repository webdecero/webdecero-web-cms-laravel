<?php

namespace Webdecero\Webcms\Controllers\Utilities;

use Exception;
use Throwable;
use Validator;
use Webdecero\Webcms\Disk\DynamicDisk;
use Illuminate\Http\Request;
use Webdecero\Webcms\Traits\ResponseApi;
use Illuminate\Support\Facades\Log;
use Webdecero\Webcms\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Webdecero\Webcms\Controllers\Utilities\ToolsController;

class FilesController extends Controller
{
    use ResponseApi;

    public function uploadFileJS(Request $request)
    {
        try {

            $input = $request->all();

            $rules = array(
                'file' => 'required|file',
                'fileName' => 'required',
                'folder' => 'required'
            );

            $validator = Validator::make($input, $rules);
            if ($validator->fails()) return $this->sendError('Validator', $validator->errors()->all(), 422);

            $dynamicDisk = new DynamicDisk();
            $disk = $dynamicDisk->createDisk();

            $file = $request->file('file');
            $name = $input['fileName'];
            $folder = $input['folder'].'/js';

            $path = $disk->putFileAs($folder,$file,$name);
            
            return $this->sendResponse('storage-webcms/'.$path, 'Se cargo correctamete el archivo js');
        } catch (\Throwable $th) {
            return $this->sendError('FilesController uploadFileJS', $th->getMessage(), $th->getCode());
        }
    }

    public function uploadFileCSS(Request $request)
    {
        try {

            $input = $request->all();

            $rules = array(
                'file' => 'required|file',
                'fileName' => 'required',
                'folder' => 'required'
            );


            $validator = Validator::make($input, $rules);
            if ($validator->fails()) return $this->sendError('Validator', $validator->errors()->all(), 422);

            $dynamicDisk = new DynamicDisk();
            $disk = $dynamicDisk->createDisk();

            $file = $request->file('file');
            $name = $input['fileName'];
            $folder = $input['folder'].'/css';

            $path = $disk->putFileAs($folder,$file,$name);

            return $this->sendResponse('storage-webcms/'.$path, 'Se cargo correctamete el archivo css');
        } catch (\Throwable $th) {
            return $this->sendError('FilesController uploadFileCSS', $th->getMessage(), $th->getCode());
        }
    }
}