<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Tahun;
use App\Pengaturan;

class SeniorController extends Controller
{
    protected $mobile;

    public function __construct()
    {
        $this->mobile = new \Helper;
        $this->middleware('auth:senior');
    }

    public function index()
    {
        if($this->mobile->isMobile())
            return view('m.senior.dashboard');
        return view('senior.dashboard');
    }
}
