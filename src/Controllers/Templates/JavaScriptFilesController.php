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
use Webdecero\Webcms\Controllers\Utilities\ToolsController;

class JavaScriptFilesController extends Controller
{
    use ResponseApi;

    public function index(Request $request, $keyName)
    {
        try {
            $template = Template::where('keyName', $keyName)->first();
            if (empty($template)) throw new Exception('Pagina no encontrada', 404);

            $tools = resolve(ToolsController::class);
            $javaScript = $tools->getFrontEndFilesSchema($template->javaScript);

            $files = $javaScript->files;

            return $this->sendResponse($files, 'Files js');
        } catch (Exception $th) {

            return $this->sendError('JavaScriptFilesController index', $th->getMessage(), $th->getCode());
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
            $javaScript = $tools->getFrontEndFilesSchema($template->javaScript);

            $files = $javaScript->files;

            foreach($files as $file) {
                if($file['order'] == $input['order']) {
                    throw new Exception('Ya existe archivo con ese numero de orden', 409);
                }
            }
            
            $javaScript->addFile($fileNew);

            $template->javaScript = $javaScript;
            $template->save();
            
            return $this->sendResponse($javaScript->files, 'Se ha agregado correctamente');
        } catch (Exception $th) {

            return $this->sendError('JavaScriptFilesController store', $th->getMessage(), $th->getCode());
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
            $javaScript = $tools->getFrontEndFilesSchema($template->javaScript);

            $javaScript->files = $input['files'];

            $template->javaScript = $javaScript;
            $template->save();
            
            return $this->sendResponse($javaScript->files, 'Se ha actualizado');
        } catch (Exception $th) {

            return $this->sendError('JavaScriptFilesController updateAll', $th->getMessage(), $th->getCode());
        }
    }

    public function show(Request $request, $keyName, $id)
    {
        try {
            
            $template = Template::where('keyName', $keyName)->first();
            if (empty($template)) throw new Exception('Pagina no encontrada', 404);

            $tools = resolve(ToolsController::class);
            $javaScript = $tools->getFrontEndFilesSchema($template->javaScript);
            
            $file = $javaScript->getFile($id);
            
            return $this->sendResponse($file, 'Archivo encontrado');
        } catch (Exception $th) {

            return $this->sendError('JavaScriptFilesController show', $th->getMessage(), $th->getCode());
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
            $javaScript = $tools->getFrontEndFilesSchema($template->javaScript);
            
            $file = $javaScript->updateFile($id, $input);

            $template->javaScript = $javaScript;
            $template->save();
            
            return $this->sendResponse($file, 'Archivo actualizado');
        } catch (Exception $th) {

            return $this->sendError('JavaScriptFilesController update', $th->getMessage(), $th->getCode());
        }
    }

    public function destroy(Request $request, $keyName, $id)
    {
        try {
            
            $template = Template::where('keyName', $keyName)->first();
            if (empty($template)) throw new Exception('Pagina no encontrada', 404);

            $tools = resolve(ToolsController::class);
            $javaScript = $tools->getFrontEndFilesSchema($template->javaScript);
            
            $path = $javaScript->removeFile($id);
            
            //remove from server
            $tools->removeFile($path);

            $template->javaScript = $javaScript;
            $template->save();
            
            return $this->sendResponse($javaScript->files, 'Se ha eliminado correctamente');
        } catch (Exception $th) {

            return $this->sendError('JavaScriptFilesController destroy', $th->getMessage(), $th->getCode());
        }
    }

}