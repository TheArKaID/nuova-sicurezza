<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Resident;
use App\Tahun;
use App\Pengaturan;

class SeniorController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new \Helper;
        $this->middleware('auth:senior');
    }

    public function index()
    {
        if($this->helper->isMobile())
            return view('m.senior.dashboard');
        return view('senior.dashboard');
    }

    public function resident()
    {
        $resident = Resident::where('idtahun', $this->helper->idTahunAktif())->get();
        if($this->helper->isMobile())
            return view('m.senior.resident', ['resident'=>$resident]);
        return view('senior.resident', ['resident'=>$resident]);
    }
}
