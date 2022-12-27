<?php

namespace Webdecero\CMS\Controllers\Site;

use Exception;
use Throwable;
use Validator;
use Webdecero\CMS\Models\Site\Site;
use Illuminate\Http\Request;
use Webdecero\CMS\Traits\ResponseApi;
use Illuminate\Support\Facades\Log;
use Webdecero\CMS\Controllers\Controller;

class JavaScriptController extends Controller
{
    use ResponseApi;

    public function show(Request $request)
    {
        try {
            $site = Site::first();
            if (empty($site)) throw new Exception('Sitio no encontrado', 404);

            return $this->sendResponse($site->javaScript, 'JavaScript');
        } catch (Exception $th) {

            return $this->sendError('JavaScriptController show', $th->getMessage(), $th->getCode());
        }
    }

}