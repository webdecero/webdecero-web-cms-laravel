<?php

use Illuminate\Support\Facades\Route;
use Webdecero\Webcms\Controllers\MailController;
use Webdecero\Webcms\Controllers\RouterController;
use Webdecero\Webcms\Controllers\Manager\ManagerController;
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
    Route::prefix('manager')->group(function () {
        Route::get('/cms', [ManagerController::class, 'home'])->name('manage.home');
        Route::get('/editor/header/{keyName}', [ContentBuilderController::class, 'viewEditorHeader'])->name('manage.editor.header');
        Route::get('/editor/template/{keyName}', [ContentBuilderController::class, 'viewEditorMain'])->name('manage.editor.template');
        Route::get('/editor/footer/{keyName}', [ContentBuilderController::class, 'viewEditorFooter'])->name('manage.editor.footer');
        Route::get('/editor/pages/{lang}/{keyName}', [ContentBuilderController::class, 'viewEditorPages'])->name('manage.editor.pages');
        Route::get('/{any}',[ManagerController::class,'home'])->where('any', '.*');
    });

    Route::post('/notification/contact', [MailController::class, 'sendNotificationContact'])->name('notification.contact');
    Route::get('{any}',[RouterController::class,'catch'])->where('any', '.*');
});

