<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Resident;
use App\Tahun;
use App\Pengaturan;
use App\Senior;

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
        $ta = $this->helper->idTahunAktif();
        $senior = Senior::where('idtahun', $ta)->get();
        $tahun = $this->helper->tahunAktif();
        if($this->helper->isMobile())
            return view('m.senior.senior.index', [
                'tahun' => $tahun,
                'senior' => $senior
            ]);
        return view('senior.senior.index', [
            'tahun' => $tahun,
            'senior' => $senior
        ]);
    }

    public function resident()
    {
        $resident = Resident::where('idtahun', $this->helper->idTahunAktif())->get();
        if($this->helper->isMobile())
            return view('m.senior.resident.index', ['resident'=>$resident]);
        return view('senior.resident.index', ['resident'=>$resident]);
    }
}
