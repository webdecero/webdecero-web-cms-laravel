<?php

namespace Webdecero\Webcms\Controllers\Templates;

use Exception;
use Throwable;
use Validator;
use Webdecero\Webcms\Models\Templates\Template;
use Webdecero\Webcms\Schemas\FileSchema;
use Illuminate\Http\Request;
use Webdecero\Webcms\Traits\ResponseApi;
use Illuminate\Support\Facades\Log;
use Webdecero\Webcms\Controllers\Controller;
use Webdecero\Webcms\Controllers\Utilities\ToolsController;

class CssFilesController extends Controller
{
    use ResponseApi;

    public function index(Request $request, $keyName)
    {
        try {
            $template = Template::where('keyName', $keyName)->first();
            if (empty($template)) throw new Exception('Pagina no encontrada', 404);

            $tools = resolve(ToolsController::class);
            $css = $tools->getFrontEndFilesSchema($template->css);

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
            
            $template = Template::where('keyName', $keyName)->first();
            if (empty($template)) throw new Exception('Pagina no encontrada', 404);

            $fileNew = new FileSchema($input['name'], $input['pathFile'], $input['type'], $input['order']);

            $tools = resolve(ToolsController::class);
            $css = $tools->getFrontEndFilesSchema($template->css);

            $files = $css->files;

            foreach($files as $file) {
                if($file['order'] == $input['order']) {
                    throw new Exception('Ya existe archivo con ese numero de orden', 409);
                }
            }
            
            $css->addFile($fileNew);

            $template->css = $css;
            $template->save();
            
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
            
            $template = Template::where('keyName', $keyName)->first();
            if (empty($template)) throw new Exception('Pagina no encontrada', 404);

            $tools = resolve(ToolsController::class);
            $css = $tools->getFrontEndFilesSchema($template->css);

            $css->files = $input['files'];

            $template->css = $css;
            $template->save();
            
            return $this->sendResponse($css->files, 'Se ha actualizado');
        } catch (Exception $th) {

            return $this->sendError('CssFilesController updateAll', $th->getMessage(), $th->getCode());
        }
    }

    public function show(Request $request, $keyName, $id)
    {
        try {
            
            $template = Template::where('keyName', $keyName)->first();
            if (empty($template)) throw new Exception('Pagina no encontrada', 404);

            $tools = resolve(ToolsController::class);
            $css = $tools->getFrontEndFilesSchema($template->css);
            
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

            $template = Template::where('keyName', $keyName)->first();
            if (empty($template)) throw new Exception('Pagina no encontrada', 404);

            $tools = resolve(ToolsController::class);
            $css = $tools->getFrontEndFilesSchema($template->css);
            
            $file = $css->updateFile($id, $input);

            $template->css = $css;
            $template->save();
            
            return $this->sendResponse($file, 'Archivo actualizado');
        } catch (Exception $th) {

            return $this->sendError('CssFilesController update', $th->getMessage(), $th->getCode());
        }
    }

    public function destroy(Request $request, $keyName, $id)
    {
        try {
            
            $template = Template::where('keyName', $keyName)->first();
            if (empty($template)) throw new Exception('Pagina no encontrada', 404);

            $tools = resolve(ToolsController::class);
            $css = $tools->getFrontEndFilesSchema($template->css);
            
            $path = $css->removeFile($id);
            
            //remove from server
            $tools->removeFile($path);

            $template->css = $css;
            $template->save();
            
            return $this->sendResponse($css->files, 'Se ha eliminado correctamente');
        } catch (Exception $th) {

            return $this->sendError('CssFilesController destroy', $th->getMessage(), $th->getCode());
        }
    }

}