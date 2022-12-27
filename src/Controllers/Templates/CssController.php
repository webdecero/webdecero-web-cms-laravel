<?php

namespace Webdecero\CMS\Controllers\Templates;

use Exception;
use Throwable;
use Validator;
use Webdecero\CMS\Schemas\FileSchema;
use Illuminate\Http\Request;
use Webdecero\CMS\Traits\ResponseApi;
use Webdecero\CMS\Models\Templates\Template;
use Illuminate\Support\Facades\Log;
use Webdecero\CMS\Controllers\Controller;

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