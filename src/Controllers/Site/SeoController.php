<?php

namespace Webdecero\CMS\Controllers\Site;

use Exception;
use Throwable;
use Validator;
use Webdecero\CMS\Models\Site\Seo;
use Webdecero\CMS\Models\Site\Site;
use Webdecero\CMS\Schemas\SeoSchema;
use Illuminate\Http\Request;
use Webdecero\CMS\Traits\ResponseApi;
use Illuminate\Support\Facades\Log;
use Webdecero\CMS\Controllers\Controller;

class SeoController extends Controller
{
    use ResponseApi;

    public function index(Request $request)
    {
        try {
            
            $site = Site::first();
            if (empty($site)) throw new Exception('Sitio no encontrado', 404);
            
            $seo = $site->seo;
            
            return $this->sendResponse($seo, 'Seo');
        } catch (Exception $th) {

            return $this->sendError('SeoController Index', $th->getMessage(), $th->getCode());
        }
    }

    public function show(Request $request, $lang)
    {
        try {
            
            $site = Site::first();
            if (empty($site)) throw new Exception('Sitio no encontrado', 404);
            
            $seo = $site->seo;

            if(empty($seo[$lang])) throw new Exception('Seo no encontrado', 404);

            return $this->sendResponse($seo[$lang], 'Seo');
        } catch (Exception $th) {

            return $this->sendError('SeoController Show', $th->getMessage(), $th->getCode());
        }
    }

    public function store(Request $request)
    {
        try {
            $input = $request->all();
            $rules = [
                'lang' => 'required|string',
                'title' => 'required|string',
                'description' => 'required|string',
                'metaTag' => 'array',
                'image' => 'string',
                'schema' => 'string'
            ];
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) return $this->sendError('Error de validación', $validator->errors()->all(), 422);
            
            $site = Site::first();
            if (empty($site)) throw new Exception('Sitio no encontrado', 404);

            if(!empty($site->seo)) $seo = new Seo($site->seo);
            else $seo = new Seo();
            $seoSchema = new SeoSchema($input['title'], $input['description'], $input['metaTag'], $input['image'], $input['schema']);
            $seo->addAttribute($input['lang'], $seoSchema);
            $site->seo = $seo->toArray();
            $site->save();

            return $this->sendResponse($seoSchema, 'Seo guardado');
        } catch (Exception $th) {
            return $this->sendError('SeoController Store', $th->getMessage(), $th->getCode());
        }
    }

    public function update(Request $request, $lang)
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
            
            $site = Site::first();
            if (empty($site)) throw new Exception('Sitio no encontrado', 404);

            $seo = $site->seo;
            if(empty($seo[$lang])) throw new Exception('Lang no encontrado', 404);
            
            $seo = new Seo($site->seo);
            $seoSchema = new SeoSchema($input['title'], $input['description'], $input['metaTag'], $input['image'], $input['schema']);
            $seo->addAttribute($lang, $seoSchema);
            $site->seo = $seo->toArray();
            $site->save();
            
            return $this->sendResponse($seoSchema, 'Se ha actualizado');
        } catch (Exception $th) {

            return $this->sendError('SeoController Update', $th->getMessage(), $th->getCode());
        }
    }

    public function destroy(Request $request, $lang) {
        try {
            
            $site = Site::first();
            if (empty($site)) throw new Exception('Sitio no encontrado', 404);

            
            $seo = new Seo($site->seo);
            $seo->removeAttribute($lang);
            $site->seo = $seo->toArray();
            $site->save();
            
            return $this->sendResponse($site->siteMap, 'Se ha eliminado');
        } catch (Exception $th) {

            return $this->sendError('SeoController Destroy', $th->getMessage(), $th->getCode());
        }
    }

}