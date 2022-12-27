<?php

namespace Webdecero\Webcms\Controllers\Pages;

use Exception;
use Throwable;
use Validator;
use Webdecero\Webcms\Models\Pages\Page;
use Illuminate\Http\Request;
use Webdecero\Webcms\Traits\ResponseApi;
use Illuminate\Support\Facades\Log;
use Webdecero\Webcms\Controllers\Controller;

class JavaScriptController extends Controller
{
    use ResponseApi;

    public function show(Request $request, $keyName)
    {
        try {
            $page = Page::where('keyName', $keyName)->first();
            if (empty($page)) throw new Exception('Pagina no encontrada', 404);

            return $this->sendResponse($page->javaScript, 'JavaScript');
        } catch (Exception $th) {

            return $this->sendError('JavaScriptController show', $th->getMessage(), $th->getCode());
        }
    }

}