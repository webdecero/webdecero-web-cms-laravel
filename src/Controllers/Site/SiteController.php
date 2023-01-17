<?php

namespace Webdecero\Webcms\Controllers\Site;

use Exception;
use Throwable;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Webdecero\Webcms\Models\Site\Seo;
use Webdecero\Webcms\Models\Site\Site;
use Webdecero\Webcms\Schemas\SeoSchema;
use Webdecero\Webcms\Traits\ResponseApi;
use Webdecero\Webcms\Controllers\Controller;
use Webdecero\Webcms\Schemas\SettingsSchema;
use Webdecero\Webcms\Schemas\FrontEndFilesSchema;
use Webdecero\Webcms\Controllers\Utilities\ToolsController;

class SiteController extends Controller
{
    use ResponseApi;

    public function getSite (Request $request) 
    {
        try {
            $site = Site::first();
            if (empty($site)) throw new Exception('Sitio no encontrado', 404);

            $tools = resolve(ToolsController::class);
            //adding content custom js
            $javaScript = $tools->getFrontEndFilesSchema($site->javaScript);
            $javaScript->custom['content'] = $tools->getContentCustomFile('js/site/custom','custom','js');
            $site->javaScript = $javaScript;
            //adding content custom css
            $css = $tools->getFrontEndFilesSchema($site->css);
            $css->custom['content'] = $tools->getContentCustomFile('css/site/custom','custom','css');
            $site->css = $css;
            
            return $this->sendResponse($site, 'Sitio encontrado');
        } catch (Exception $th) {
            return $this->sendError('SiteController getSite', $th->getMessage(), $th->getCode());
        }
    }

    public function getKeyName (Request $request) 
    {
        try {
            $site = Site::first();
            if (empty($site)) throw new Exception('Sitio no encontrado', 404);

            $data = [
                'keyName'=> $site->keyName
            ];
            return $this->sendResponse($data, 'keyName Sitio');
        } catch (Exception $th) {
            return $this->sendError('SiteController getSite', $th->getMessage(), $th->getCode());
        }
    }

    public function createSite (String $keyName, Seo $seo,SettingsSchema $settings, FrontEndFilesSchema $css, FrontEndFilesSchema $javaScript) 
    {
        try {

            $site = new Site();
            $site->keyName = $keyName;
            $site->settings = $settings;
            $site->seo = $seo->toArray();
            $site->css = $css;
            $site->javaScript = $javaScript;
            $site->siteMap = '';
            $site->save();

            return true;
        } catch (Exception $th) {
            return $this->sendError('SettingsController createSite', $th->getMessage(), $th->getCode());
        }
    }

}