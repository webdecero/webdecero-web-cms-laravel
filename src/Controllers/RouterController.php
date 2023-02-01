<?php

namespace Webdecero\Webcms\Controllers;

use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Webdecero\Webcms\Models\Site\Site;
use Illuminate\Support\Facades\Log;
use Webdecero\Webcms\Models\Pages\Page;
use Webdecero\Webcms\Traits\ResponseApi;
use Webdecero\Webcms\Models\SiteMap\SiteMap;
use Webdecero\Webcms\Controllers\Controller;
use Webdecero\Webcms\Models\Templates\Template;

class RouterController extends Controller
{
    use ResponseApi;

    /**
     * ContactStore a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function catch(Request $request)
    {
        try {
            $isLang = false;
            $uri = $request->getPathInfo();

            //obtiene idioma
            //$lang = App::currentLocale();
            $lang = Session::get('locale');

            //si esta vacio por defecto pone el español
            if(empty($lang)) $lang = 'es';

            //Host redirige a español
            if  ($uri == '/') {
                return redirect('/'.$lang);
            }

            //Divide url
            $urls = explode("/", $uri);
            unset($urls[0]);

            //verifica que el primer elemento del array sea el idioma
            $langs = SiteMap::select('lang')->groupBy('lang')->get();
            foreach($langs as $langR) {
                if($urls[1] == $langR->lang) $isLang = true;
            }

            //toma el idioma de la cookie y regirige con idioma
            if(!$isLang) {
                //agrega idioma a la url
                array_unshift($urls, $lang);
                //une la url con separador
                $uri = implode("/",$urls);
                //redirige
                return redirect($uri);
            }
            //buscar sitemap del idioma
            $siteMap = SiteMap::where('lang', $urls[1])->first();

            //saca idioma del array
            unset($urls[1]);
            //agrega path raiz
            array_unshift($urls,"/");

            $pageNode = $this->_searchNode($siteMap, $urls);
            if(!empty($pageNode)) {
                //Log::info("message");
                //App::setLocale($siteMap->lang);
                Session::put('locale', $siteMap->lang);
                return $this->_loadPage($pageNode);
            }

            return view('errors.404');

        } catch (\Throwable $th) {
            //Log::info($th);
            return $this->sendError('RouterController catch', $th->getMessage(), $th->getCode());
        }
    }

    private function _searchNode($siteMap, $urls) {

        $map = $siteMap->map;

        foreach ($urls as $url) {
            $pageNode = $this->_searchMap($map, $url);

            if(empty($pageNode)) return null;

            $map = !empty($pageNode['children']) ? $pageNode['children'] : [];
        }

        return $pageNode;
    }

    private function _searchMap($map, $slug){

        foreach($map as $page) {
            if ($page['slug'] == $slug) {
                return $page;
            }
        }
        return null;
    }

    private function _loadPage($pageNode){
            $site = Site::first();
            $page = Page::where('keyName', $pageNode['keyNamePage'])->first();
            $templateHeader = Template::where('keyName', $pageNode['keyNameTemplateHeader'])->first();
            $templateMain = Template::where('keyName', $pageNode['keyNameTemplateMain'])->first();
            $templateFooter = Template::where('keyName', $pageNode['keyNameTemplateFooter'])->first();

            $data['title'] = $pageNode['menuTitle'];

            //CSS
            $data['cssSite'] = $site->css['files'];
            $data['cssPage'] = $page->css['files'];
            $data['cssTemplateMain'] = $templateMain->css['files'];
            $data['cssTemplateHeader'] = $templateHeader->css['files'];
            $data['cssTemplateFooter'] = $templateFooter->css['files'];

            $data['cssCustomSite'] = $site->css['custom'];
            $data['cssCustomPage'] = $page->css['custom'];
            $data['cssCustomTemplateMain'] = $templateMain->css['custom'];
            $data['cssCustomTemplateHeader'] = $templateHeader->css['custom'];
            $data['cssCustomTemplateFooter'] = $templateFooter->css['custom'];

            //JS
            $data['javaScriptSite'] = $site->javaScript['files'];
            $data['javaScriptPage'] = $page->javaScript['files'];
            $data['javaScriptTemplateMain'] = $templateMain->javaScript['files'];
            $data['javaScriptTemplateHeader'] = $templateHeader->javaScript['files'];
            $data['javaScriptTemplateFooter'] = $templateFooter->javaScript['files'];

            $data['javaScriptCustomSite'] = $site->javaScript['custom'];
            $data['javaScriptCustomPage'] = $page->javaScript['custom'];
            $data['javaScriptCustomTemplateMain'] = $templateMain->javaScript['custom'];
            $data['javaScriptCustomTemplateHeader'] = $templateHeader->javaScript['custom'];
            $data['javaScriptCustomTemplateFooter'] = $templateFooter->javaScript['custom'];

            //CONTENT
            $data['content'] = $templateHeader->content . $templateMain->content . $templateFooter->content;

            //Body class
            $data['bodyClass'] = $pageNode['slug'];

            //Class
            $data['class'] = $pageNode['clase'];

            return view(
                'manager.page.generic_page',
                $data
            );
    }
}
