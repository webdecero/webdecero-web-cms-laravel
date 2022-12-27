<?php

namespace Webdecero\CMS\Controllers\Utilities;

use Exception;
use Throwable;
use Validator;
use Illuminate\Http\Request;
use Webdecero\CMS\Traits\ResponseApi;
use Illuminate\Support\Facades\Log;
use Webdecero\CMS\Controllers\Controller;
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