<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;

class DashboardController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new Helper;
        $this->middleware('auth:senior');
    }

    public function index()
    {
        if($this->helper->isMobile())
            return view('m.senior.dashboard');
        return view('senior.dashboard');
    }
}
