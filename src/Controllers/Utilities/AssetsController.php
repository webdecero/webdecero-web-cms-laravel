<?php

namespace Webdecero\CMS\Controllers\Utilities;

use Exception;
use Throwable;
use Validator;
use ZipArchive;
use Illuminate\Http\Request;
use Webdecero\CMS\Traits\ResponseApi;
use Illuminate\Support\Facades\Log;
use Webdecero\CMS\Controllers\Controller;

class AssetsController extends Controller
{
    use ResponseApi;

    public function uploadAssetsZip(Request $request)
    {
        try {

            $input = $request->all();

            $rules = array(
                'zip' => 'required|file|mimes:zip'
            );

            $validator = Validator::make($input, $rules);
            if ($validator->fails()) return $this->sendError('Validator', $validator->errors()->all(), 422);

            $zip = new ZipArchive();
            $status = $zip->open($request->file("zip")->getRealPath());

            if ($status !== true) throw new Exception('Corrupted file', 422);;

            //$storageDestinationPath= storage_path("app/uploads/unzip/");
            $destinationPath = 'CMS-WDC/uploads/assets/';
            
            $zip->extractTo($destinationPath);
            $zip->close();
            
            return $this->sendResponse(true, 'Se cargo correctamete el archivo js');
        } catch (\Exception $th) {
            return $this->sendError('AssetsController uploadAssetsZip', $th->getMessage(), $th->getCode());
        }
    }
}