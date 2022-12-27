<?php

namespace Webdecero\Webcms\Controllers\Utilities;

use Exception;
use Throwable;
use Validator;
use Illuminate\Http\Request;
use Webdecero\Webcms\Traits\ResponseApi;
use Illuminate\Support\Facades\Log;
use Webdecero\Webcms\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ConfigurationsController extends Controller
{
    use ResponseApi;

    private $_basePath = '';

    public function __construct()
    {
        $this->_basePath = config('cms.base_path');
    }
    
    public function getBaseUri(Request $request)
    {
        return $this->sendResponse($this->_basePath, 'Path base api');
    }

}