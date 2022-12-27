<?php

namespace Webdecero\Webcms\Controllers\Site;

use Exception;
use Throwable;
use Validator;
use Webdecero\Webcms\Models\Site\Site;
use Illuminate\Http\Request;
use Webdecero\Webcms\Traits\ResponseApi;
use Illuminate\Support\Facades\Log;
use Webdecero\Webcms\Controllers\Controller;

class CssController extends Controller
{
    use ResponseApi;

    public function show(Request $request)
    {
        try {
            $site = Site::first();
            if (empty($site)) throw new Exception('Sitio no encontrado', 404);

            return $this->sendResponse($site->css, 'Css');
        } catch (Exception $th) {

            return $this->sendError('CssController show', $th->getMessage(), $th->getCode());
        }
    }
}