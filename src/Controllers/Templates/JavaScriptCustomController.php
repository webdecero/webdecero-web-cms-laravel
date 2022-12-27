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

class JavaScriptCustomController extends Controller
{
    use ResponseApi;

    const NAME_CUSTOM_FILE = 'custom';

    public function showCustom(Request $request, $keyName)
    {
        try {
            $template = Template::where('keyName', $keyName)->first();
            if (empty($template)) throw new Exception('Pagina no encontrada', 404);

            $tools = resolve(ToolsController::class);
            $content = $tools->getContentCustomFile('templates/'.$keyName.'/js/custom', self::NAME_CUSTOM_FILE,'js');

            $jsCustom = $template->javaScript['custom'];
            $jsCustom['content'] = $content;

            return $this->sendResponse($jsCustom, 'Custom Js');
        } catch (Exception $th) {

            return $this->sendError('JavaScriptController showCustom', $th->getMessage(), $th->getCode());
        }
    }

    public function updateCustom(Request $request, $keyName)
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

            $tools = resolve(ToolsController::class);
            $pathCustom = $tools->updateCustomFile('templates/'.$keyName.'/js/custom', self::NAME_CUSTOM_FILE, 'js', $input['content']);
            
            if(empty($pathCustom)) throw new Exception('Error al guardar archivo custom', 500);
            
            $javaScript = $tools->getFrontEndFilesSchema($template->javaScript);
            $javaScript->addCustom(self::NAME_CUSTOM_FILE, $pathCustom);
            $template->javaScript = $javaScript;
            $template->save();
            $javaScript->custom->content = $input['content'];
            
            return $this->sendResponse($javaScript->custom, 'Se ha actualizado');
        } catch (Exception $th) {

            return $this->sendError('JavaScriptController updateCustom', $th->getMessage(), $th->getCode());
        }
    }

}