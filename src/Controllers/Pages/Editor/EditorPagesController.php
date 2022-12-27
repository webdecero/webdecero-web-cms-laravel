<?php

namespace Webdecero\CMS\Controllers\Pages\Editor;

use Exception;
use Throwable;
use Validator;
use Webdecero\CMS\Models\Pages\Page;
use Webdecero\CMS\Schemas\FileSchema;
use Illuminate\Http\Request;
use Webdecero\CMS\Traits\ResponseApi;
use Illuminate\Support\Facades\Log;
use Webdecero\CMS\Controllers\Controller;

class EditorPagesController extends Controller
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


            $page = Page::where('keyName', $keyName)->first();
            if (empty($page)) throw new Exception('Pagina no encontrada', 404);

            $page->content = $input['content'];
            $page->save();

            return $this->sendResponse($page, 'Plantilla actualizada');
        } catch (Exception $th) {

            return $this->sendError('EditorPageController store', $th->getMessage(), $th->getCode());
        }
    }

}