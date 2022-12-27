<?php


use Illuminate\Support\Facades\Route;
use Webdecero\Webcms\Controllers\Site\SiteController;
use Webdecero\Webcms\Controllers\Pages\PagesController;
use Webdecero\Webcms\Controllers\Images\ImagesController;
use Webdecero\Webcms\Controllers\Manager\AdminController;

use Webdecero\Webcms\Controllers\Manager\LoginController;

use Webdecero\Webcms\Controllers\Manager\ContactController;
use Webdecero\Webcms\Controllers\SiteMap\SiteMapController;
use Webdecero\Webcms\Controllers\Utilities\FilesController;
use Webdecero\Webcms\Controllers\Settings\SideBarController;
use Webdecero\Webcms\Controllers\Settings\SettingsController;
use Webdecero\Webcms\Controllers\Templates\TemplatesController;
use Webdecero\Webcms\Controllers\Pages\Editor\EditorPagesController;
use Webdecero\Webcms\Controllers\Utilities\ConfigurationsController;
use Webdecero\Webcms\Controllers\Site\CssController as CssSController;
use Webdecero\Webcms\Controllers\Site\SeoController as SeoSController;

use Webdecero\Webcms\Controllers\Pages\CssController as CssPController;
use Webdecero\Webcms\Controllers\Pages\SeoController as SeoPController;
use Webdecero\Webcms\Controllers\Templates\CssController as CssTController;
use Webdecero\Webcms\Controllers\Site\JavaScriptController as JsSController;
use Webdecero\Webcms\Controllers\Templates\Editor\EditorTemplatesController;
use Webdecero\Webcms\Controllers\Pages\JavaScriptController as JsPController;
use Webdecero\Webcms\Controllers\Settings\LoginController as LoginSController;

use Webdecero\Webcms\Controllers\Site\CssFilesController as CssFilesSController;
use Webdecero\Webcms\Controllers\Site\SettingsController as SettingsSController;
use Webdecero\Webcms\Controllers\Pages\CssFilesController as CssFilesPController;
use Webdecero\Webcms\Controllers\Templates\JavaScriptController as JsTController;
use Webdecero\Webcms\Controllers\Site\CssCustomController as CssCustomSController;
use Webdecero\Webcms\Controllers\Pages\CssCustomController as CssCustomPController;
use Webdecero\Webcms\Controllers\Templates\CssFilesController as CssFilesTController;
use Webdecero\Webcms\Controllers\Templates\SettingsController as SettingsTController;

use Webdecero\Webcms\Controllers\Site\JavaScriptFilesController as JsFilesSController;
use Webdecero\Webcms\Controllers\Pages\JavaScriptFilesController as JsFilesPController;

use Webdecero\Webcms\Controllers\Templates\CssCustomController as CssCustomTController;
use Webdecero\Webcms\Controllers\Site\JavaScriptCustomController as JsCustomSController;
use Webdecero\Webcms\Controllers\Pages\JavaScriptCustomController as JsCustomPController;
use Webdecero\Webcms\Controllers\Templates\JavaScriptFilesController as JsFilesTController;
use Webdecero\Webcms\Controllers\Templates\JavaScriptCustomController as JsCustomTController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware('api')->prefix('api-manager')->group(function () {

    Route::name('admin.')->group(function () {
        Route::post('/login', [LoginController::class, 'login'])->name('login');
    });

    Route::options('/config', [ConfigurationsController::class, 'getBaseUri'])->name('config.base');

    Route::middleware(['auth:admin'])->group(function () {

        Route::get('/settings', [SettingsController::class, 'getSettings'])->name('settings');
        //Route::get('/settings/create', [SettingsController::class, 'createSettings'])->name('settings.create');
        Route::get('/settings/side-bar', [SideBarController::class, 'show'])->name('settings.side-bar');
        Route::put('/settings/side-bar', [SideBarController::class, 'update'])->name('settings.side-bar');
        Route::get('/settings/login', [LoginSController::class, 'show'])->name('settings.login');
        Route::put('/settings/login', [LoginSController::class, 'update'])->name('settings.login');

        Route::get('/site', [SiteController::class, 'getSite'])->name('site');
        Route::get('/site/keyname', [SiteController::class, 'getKeyName'])->name('site.keyname');
        //Route::get('/site/create', [SiteController::class, 'createSite'])->name('site.create');
        Route::resource('/site/seo', SeoSController::class, ['except' => [
            'create', 'edit'
        ]]);
        Route::get('/site/settings', [SettingsSController::class, 'show'])->name('site.settings.show');
        Route::put('/site/settings', [SettingsSController::class, 'update'])->name('site.settings.update');
        Route::get('/site/javascript', [JsSController::class, 'show'])->name('site.js.show');
        Route::put('/site/javascript/files/all', [JsFilesSController::class, 'updateAll'])->name('site.css.files.updateall');
        Route::resource('/site/javascript/files', JsFilesSController::class, ['except' => [
            'create', 'edit'
        ]]);
        Route::get('/site/javascript/custom', [JsCustomSController::class, 'showCustom'])->name('site.js.custom.show');
        Route::put('/site/javascript/custom', [JsCustomSController::class, 'updateCustom'])->name('site.js.custom.update');
        Route::get('/site/css', [CssSController::class, 'show'])->name('site.css.show');
        Route::put('/site/css/files/all', [CssFilesSController::class, 'updateAll'])->name('site.css.files.updateall');
        Route::resource('/site/css/files', CssFilesSController::class, ['except' => [
            'create', 'edit'
        ]]);
        Route::get('/site/css/custom', [CssCustomSController::class, 'showCustom'])->name('site.css.custom.show');
        Route::put('/site/css/custom', [CssCustomSController::class, 'updateCustom'])->name('site.css.custom.update');
        
        Route::resource('/site-map', SiteMapController::class, ['except' => [
            'create', 'edit'
        ]]);
        
        Route::resource('/images', ImagesController::class, ['except' => [
            'create', 'edit', 'update'
        ]]);
        Route::post('/images/{id}', [ImagesController::class, 'update'])->name('images.update');
        Route::post('/images/base-64', [ImagesController::class, 'uploadImageBase64'])->name('images.base64');

        Route::post('utilities/files/css', [FilesController::class, 'uploadFileCSS'])->name('css.upload');
        Route::post('utilities/files/js', [FilesController::class, 'uploadFileJS'])->name('js.upload');

        Route::resource('/pages', PagesController::class, ['except' => [
            'create', 'edit'
        ]]);
        Route::post('/pages/validate/keyname', [PagesController::class, 'validateKeyName'])->name('page.validate');
        Route::get('/pages/{keyName}/seo', [SeoPController::class, 'show'])->name('page.seo.show');
        Route::put('/pages/{keyName}/seo', [SeoPController::class, 'update'])->name('page.seo.update');
        Route::get('/pages/{keyName}/javascript', [JsPController::class, 'show'])->name('page.js.show');
        Route::put('/pages/{keyName}/javascript/files/all', [JsFilesPController::class, 'updateAll'])->name('page.js.files.updateall');
        Route::resource('/pages/{keyName}/javascript/files', JsFilesPController::class, ['except' => [
            'create', 'edit'
        ]]);
        Route::get('/pages/{keyName}/javascript/custom', [JsCustomPController::class, 'showCustom'])->name('page.js.custom.show');
        Route::put('/pages/{keyName}/javascript/custom', [JsCustomPController::class, 'updateCustom'])->name('page.js.custom.update');
        Route::get('/pages/{keyName}/css', [CssPController::class, 'show'])->name('page.css.show');
        Route::put('/pages/{keyName}/css/files/all', [CssFilesPController::class, 'updateAll'])->name('page.css.files.updateAll');
        Route::resource('/pages/{keyName}/css/files', CssFilesPController::class, ['except' => [
            'create', 'edit'
        ]]);
        Route::get('/pages/{keyName}/css/custom', [CssCustomPController::class, 'showCustom'])->name('page.css.custom.show');
        Route::put('/pages/{keyName}/css/custom', [CssCustomPController::class, 'updateCustom'])->name('page.css.custom.update');
        
        Route::put('/pages/{keyName}/content/editor', [EditorPagesController::class, 'update'])->name('page.content.editor.update');

        

        Route::resource('/templates', TemplatesController::class, ['except' => [
            'create', 'edit', 'index'
        ]]);
        Route::post('/templates/{type}', [TemplatesController::class, 'search'])->name('template.search');
        Route::post('/templates/validate/keyname', [TemplatesController::class, 'validateKeyName'])->name('template.validate');
        Route::get('/templates/{keyName}/javascript', [JsTController::class, 'show'])->name('template.js.show');
        Route::put('/templates/{keyName}/javascript/files/all', [JsFilesTController::class, 'updateAll'])->name('template.js.files.updateall');
        Route::resource('/templates/{keyName}/javascript/files', JsFilesTController::class, ['except' => [
            'create', 'edit'
        ]]);
        Route::get('/templates/{keyName}/javascript/custom', [JsCustomTController::class, 'showCustom'])->name('template.js.custom.show');
        Route::put('/templates/{keyName}/javascript/custom', [JsCustomTController::class, 'updateCustom'])->name('template.js.custom.update');
        Route::get('/templates/{keyName}/css', [CssTController::class, 'show'])->name('template.css.show');
        Route::put('/templates/{keyName}/css/files/all', [CssFilesTController::class, 'updateAll'])->name('template.css.files.updateall');
        Route::resource('/templates/{keyName}/css/files', CssFilesTController::class, ['except' => [
            'create', 'edit'
        ]]);
        Route::get('/templates/{keyName}/css/custom', [CssCustomTController::class, 'showCustom'])->name('template.css.custom.show');
        Route::put('/templates/{keyName}/css/custom', [CssCustomTController::class, 'updateCustom'])->name('template.css.custom.update');

        Route::put('/templates/{keyName}/content/editor', [EditorTemplatesController::class, 'update'])->name('template.content.editor.update');

        Route::get('/admin', [AdminController::class, 'getAuth'])->name('admin.getAuth');
        Route::get('/list-admin', [AdminController::class, 'listAdmin'])->name('admin.listadmin');
        Route::resource("/admin", AdminController::class, ['except' => [
            'create', 'edit', 'index'
        ]])->names('admin');


        Route::post('/contact/search', [ContactController::class, 'search'])->name('admin.contact.search');


    });
});