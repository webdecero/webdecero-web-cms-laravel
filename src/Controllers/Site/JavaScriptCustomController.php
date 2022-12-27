<?php

namespace Webdecero\Webcms\Controllers\Site;

use Exception;
use Throwable;
use Validator;
use Webdecero\Webcms\Models\Site\Site;
use Illuminate\Http\Request;
use Webdecero\Webcms\Traits\ResponseApi;
use Illuminate\Support\Facades\Log;
use Webdecero\Webcms\Controllers\Controller;
use Webdecero\Webcms\Controllers\Utilities\ToolsController;

class JavaScriptCustomController extends Controller
{
    use ResponseApi;

    const NAME_CUSTOM_FILE = 'custom';

    public function showCustom(Request $request)
    {
        try {
            $site = Site::first();
            if (empty($site)) throw new Exception('Sitio no encontrado', 404);

            $tools = resolve(ToolsController::class);
            $content = $tools->getContentCustomFile('site/js/custom', self::NAME_CUSTOM_FILE,'js');

            $jsCustom = $site->javaScript['custom'];
            $jsCustom['content'] = $content;

            return $this->sendResponse($jsCustom, 'Custom Js');
        } catch (Exception $th) {

            return $this->sendError('JavaScriptCustomController showCustom', $th->getMessage(), $th->getCode());
        }
    }

    public function updateCustom(Request $request)
    {
        try {
            $input = $request->all();
            $rules = [
                'content' => 'required|string'
            ];
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) return $this->sendError('Error de validación', $validator->errors()->all(), 422);
            
            $site = Site::first();
            if (empty($site)) throw new Exception('Sitio no encontrado', 404);
            $tools = resolve(ToolsController::class);
            $pathCustom = $tools->updateCustomFile('site/js/custom', self::NAME_CUSTOM_FILE, 'js', $input['content']);
            
            if(empty($pathCustom)) throw new Exception('Error al guardar archivo custom', 500);
            
            $javaScript = $tools->getFrontEndFilesSchema($site->javaScript);
            $javaScript->addCustom(self::NAME_CUSTOM_FILE, $pathCustom);
            $site->javaScript = $javaScript;
            $site->save();
            $javaScript->custom->content = $input['content'];
            
            return $this->sendResponse($javaScript->custom, 'Se ha actualizado');
        } catch (Exception $th) {

            return $this->sendError('JavaScriptCustomController updateCustom', $th->getMessage(), $th->getCode());
        }
    }

}