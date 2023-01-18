<?php

namespace Webdecero\Webcms\Controllers\Templates;

use Exception;
use Throwable;
use Validator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use MongoDB\BSON\UTCDateTime;
use Webdecero\Webcms\Traits\ResponseApi;
use Webdecero\Webcms\Models\Templates\Template;
use Illuminate\Support\Facades\Log;
use Webdecero\Webcms\Schemas\FrontEndFilesSchema;
use Webdecero\Webcms\Controllers\Controller;
use Webdecero\Webcms\Controllers\Utilities\ToolsController;

class TemplatesController extends Controller
{
    use ResponseApi;

    private $_titleH = 'Header WDC';
    private $_keyNameH = "header_wdc";
    private $_typeH = "header";

    private $_titleM = 'Main WDC';
    private $_keyNameM = "main_wdc";
    private $_typeM = "main";

    private $_titleF = 'Footer WDC';
    private $_keyNameF = "footer_wdc";
    private $_typeF = "footer";

    private $_content = "";



    public function search (Request $request, $type) 
    {
        try {
            $query = $request->input('query', false);
            $paginate = (int)$request->get('item', 25);
            $initDate = $request->input('initDate', null);
            $endDate = $request->input('endDate', null);

            $queryMongo = [];

            if ($query) {
                $queryMongo['$and'][]
                    = [
                        "title" => ['$eq' => "$query"]
                    ];
            }

            if (!empty($initDate)) {

                $queryMongo['$and'][]
                    = [
                        'created_at' => [
                            '$gte' => new UTCDateTime(new Carbon($initDate)),
                        ]
                    ];
            }

            if (!empty($endDate)) {

                $queryMongo['$and'][]
                    = [
                        'created_at' => [
                            '$lt' => new UTCDateTime(Carbon::parse($endDate)->addHour(23)),
                        ]
                    ];
            }

            if (!empty($queryMongo)) {
                $templates = Template::where('type',$type)->whereRaw($queryMongo)->select('keyName', 'title', 'updated_at', 'created_at')->orderBy('_id', 'desc')->paginate($paginate);;
            } else {
                $templates = Template::where('type',$type)->select('keyName', 'title', 'updated_at', 'created_at')->orderBy('_id', 'desc')->paginate($paginate);;
            }
            
            

            return $this->sendResponse($templates, 'Templates');
        } catch (Exception $th) {
            return $this->sendError('TemplatesController index', $th->getMessage(), $th->getCode());
        }
    }

    public function show (Request $request, $keyName) 
    {
        try {
            $template = Template::where('keyName', $keyName)->first();
            if (empty($template)) throw new Exception('Template no encontrado', 404);

            return $this->sendResponse($template, 'Template encontrado');
        } catch (Exception $th) {
            return $this->sendError('TemplatesController show', $th->getMessage(), $th->getCode());
        }
    }

    public function store (Request $request) 
    {
        try {

            $input = $request->all();
            $rules = [
                'title' => 'required|string',
                'keyName' => 'required|string',
                'type' => 'required|string'
            ];
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) return $this->sendError('Error de validación', $validator->errors()->all(), 422);

            $css = new FrontEndFilesSchema([],'', '');
            
            $javaScript = new FrontEndFilesSchema([],'', '');
            
            $template = new Template();
            $template->fill($input);
            $template->css = $css;
            $template->javaScript = $javaScript;
            $template->content = '';
            $template->save();

            return $this->sendResponse($template, 'Template creado');
        } catch (Exception $th) {
            return $this->sendError('TemplatesController store', $th->getMessage(), $th->getCode());
        }
    }


    public function createTemplates (FrontEndFilesSchema $css, FrontEndFilesSchema $javaScript) 
    {
        try {
            
            $template = new Template();
            $template->title = $this->_titleH;
            $template->keyName = $this->_keyNameH;
            $template->type = $this->_typeH;
            $template->css = $css;
            $template->javaScript = $javaScript;
            $template->content = $this->_content;
            $template->save();

            $template = new Template();
            $template->title = $this->_titleM;
            $template->keyName = $this->_keyNameM;
            $template->type = $this->_typeM;
            $template->css = $css;
            $template->javaScript = $javaScript;
            $template->content = $this->_content;
            $template->save();

            $template = new Template();
            $template->title = $this->_titleF;
            $template->keyName = $this->_keyNameF;
            $template->type = $this->_typeF;
            $template->css = $css;
            $template->javaScript = $javaScript;
            $template->content = $this->_content;
            $template->save();

            return true;
        } catch (Exception $th) {
            return $this->sendError('TemplatesController createTemplates', $th->getMessage(), $th->getCode());
        }
    }

    public function update (Request $request, $keyName) 
    {
        try {

            $input = $request->all();
            $rules = [
                'title' => 'required|string',
                'keyName' => 'required|string'
            ];
            $validator = Validator::make($input, $rules);
            if ($validator->fails()) return $this->sendError('Error de validación', $validator->errors()->all(), 422);

            $template = Template::where('keyName', $keyName)->first();
            if (empty($template)) throw new Exception('Template no encontrado', 404);

            $template->fill($input);
            $template->save();

            return $this->sendResponse($template, 'Template actualizado');
        } catch (Exception $th) {
            return $this->sendError('TemplatesController update', $th->getMessage(), $th->getCode());
        }
    }

    public function destroy (Request $request, $keyName) 
    {
        try {
            $template = Template::where('keyName', $keyName)->first();
            if (empty($template)) throw new Exception('Template no encontrado', 404);

            $template->delete();

            return $this->sendResponse(true, 'Template eliminado');
        } catch (Exception $th) {
            return $this->sendError('TemplatesController destroy', $th->getMessage(), $th->getCode());
        }
    }

    public function validateKeyName(Request $request)
    {
        try {
            $input = $request->all();
            $rules = [
                'keyName' => 'required|string'
            ];

            $validator = Validator::make($input, $rules);
            if ($validator->fails()) return $this->sendError('Error de validación', $validator->errors()->all(), 422);

            $template = Template::where('keyName', $input['keyName'])->first();

            $data = [
                'validation' => false
            ];

            if (empty($template)) return $this->sendResponse($data, 'No existe template');

            $data['validation'] = true;

            return $this->sendResponse($data, 'Existe template');
        } catch (Exception $th) {
            return $this->sendError('TemplatesController validateKeyName', $th->getMessage(), $th->getCode());
        }
    }

}