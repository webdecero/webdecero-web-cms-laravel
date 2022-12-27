<?php

namespace Webdecero\CMS\Controllers\Site;

use Exception;
use Throwable;
use Validator;
use Webdecero\CMS\Models\Site\Seo;
use Webdecero\CMS\Models\Site\Site;
use Webdecero\CMS\Schemas\SeoSchema;
use Illuminate\Http\Request;
use Webdecero\CMS\Models\Site\Settings;
use Webdecero\CMS\Traits\ResponseApi;
use Illuminate\Support\Facades\Log;
use Webdecero\CMS\Schemas\FrontEndFilesSchema;
use Webdecero\CMS\Controllers\Controller;
use Webdecero\CMS\Controllers\Utilities\ToolsController;

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

    public function createSite (Request $request) 
    {
        try {
            $settings = new Settings();
            $settings->name = 'SiteTest';
            $settings->urlBase = 'sitetest.com';
            $settings->lang = 'es';
            $settings->robots = 'robotsTest';
            $settings->favicon = 'urlImage';

            $seo = new Seo();
            $seo->es = new SeoSchema('titleTest', 'description', [], 'image', 'schema');
            
            $css = new FrontEndFilesSchema([],'', '');

            $javaScript = new FrontEndFilesSchema([],'', '');

            $site = new Site();
            $site->keyName = 'SiteTest';
            $site->settings = $settings->toArray();
            $site->seo = $seo->toArray();
            $site->css = $css;
            $site->javaScript = $javaScript;
            $site->siteMap = '';
            $site->save();

            return $this->sendResponse($site, 'Configuraciones creadas');
        } catch (Exception $th) {
            return $this->sendError('SettingsController getSettings', $th->getMessage(), $th->getCode());
        }
    }

}