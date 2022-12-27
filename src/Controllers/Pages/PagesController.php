<?php

namespace Webdecero\Webcms\Controllers\Pages;

use Exception;
use Throwable;
use Validator;
use Webdecero\Webcms\Models\Pages\Page;
use Webdecero\Webcms\Schemas\SeoSchema;
use Illuminate\Http\Request;
use Webdecero\Webcms\Traits\ResponseApi;
use Illuminate\Support\Facades\Log;
use Webdecero\Webcms\Schemas\FrontEndFilesSchema;
use Webdecero\Webcms\Controllers\Controller;
use Webdecero\Webcms\Controllers\Utilities\ToolsController;

class PagesController extends Controller
{
    use ResponseApi;

    public function index (Request $request) 
    {
        try {
            $pages = Page::all();
            
            return $this->sendResponse($pages, 'Paginas');
        } catch (Exception $th) {
            return $this->sendError('PagesController show', $th->getMessage(), $th->getCode());
        }
    }

    public function show (Request $request, $keyName) 
    {
        try {
            $page = Page::where('keyName', $keyName)->first();
            if (empty($page)) throw new Exception('Pagina no encontrada', 404);

            return $this->sendResponse($page, 'Pagina encontrada');
        } catch (Exception $th) {
            return $this->sendError('PagesController show', $th->getMessage(), $th->getCode());
        }
    }

    public function store (Request $request) 
    {
        try {

            $input = $request->all();
            $rules = [
                'keyName' => 'required|string',
                'lang' => 'required|string',
                // 'content' => 'required|string'
            ];
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) return $this->sendError('Error de validación', $validator->errors()->all(), 422);

            $seo = new SeoSchema('', '', [], '', '');
            
            $css = new FrontEndFilesSchema([],'', '');

            $javaScript = new FrontEndFilesSchema([],'', '');

            $page = new Page();
            $page->fill($input);
            $page->content = "";
            $page->temporalContent = "";
            $page->seo = $seo;
            $page->css = $css;
            $page->javaScript = $javaScript;
            $page->save();

            return $this->sendResponse($page, 'Pagina creada');
        } catch (Exception $th) {
            return $this->sendError('PagesController store', $th->getMessage(), $th->getCode());
        }
    }

    public function update (Request $request, $keyName) 
    {
        try {

            $input = $request->all();
            $rules = [
                'keyNameTemplate' => 'required|string',
                'lang' => 'required|string',
                'content' => 'required|string'
            ];
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) return $this->sendError('Error de validación', $validator->errors()->all(), 422);

            $page = Page::where('keyName', $keyName)->first();
            if (empty($page)) throw new Exception('Pagina no encontrada', 404);
            
            $page->fill($input);

            $page->save();

            return $this->sendResponse($page, 'Pagina actualizada');
        } catch (Exception $th) {
            return $this->sendError('PagesController store', $th->getMessage(), $th->getCode());
        }
    }

    public function destroy (Request $request, $keyName) 
    {
        try {
            $page = Page::where('keyName', $keyName)->first();
            if (empty($page)) throw new Exception('Pagina no encontrada', 404);

            $page->delete();

            return $this->sendResponse(true, 'Pagina eliminada');
        } catch (Exception $th) {
            return $this->sendError('PagesController destroy', $th->getMessage(), $th->getCode());
        }
    }

    public function validateKeyName(Request $request)
    {
        try {
            $input = $request->all();
            $rules = [
                'keyName' => 'required|string'
            ];

            $validator = Validator::make($input, $rules);
            if ($validator->fails()) return $this->sendError('Error de validación', $validator->errors()->all(), 422);

            $page = Page::where('keyName', $input['keyName'])->first();

            $data = [
                'validation' => false
            ];

            if (empty($page)) return $this->sendResponse($data, 'No existe page');

            $data['validation'] = true;

            return $this->sendResponse($data, 'Existe page');
        } catch (Exception $th) {
            return $this->sendError('PagesController validateKeyName', $th->getMessage(), $th->getCode());
        }
    }

}