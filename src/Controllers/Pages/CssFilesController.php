<?php

namespace Webdecero\CMS\Controllers\Pages;

use Exception;
use Throwable;
use Validator;
use Webdecero\CMS\Models\Pages\Page;
use Webdecero\CMS\Schemas\FileSchema;
use Illuminate\Http\Request;
use Webdecero\CMS\Traits\ResponseApi;
use Illuminate\Support\Facades\Log;
use Webdecero\CMS\Controllers\Controller;
use Webdecero\CMS\Controllers\Utilities\ToolsController;

class CssFilesController extends Controller
{
    use ResponseApi;

    public function index(Request $request, $keyName)
    {
        try {
            $page = Page::where('keyName', $keyName)->first();
            if (empty($page)) throw new Exception('Pagina no encontrada', 404);

            $tools = resolve(ToolsController::class);
            $css = $tools->getFrontEndFilesSchema($page->css);

            $files = $css->files;

            return $this->sendResponse($files, 'Files js');
        } catch (Exception $th) {

            return $this->sendError('CssFilesController index', $th->getMessage(), $th->getCode());
        }
    }

    public function store(Request $request, $keyName)
    {
        try {
            $input = $request->all();
            $rules = [
                'name' => 'required|string',
                'pathFile' => 'required|string',
                'type' => 'required|string',
                'order' => 'integer'
            ];
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) return $this->sendError('Error de validación', $validator->errors()->all(), 422);
            
            $page = Page::where('keyName', $keyName)->first();
            if (empty($page)) throw new Exception('Pagina no encontrada', 404);

            $fileNew = new FileSchema($input['name'], $input['pathFile'], $input['type'], $input['order']);

            $tools = resolve(ToolsController::class);
            $css = $tools->getFrontEndFilesSchema($page->css);

            $files = $css->files;

            foreach($files as $file) {
                if($file['order'] == $input['order']) {
                    throw new Exception('Ya existe archivo con ese numero de orden', 409);
                }
            }
            
            $css->addFile($fileNew);

            $page->css = $css;
            $page->save();
            
            return $this->sendResponse($css->files, 'Se ha agregado correctamente');
        } catch (Exception $th) {

            return $this->sendError('CssFilesController store', $th->getMessage(), $th->getCode());
        }
    }

    public function updateAll(Request $request, $keyName)
    {
        try {
            $input = $request->all();
            $rules = [
                'files' => 'required'
            ];
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) return $this->sendError('Error de validación', $validator->errors()->all(), 422);
            
            $page = Page::where('keyName', $keyName)->first();
            if (empty($page)) throw new Exception('Pagina no encontrada', 404);

            $tools = resolve(ToolsController::class);
            $css = $tools->getFrontEndFilesSchema($page->css);

            $css->files = $input['files'];

            $page->css = $css;
            $page->save();
            
            return $this->sendResponse($css->files, 'Se ha actualizado');
        } catch (Exception $th) {

            return $this->sendError('CssFilesController updateAll', $th->getMessage(), $th->getCode());
        }
    }

    public function show(Request $request, $keyName, $id)
    {
        try {
            
            $page = Page::where('keyName', $keyName)->first();
            if (empty($page)) throw new Exception('Pagina no encontrada', 404);

            $tools = resolve(ToolsController::class);
            $css = $tools->getFrontEndFilesSchema($page->css);
            
            $file = $css->getFile($id);
            
            return $this->sendResponse($file, 'Archivo encontrado');
        } catch (Exception $th) {

            return $this->sendError('CssFilesController show', $th->getMessage(), $th->getCode());
        }
    }

    public function update(Request $request, $keyName, $id)
    {
        try {
            $input = $request->all();
            $rules = [
                'name' => 'required|string',
                'pathFile' => 'required|string',
                'type' => 'required|string',
                'order' => 'integer'
            ];
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) return $this->sendError('Error de validación', $validator->errors()->all(), 422);

            $page = Page::where('keyName', $keyName)->first();
            if (empty($page)) throw new Exception('Pagina no encontrada', 404);

            $tools = resolve(ToolsController::class);
            $css = $tools->getFrontEndFilesSchema($page->css);
            
            $file = $css->updateFile($id, $input);

            $page->css = $css;
            $page->save();
            
            return $this->sendResponse($file, 'Archivo actualizado');
        } catch (Exception $th) {

            return $this->sendError('CssFilesController update', $th->getMessage(), $th->getCode());
        }
    }

    public function destroy(Request $request, $keyName, $id)
    {
        try {
            
            $page = Page::where('keyName', $keyName)->first();
            if (empty($page)) throw new Exception('Pagina no encontrada', 404);

            $tools = resolve(ToolsController::class);
            $css = $tools->getFrontEndFilesSchema($page->css);
            
            $path = $css->removeFile($id);
            
            //remove from server
            $tools->removeFile($path);

            $page->css = $css;
            $page->save();
            
            return $this->sendResponse($css->files, 'Se ha eliminado correctamente');
        } catch (Exception $th) {

            return $this->sendError('CssFilesController destroy', $th->getMessage(), $th->getCode());
        }
    }

}