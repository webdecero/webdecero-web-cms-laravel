<?php

namespace Webdecero\Webcms\Controllers\Site;

use Exception;
use Throwable;
use Validator;
use Webdecero\Webcms\Models\Site\Seo;
use Webdecero\Webcms\Models\Site\Site;
use Webdecero\Webcms\Schemas\SeoSchema;
use Illuminate\Http\Request;
use Webdecero\Webcms\Models\Site\Settings;
use Webdecero\Webcms\Traits\ResponseApi;
use Illuminate\Support\Facades\Log;
use Webdecero\Webcms\Schemas\FrontEndFilesSchema;
use Webdecero\Webcms\Controllers\Controller;
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

    public function createSite ($name, $keyName, $urlBase) 
    {
        try {
            $settings = new Settings();
            $settings->name = $name;
            $settings->urlBase = $urlBase;
            $settings->lang = 'es';
            $settings->robots = 'robots';
            $settings->favicon = 'urlImage';

            $seo = new Seo();
            $seo->es = new SeoSchema('title', 'description', [], 'image', 'schema');
            
            $css = new FrontEndFilesSchema([],'', '');

            $javaScript = new FrontEndFilesSchema([],'', '');

            $site = new Site();
            $site->keyName = $keyName;
            $site->settings = $settings->toArray();
            $site->seo = $seo->toArray();
            $site->css = $css;
            $site->javaScript = $javaScript;
            $site->siteMap = '';
            $site->save();

            return true;
        } catch (Exception $th) {
            return $this->sendError('SettingsController getSettings', $th->getMessage(), $th->getCode());
        }
    }

}