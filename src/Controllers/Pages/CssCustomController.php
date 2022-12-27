<?php

namespace Webdecero\Webcms\Controllers\Pages;

use Exception;
use Throwable;
use Validator;
use Webdecero\Webcms\Models\Pages\Page;
use Webdecero\Webcms\Schemas\FileSchema;
use Illuminate\Http\Request;
use Webdecero\Webcms\Traits\ResponseApi;
use Illuminate\Support\Facades\Log;
use Webdecero\Webcms\Controllers\Controller;
use Webdecero\Webcms\Controllers\Utilities\ToolsController;

class CssCustomController extends Controller
{
    use ResponseApi;

    const NAME_CUSTOM_FILE = 'custom';

    public function showCustom(Request $request, $keyName)
    {
        try {
            $page = Page::where('keyName', $keyName)->first();
            if (empty($page)) throw new Exception('Pagina no encontrada', 404);

            $tools = resolve(ToolsController::class);
            $content = $tools->getContentCustomFile('pages/'.$keyName.'/css/custom', self::NAME_CUSTOM_FILE,'css');

            $jsCustom = $page->css['custom'];
            $jsCustom['content'] = $content;

            return $this->sendResponse($jsCustom, 'Custom Css');
        } catch (Exception $th) {

            return $this->sendError('CssCustomController showCustom', $th->getMessage(), $th->getCode());
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
            
            $page = Page::where('keyName', $keyName)->first();
            if (empty($page)) throw new Exception('Pagina no encontrada', 404);

            $tools = resolve(ToolsController::class);
            $pathCustom = $tools->updateCustomFile('pages/'.$keyName.'/css/custom', self::NAME_CUSTOM_FILE, 'css', $input['content']);
            
            if(empty($pathCustom)) throw new Exception('Error al guardar archivo custom', 500);
            
            $css = $tools->getFrontEndFilesSchema($page->css);
            $css->addCustom(self::NAME_CUSTOM_FILE, $pathCustom);
            $page->css = $css;
            $page->save();
            $css->custom->content = $input['content'];
            
            return $this->sendResponse($css->custom, 'Se ha actualizado');
        } catch (Exception $th) {

            return $this->sendError('CssCustomController updateCustom', $th->getMessage(), $th->getCode());
        }
    }

}