<?php

namespace Webdecero\CMS\Controllers\Site;

use Exception;
use Throwable;
use Validator;
use Webdecero\CMS\Models\Site\Site;
use Illuminate\Http\Request;
use Webdecero\CMS\Traits\ResponseApi;
use Illuminate\Support\Facades\Log;
use Webdecero\CMS\Controllers\Controller;
use Webdecero\CMS\Controllers\Utilities\ToolsController;

class CssCustomController extends Controller
{
    use ResponseApi;

    const NAME_CUSTOM_FILE = 'custom';

    public function showCustom(Request $request)
    {
        try {
            $site = Site::first();
            if (empty($site)) throw new Exception('Sitio no encontrado', 404);

            $tools = resolve(ToolsController::class);
            $content = $tools->getContentCustomFile('site/css/custom',self::NAME_CUSTOM_FILE,'css');

            $cssCustom = $site->css['custom'];
            $cssCustom['content'] = $content;

            return $this->sendResponse($cssCustom, 'Custom Css');
        } catch (Exception $th) {

            return $this->sendError('CssCustomController showCustom', $th->getMessage(), $th->getCode());
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
            $pathCustom = $tools->updateCustomFile('site/css/custom', self::NAME_CUSTOM_FILE, 'css', $input['content']);
            
            $css = $tools->getFrontEndFilesSchema($site->css);
            $css->addCustom(self::NAME_CUSTOM_FILE, $pathCustom);
            $site->css = $css;
            $site->save();
            $css->custom->content = $input['content'];
            
            return $this->sendResponse($css->custom, 'Se ha actualizado');
        } catch (Exception $th) {

            return $this->sendError('CssCustomController updateCustom', $th->getMessage(), $th->getCode());
        }
    }

}