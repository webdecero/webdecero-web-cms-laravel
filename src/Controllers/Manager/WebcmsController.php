<?php

namespace Webdecero\Webcms\Controllers\Manager;

use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Webdecero\Webcms\Traits\ResponseApi;



class WebcmsController extends BaseController
{

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    use ResponseApi;

    protected $webcmsConfig = [];

    public function __construct()
    {


        $this->webcmsConfig = config('webdecero.webcms');
        //Log::info(json_encode($this->webcmsConfig));
        
        //setlocale(LC_ALL, config('webcms.settings.manager.settings.setlocale'));

        // $this->middleware(function ($request, $next) {

        //     $this->data['user'] = \Auth::user();

        //     return $next($request);
        // });
    }

    public function home() {
        $host = url('/');
        $data['host'] = $host.'/webcms/';
        $config = $this->webcmsConfig;
        $config['baseUrl'] = $host.'/';
        $config['baseApi'] = $host.'/api-webcms/';
        $data['config'] = json_encode($config); 

        return view('manager.index', $data);
    }
}