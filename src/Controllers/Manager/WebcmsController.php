<?php

namespace Webdecero\Webcms\Controllers\Manager;

use Illuminate\Support\Facades\Log;
use Webdecero\Webcms\Models\Site\Site;
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
        $site = Site::first();
        $settings = $site->settings;

        $data['title'] = $settings['name'];
        $data['host'] = $settings['urlBase'].'/webcms';
        $config = $this->webcmsConfig;
        $config['baseUrl'] = $settings['urlBase'].'/';
        $config['baseApi'] = $settings['urlBase'].'/api-webcms/';
        $data['config'] = json_encode($config); 

        $data['storagePath'] = url('/');  
        return view('manager.index', $data);
    }
}