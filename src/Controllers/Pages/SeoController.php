<?php

namespace Webdecero\CMS\Controllers\Pages;

use Exception;
use Throwable;
use Validator;
use Webdecero\CMS\Schemas\SeoSchema;
use Webdecero\CMS\Models\Pages\Page;
use Illuminate\Http\Request;
use Webdecero\CMS\Traits\ResponseApi;
use Illuminate\Support\Facades\Log;
use Webdecero\CMS\Controllers\Controller;

class SeoController extends Controller
{
    use ResponseApi;

    public function show(Request $request, $keyName)
    {
        try {
            
            $page = Page::where('keyName', $keyName)->first();
            if (empty($page)) throw new Exception('Pagina no encontrada', 404);
            
            $seo = $page->seo;
            
            return $this->sendResponse($seo, 'Seo');
        } catch (Exception $th) {

            return $this->sendError('SeoController Show', $th->getMessage(), $th->getCode());
        }
    }

    public function update(Request $request, $keyName)
    {
        try {
            
            $input = $request->all();
            $rules = [
                'title' => 'required|string',
                'description' => 'required|string',
                'metaTag' => 'array',
                'image' => 'string',
                'schema' => 'string'
            ];
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) return $this->sendError('Error de validación', $validator->errors()->all(), 422);
            
            $page = Page::where('keyName', $keyName)->first();
            if (empty($page)) throw new Exception('Pagina no encontrada', 404);
            
            $seo = new SeoSchema($input['title'], $input['description'], $input['metaTag'], $input['image'], $input['schema']);
            $page->seo = $seo;
            $page->save();
            
            return $this->sendResponse($seo, 'Se ha actualizado');
        } catch (Exception $th) {

            return $this->sendError('SeoController Update', $th->getMessage(), $th->getCode());
        }
    }

}