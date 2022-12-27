<?php

namespace Webdecero\CMS\Controllers\Manager;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Webdecero\CMS\Traits\ResponseApi;



class ManagerController extends BaseController
{

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    use ResponseApi;

    protected $managerConfig = [];

    public function __construct()
    {


        $this->managerConfig = config('webcms.settings.manager');

        setlocale(LC_ALL, config('webcms.settings.manager.settings.setlocale'));

        // $this->middleware(function ($request, $next) {

        //     $this->data['user'] = \Auth::user();

        //     return $next($request);
        // });
    }

    public function home() {
        $data['host'] = url('/');
        return view('manager.index', $data);
    }
}