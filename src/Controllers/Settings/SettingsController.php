<?php

namespace Webdecero\Webcms\Controllers\Settings;

use Exception;
use Throwable;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Webdecero\Webcms\Traits\ResponseApi;
use Webdecero\Webcms\Schemas\IdentitySchema;
use Webdecero\Webcms\Controllers\Controller;
use Webdecero\Webcms\Models\Settings\Settings;

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

    public function createSettings (IdentitySchema $sideBar, IdentitySchema $login) 
    {
        try {
            
            $settings = new Settings();
            $settings->sideBar = $sideBar;
            $settings->login = $login;
            $settings->save();

            return true;
        } catch (Exception $th) {
            return $this->sendError('SettingsController getSettings', $th->getMessage(), $th->getCode());
        }
    }

}