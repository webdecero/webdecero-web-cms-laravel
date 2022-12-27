<?php

namespace Webdecero\Webcms\Controllers\Templates;

use Exception;
use Throwable;
use Validator;
use Webdecero\Webcms\Schemas\FileSchema;
use Illuminate\Http\Request;
use Webdecero\Webcms\Traits\ResponseApi;
use Webdecero\Webcms\Models\Templates\Template;
use Illuminate\Support\Facades\Log;
use Webdecero\Webcms\Controllers\Controller;

class CssController extends Controller
{
    use ResponseApi;

    public function show(Request $request, $keyName)
    {
        try {
            $template = Template::where('keyName', $keyName)->first();
            if (empty($template)) throw new Exception('Pagina no encontrada', 404);

            return $this->sendResponse($template->css, 'Css');
        } catch (Exception $th) {

            return $this->sendError('CssController show', $th->getMessage(), $th->getCode());
        }
    }

}