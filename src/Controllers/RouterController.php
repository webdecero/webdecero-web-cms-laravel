<?php

namespace Webdecero\CMS\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Webdecero\CMS\Models\Site\Site;
use Illuminate\Support\Facades\Log;
use Webdecero\CMS\Models\Pages\Page;
use Webdecero\CMS\Traits\ResponseApi;
use Webdecero\CMS\Models\SiteMap\SiteMap;
use Webdecero\CMS\Controllers\Controller;
use Webdecero\CMS\Models\Templates\Template;

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
            
            $lang = App::currentLocale();
            $siteMap = SiteMap::where('lang', $lang)->first();

            $uri = $request->getPathInfo();
            $urls = explode("/", $uri);
            unset($urls[0]);
            
            if(!empty($siteMap)) {
                $pageNode = $this->_searchNode($siteMap, $urls);
                if(!empty($pageNode)) return $this->_loadPage($pageNode);
            }
            
            $siteMaps = SiteMap::where('lang','!=',$lang)->get();
            
            foreach($siteMaps as $siteMap) {
                $pageNode = $this->_searchNode($siteMap, $urls);
                if(!empty($pageNode)) {
                    App::setLocale($siteMap->lang);
                    return $this->_loadPage($pageNode);
                }
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

            $content = empty($page->content) ? $templateMain->content : $page->content ;

            //CONTENT
            $data['content'] = $templateHeader->content . $content . $templateFooter->content;

            //Body class
            $data['bodyClass'] = $pageNode['slug'];

            return view(
                'manager.page.generic_page',
                $data
            );
    }
}