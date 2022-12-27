<?php

namespace Webdecero\CMS\Controllers\Site;

use Exception;
use Throwable;
use Validator;
use Webdecero\CMS\Models\Site\Site;
use Webdecero\CMS\Models\Site\Settings;
use Illuminate\Http\Request;
use Webdecero\CMS\Traits\ResponseApi;
use Illuminate\Support\Facades\Log;
use Webdecero\CMS\Controllers\Controller;

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
            
            $settings = new Settings();
            $settings->fill($input);
            $site->settings = $settings->toArray();
            $site->save();
            
            return $this->sendResponse($settings, 'Se ha actualizado');
        } catch (Exception $th) {

            return $this->sendError('SettingsController Update', $th->getMessage(), $th->getCode());
        }
    }

}