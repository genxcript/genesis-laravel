<?php

namespace LaravelGenesis\Genesis\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MainController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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
