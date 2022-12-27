<?php

namespace Webdecero\CMS\Controllers\Templates\Editor;

use Exception;
use Throwable;
use Validator;
use Webdecero\CMS\Schemas\FileSchema;
use Illuminate\Http\Request;
use Webdecero\CMS\Traits\ResponseApi;
use Webdecero\CMS\Models\Templates\Template;
use Illuminate\Support\Facades\Log;
use Webdecero\CMS\Controllers\Controller;

class EditorTemplatesController extends Controller
{
    use ResponseApi;

    public function update(Request $request, $keyName)
    {
        try {
            $input = $request->all();

            $rules = [
              'content' => 'required|string'
            ];

            $validator = Validator::make($input, $rules);
            if ($validator->fails()) return $this->sendError('Error de validación', $validator->errors()->all(), 422);


            $template = Template::where('keyName', $keyName)->first();
            if (empty($template)) throw new Exception('Pagina no encontrada', 404);

            $template->content = $input['content'];
            $template->save();

            return $this->sendResponse($template, 'Plantilla actualizada');
        } catch (Exception $th) {

            return $this->sendError('EditorTemplateController store', $th->getMessage(), $th->getCode());
        }
    }

}