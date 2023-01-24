<?php

use Illuminate\Support\Facades\Route;
use Webdecero\Webcms\Controllers\RouterController;
use Webdecero\Webcms\Controllers\Manager\WebcmsController;
use Webdecero\Webcms\Controllers\Manager\Contentbuiler\ContentBuilderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



// Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => ['web','setGuard:web','localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], function () {

Route::middleware('web')->group(function () {
    Route::get('webcms', [WebcmsController::class, 'home'])->name('webcms.home');
    Route::prefix('webcms')->group(function () {
        Route::get('/editor/header/{keyName}', [ContentBuilderController::class, 'viewEditorHeader'])->name('webcms.editor.header');
        Route::get('/editor/template/{keyName}', [ContentBuilderController::class, 'viewEditorMain'])->name('webcms.editor.template');
        Route::get('/editor/footer/{keyName}', [ContentBuilderController::class, 'viewEditorFooter'])->name('webcms.editor.footer');
        Route::get('/editor/pages/{lang}/{keyName}', [ContentBuilderController::class, 'viewEditorPages'])->name('webcms.editor.pages');
        Route::get('/{any}',[WebcmsController::class,'home'])->where('any', '.*');
    });

    Route::get('{any}',[RouterController::class,'catch'])->where('any', '.*');
});

