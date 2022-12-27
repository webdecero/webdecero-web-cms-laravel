<?php

namespace Webdecero\CMS\Controllers\Settings;

use Exception;
use Throwable;
use Validator;
use Illuminate\Http\Request;
use Webdecero\CMS\Models\Settings\Settings;
use Webdecero\CMS\Traits\ResponseApi;
use Webdecero\CMS\Schemas\IdentitySchema;
use Illuminate\Support\Facades\Log;
use Webdecero\CMS\Controllers\Controller;

class SettingsController extends Controller
{
    use ResponseApi;

    public function getSettings (Request $request) 
    {
        try {
            $settings = Settings::first();
            if (empty($settings)) throw new Exception('Configuraciones no encontradas', 404);

            return $this->sendResponse($settings, 'Configuraciones encontradas');
        } catch (Exception $th) {
            return $this->sendError('SettingsController getSettings', $th->getMessage(), $th->getCode());
        }
    }

    public function createSettings (Request $request) 
    {
        try {
            $sideBar = new IdentitySchema(null, '#304156');

            $login = new IdentitySchema(null, '#2D3A4B');

            $settings = new Settings();
            $settings->sideBar = $sideBar;
            $settings->login = $login;
            $settings->save();

            return $this->sendResponse($settings, 'Configuraciones creadas');
        } catch (Exception $th) {
            return $this->sendError('SettingsController getSettings', $th->getMessage(), $th->getCode());
        }
    }

}