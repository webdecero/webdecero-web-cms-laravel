<?php

namespace Webdecero\Webcms\Controllers\Settings;

use Exception;
use Throwable;
use Validator;
use Illuminate\Http\Request;
use Webdecero\Webcms\Schemas\IdentitySchema;
use Webdecero\Webcms\Traits\ResponseApi;
use Webdecero\Webcms\Models\Settings\Settings;
use Illuminate\Support\Facades\Log;
use Webdecero\Webcms\Controllers\Controller;

class SideBarController extends Controller
{
    use ResponseApi;

    private $_basePath = '';

    public function __construct()
    {
        $this->_basePath = config('cms.base_path');
    }

    public function show(Request $request)
    {
        try {
            $settings = Settings::first();
            if (empty($settings)) throw new Exception('Configuraciones no encontradas', 404);
            
            $sideBar = $settings->sideBar;
            
            return $this->sendResponse($sideBar, 'SideBar');
        } catch (Exception $th) {

            return $this->sendError('SideBarController Update', $th->getMessage(), $th->getCode());
        }
    }

    public function update(Request $request)
    {
        try {
            $input = $request->all();
            $rules = [
                'logo' => 'required|string',
                'color' => 'required|string'
            ];
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) return $this->sendError('Error de validación', $validator->errors()->all(), 422);

            $settings = Settings::first();
            if (empty($settings)) throw new Exception('Configuraciones no encontradas', 404);
            
            $sideBar = new IdentitySchema($input['logo'],$input['color']);
            $settings->sideBar = $sideBar;
            $settings->save();
            
            return $this->sendResponse($sideBar, 'SideBar actualizado');
        } catch (Exception $th) {

            return $this->sendError('SideBarController Update', $th->getMessage(), $th->getCode());
        }
    }

}