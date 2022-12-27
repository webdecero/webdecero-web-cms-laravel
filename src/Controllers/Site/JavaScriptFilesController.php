<?php

namespace Webdecero\Webcms\Controllers\Site;

use Exception;
use Throwable;
use Validator;
use Webdecero\Webcms\Models\Site\Site;
use Webdecero\Webcms\Schemas\FileSchema;
use Illuminate\Http\Request;
use Webdecero\Webcms\Traits\ResponseApi;
use Illuminate\Support\Facades\Log;
use Webdecero\Webcms\Controllers\Controller;
use Webdecero\Webcms\Controllers\Utilities\ToolsController;

class JavaScriptFilesController extends Controller
{
    use ResponseApi;

    public function index(Request $request)
    {
        try {
            $site = Site::first();
            if (empty($site)) throw new Exception('Sitio no encontrado', 404);

            $tools = resolve(ToolsController::class);
            $javaScript = $tools->getFrontEndFilesSchema($site->javaScript);

            $files = $javaScript->files;

            return $this->sendResponse($files, 'Files Css');
        } catch (Exception $th) {

            return $this->sendError('JavaScriptFilesController index', $th->getMessage(), $th->getCode());
        }
    }

    public function store(Request $request)
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
            
            $site = Site::first();
            if (empty($site)) throw new Exception('Sitio no encontrado', 404);

            $fileNew = new FileSchema($input['name'], $input['pathFile'], $input['type'], $input['order']);
            
            $tools = resolve(ToolsController::class);
            $javaScript = $tools->getFrontEndFilesSchema($site->javaScript);

            $files = $javaScript->files;

            foreach($files as $file) {
                if($file['order'] == $input['order']) {
                    throw new Exception('Ya existe archivo con ese numero de orden', 409);
                }
            }
            
            $javaScript->addFile($fileNew);

            $site->javaScript = $javaScript;
            $site->save();
            
            return $this->sendResponse($javaScript->files, 'Se ha agregado correctamente');
        } catch (Exception $th) {

            return $this->sendError('JavaScriptFilesController store', $th->getMessage(), $th->getCode());
        }
    }

    public function updateAll(Request $request)
    {
        try {
            $input = $request->all();
            $rules = [
                'files' => 'required'
            ];
            
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) return $this->sendError('Error de validación', $validator->errors()->all(), 422);
            
            $site = Site::first();
            if (empty($site)) throw new Exception('Sitio no encontrado', 404);

            $tools = resolve(ToolsController::class);
            $javaScript = $tools->getFrontEndFilesSchema($site->javaScript);

            $javaScript->files = $input['files'];

            $site->javaScript = $javaScript;
            $site->save();
            
            return $this->sendResponse($javaScript->files, 'Se ha actualizado');
        } catch (Exception $th) {

            return $this->sendError('JavaScriptFilesController updateAll', $th->getMessage(), $th->getCode());
        }
    }

    public function show(Request $request, $id)
    {
        try {
            
            $site = Site::first();
            if (empty($site)) throw new Exception('Sitio no encontrado', 404);

            $tools = resolve(ToolsController::class);
            $javaScript = $tools->getFrontEndFilesSchema($site->javaScript);
            
            $file = $javaScript->getFile($id);
            
            return $this->sendResponse($file, 'Archivo encontrado');
        } catch (Exception $th) {

            return $this->sendError('JavaScriptFilesController show', $th->getMessage(), $th->getCode());
        }
    }

    public function update(Request $request, $id)
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

            $site = Site::first();
            if (empty($site)) throw new Exception('Sitio no encontrado', 404);

            $tools = resolve(ToolsController::class);
            $javaScript = $tools->getFrontEndFilesSchema($site->javaScript);
            
            $file = $javaScript->updateFile($id, $input);

            $site->javaScript = $javaScript;
            $site->save();
            
            return $this->sendResponse($file, 'Archivo actualizado');
        } catch (Exception $th) {

            return $this->sendError('JavaScriptFilesController update', $th->getMessage(), $th->getCode());
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            
            $site = Site::first();
            if (empty($site)) throw new Exception('Sitio no encontrado', 404);

            $tools = resolve(ToolsController::class);
            $javaScript = $tools->getFrontEndFilesSchema($site->javaScript);
            
            $path = $javaScript->removeFile($id);
            
            //remove from server
            $tools->removeFile($path);

            $site->javaScript = $javaScript;
            $site->save();
            
            return $this->sendResponse($javaScript->files, 'Se ha eliminado correctamente');
        } catch (Exception $th) {

            return $this->sendError('JavaScriptFilesController destroy', $th->getMessage(), $th->getCode());
        }
    }

}