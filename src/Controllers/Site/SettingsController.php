<?php

namespace Webdecero\Webcms\Controllers\Site;

use Exception;
use Throwable;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Webdecero\Webcms\Models\Site\Site;
use Webdecero\Webcms\Traits\ResponseApi;
use Webdecero\Webcms\Schemas\SettingsSchema;
use Webdecero\Webcms\Controllers\Controller;

class SettingsController extends Controller
{
    use ResponseApi;

    public function show(Request $request)
    {
        try {
            
            $site = Site::first();
            if (empty($site)) throw new Exception('Sitio no encontrado', 404);
            
            $settings = $site->settings;
            
            return $this->sendResponse($settings, 'Settings');
        } catch (Exception $th) {

            return $this->sendError('SettingsController Show', $th->getMessage(), $th->getCode());
        }
    }

    public function update(Request $request)
    {
        try {
            
            $input = $request->all();
            $rules = [
                'name' => 'required|string',
                'urlBase' => 'required|string',
                'lang' => 'required|string',
                'robots' => 'string',
                'favicon' => 'string'
            ];
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) return $this->sendError('Error de validación', $validator->errors()->all(), 422);
            
            $site = Site::first();
            if (empty($site)) throw new Exception('Sitio no encontrado', 404);
            
            $settings = new SettingsSchema($input['name'], $input['urlBase'], $input['lang'], $input['robots'], $input['favicon']);
            $site->settings = $settings;
            $site->save();
            
            return $this->sendResponse($settings, 'Se ha actualizado');
        } catch (Exception $th) {

            return $this->sendError('SettingsController Update', $th->getMessage(), $th->getCode());
        }
    }

}