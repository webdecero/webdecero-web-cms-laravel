<?php

namespace Webdecero\Webcms\Controllers\Settings;

use Exception;
use Throwable;
use Validator;
use Illuminate\Http\Request;
use Webdecero\Webcms\Models\Settings\Settings;
use Webdecero\Webcms\Traits\ResponseApi;
use Webdecero\Webcms\Schemas\IdentitySchema;
use Illuminate\Support\Facades\Log;
use Webdecero\Webcms\Controllers\Controller;

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

    public function createSettings () 
    {
        try {
            $sideBar = new IdentitySchema('manager/logos/logoWDCSidebar.png', '#304156');

            $login = new IdentitySchema('manager/logos/logoWDCLogin.png', '#2D3A4B');

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