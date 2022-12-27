<?php

namespace Webdecero\CMS\Controllers\Manager\Contentbuiler;


// use Illuminate\Http\Request;
use Webdecero\CMS\Models\Site\Site;
use Webdecero\CMS\Models\Templates\Template;
use Webdecero\CMS\Models\Pages\Page;
use Webdecero\CMS\Models\SiteMap\SiteMap;
use Webdecero\CMS\Traits\ResponseApi;
use Webdecero\CMS\Controllers\Controller;

class ContentBuilderController extends Controller
{
    use ResponseApi;

    /**
     * viewEditor muestra la vita del editor de content builder js
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function viewEditor($id)
    {
        $template = Template::find($id);

        // $templateHeader =

        $site = Site::whereNotNull('name')->first();

        $this->data['style'] = $site['globalCSS'];

        $this->data['js'] = $site['globalJavaScript'];


        $this->data['template'] = $template['content'];

        // dd($this->data['js']);
        return view(
            'contentBuilder.editor',
            $this->data
        );
    }

    public function viewEditorFooter($keyName) {

        $template = Template::where('keyName', $keyName)->first();

        $site = Site::first();

        $data['urlBase'] = $site->settings['urlBase'];

        $data['cssSite'] = $site->css['files'];
        $data['cssTemplate'] = $template->css['files'];

        $data['cssCustomSite'] = $site->css['custom'];
        $data['cssCustomTemplate'] = $template->css['custom'];

        $data['javaScriptStite'] = $site->javaScript['files'];
        $data['javaScriptTemplate'] = $template->javaScript['files'];

        $data['javaScriptCustomSite'] = $site->javaScript['custom'];
        $data['javaScriptCustomTemplate'] = $template->javaScript['custom'];

        $data['content'] = $template->content;

        return view(
            'manager.editor.template.footer',
            $data
        );
    }

    public function viewEditorMain($keyName) {

        $template = Template::where('keyName', $keyName)->first();
        
        $site = Site::first();

        $data['urlBase'] = $site->settings['urlBase'];

        $data['cssSite'] = $site->css['files'];
        $data['cssTemplate'] = $template->css['files'];

        $data['cssCustomSite'] = $site->css['custom'];
        $data['cssCustomTemplate'] = $template->css['custom'];

        $data['javaScriptStite'] = $site->javaScript['files'];
        $data['javaScriptTemplate'] = $template->javaScript['files'];

        $data['javaScriptCustomSite'] = $site->javaScript['custom'];
        $data['javaScriptCustomTemplate'] = $template->javaScript['custom'];

        $data['content'] = $template->content;

        return view(
            'manager.editor.template.main',
            $data
        );
    }

    public function viewEditorHeader($keyName) {

        $template = Template::where('keyName', $keyName)->first();

        $site = Site::first();

        $data['urlBase'] = $site->settings['urlBase'];

        $data['cssSite'] = $site->css['files'];
        $data['cssTemplate'] = $template->css['files'];

        $data['cssCustomSite'] = $site->css['custom'];
        $data['cssCustomTemplate'] = $template->css['custom'];

        $data['javaScriptStite'] = $site->javaScript['files'];
        $data['javaScriptTemplate'] = $template->javaScript['files'];

        $data['javaScriptCustomSite'] = $site->javaScript['custom'];
        $data['javaScriptCustomTemplate'] = $template->javaScript['custom'];

        $data['content'] = $template->content;

        return view(
            'manager.editor.template.header',
            $data
        );
    }

    public function viewEditorPages($lang, $keyName) {
        $page = Page::where('keyName', $keyName)->first();

        if (empty($page)) return false;
        
        $site = Site::first();
        $siteMap = SiteMap::where('lang', $lang)->first();
        // dd($siteMap);
        
        $maps = $siteMap->map;

        $map = $this->_getMap($maps, $page->keyName);
        
        $keyNameTemplateHeader = $map['keyNameTemplateHeader'];
        $keyNameTemplateMain = $map['keyNameTemplateMain'];
        $keyNameTemplateFooter = $map['keyNameTemplateFooter'];

        
        $templateHeader = Template::where('keyName', $keyNameTemplateHeader)->first();
        $templateMain = Template::where('keyName', $keyNameTemplateMain)->first();
        $templateFooter = Template::where('keyName', $keyNameTemplateFooter)->first();

        $data['urlBase'] = $site->settings['urlBase'];

        $data['cssSite'] = $site->css['files'];

        $data['cssTemplateMain'] = !empty($templateMain) ? $templateMain->css['files'] : [];
        $data['cssTemplateHeader'] = !empty($templateHeader) ? $templateHeader->css['files'] : [];
        $data['cssTemplateFooter'] = !empty($templateFooter) ? $templateFooter->css['files'] : [];

        $data['cssCustomSite'] = $site->css['custom'];

        $data['cssCustomTemplateMain'] = $templateMain->css['custom'];
        $data['cssCustomTemplateHeader'] = $templateHeader->css['custom'];
        $data['cssCustomTemplateFooter'] = $templateFooter->css['custom'];

        $data['javaScriptStite'] = $site->javaScript['files'];

        $data['javaScriptTemplateMain'] = $templateMain->javaScript['files'];
        $data['javaScriptTemplateHeader'] = $templateHeader->javaScript['files'];
        $data['javaScriptTemplateFooter'] = $templateFooter->javaScript['files'];

        $data['javaScriptCustomSite'] = $site->javaScript['custom'];
        
        $data['javaScriptCustomTemplateMain'] = $templateMain->javaScript['custom'];
        $data['javaScriptCustomTemplateHeader'] = $templateHeader->javaScript['custom'];
        $data['javaScriptCustomTemplateFooter'] = $templateFooter->javaScript['custom'];

        $data['cssPage'] = $page->css['files'];
        $data['cssCustomPage'] = $page->css['custom'];
        $data['javaScriptPage'] = $page->javaScript['files'];
        $data['javaScriptCustomPage'] = $page->javaScript['custom'];

        $data['contentHeader'] = $templateHeader->content;
        $data['contentFooter'] = $templateFooter->content;
        
        $content = empty($page->content) ? $templateMain->content : $page->content;

        // $content = $templateHeader->content . $content . $templateFooter->content;
        
        $data['content'] = $content;

        $data['bodyClass'] = $map['slug'];

        return view(
            'manager.editor.pages.page',
            $data
        );
    }

    private function _getMap($maps, $keyNamePage) {   
        foreach ($maps as $page) {
            if ($page['keyNamePage'] == $keyNamePage) {
                
                return $page;
            }
            else {
                if(!empty($page['children'])) {
                    $result = $this->_getMap($page['children'],$keyNamePage);
                }
                if (!empty($result)) {
                    return $result;
                }
                continue;
            }
        }
        return null;
    }
}