<?php

namespace LaravelGenesis\Genesis\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class MainController extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    public function dashboard()
    {
        return view('genesis::dashboard_container');
    }

    public function resourceIndex()
    {
        return view('genesis::dashboard_container');
    }

    public function resourceView()
    {
        return view('genesis::dashboard_container');
    }

    public function resourceEdit()
    {
        return view('genesis::dashboard_container');
    }
}
