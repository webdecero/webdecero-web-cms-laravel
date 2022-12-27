<?php

namespace Webdecero\CMS\Controllers\SiteMap;

use Exception;
use Throwable;
use Validator;
use Webdecero\CMS\Models\SiteMap\SiteMap;
use Illuminate\Http\Request;
use Webdecero\CMS\Traits\ResponseApi;
use Illuminate\Support\Facades\Log;
use Webdecero\CMS\Controllers\Controller;
use Webdecero\CMS\Controllers\Utilities\ToolsController;

class SiteMapController extends Controller
{
    use ResponseApi;

    public function index(Request $request)
    {
        try {
            
            $siteMaps = SiteMap::all();
            
            return $this->sendResponse($siteMaps, 'Lista de SiteMaps');
        } catch (Exception $th) {

            return $this->sendError('SiteMapController Index', $th->getMessage(), $th->getCode());
        }
    }

    public function show(Request $request, $lang)
    {
        try {
            
            $siteMap = SiteMap::where('lang',$lang)->first();
            
            if(empty($siteMap)) throw new Exception('SiteMap no encontrado', 404);

            return $this->sendResponse($siteMap, 'SiteMap');
        } catch (Exception $th) {

            return $this->sendError('SiteMapController Show', $th->getMessage(), $th->getCode());
        }
    }

    public function store(Request $request)
    {
        try {
            
            $input = $request->all();
            
            $rules = [
                'keyNameSite' => 'sometimes',
                'lang' => 'required|string',
            ];
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) return $this->sendError('Error de validación', $validator->errors()->all(), 422);

            $siteMap = new SiteMap();
            $siteMap->fill($input);
            // $siteMap->map = array();
            $siteMap->save();
            
            return $this->sendResponse($siteMap, 'SiteMap guardado');
        } catch (Exception $th) {

            return $this->sendError('SiteMapController Store', $th->getMessage(), $th->getCode());
        }
    }

    public function update(Request $request, $lang)
    {
        try {
            $input = $request->all();
            $rules = [
                'map' => 'sometimes'
            ];
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) return $this->sendError('Error de validación', $validator->errors()->all(), 422);
            
            $siteMap = SiteMap::where('lang',$lang)->first();
            
            $siteMap->map = !empty($input['map']) ? $input['map'] : [];
            $siteMap->save();
            
            return $this->sendResponse($siteMap, 'Se ha actualizado');
        } catch (Exception $th) {

            return $this->sendError('SiteMapController Update', $th->getMessage(), $th->getCode());
        }
    }

    public function destroy(Request $request, $lang) {
        try {
            
            $siteMap = SiteMap::where('lang',$lang)->first();
            $siteMap->delete();

            return $this->sendResponse($siteMap, 'Se ha eliminado');
        } catch (Exception $th) {

            return $this->sendError('SiteMapController Destroy', $th->getMessage(), $th->getCode());
        }
    }
}