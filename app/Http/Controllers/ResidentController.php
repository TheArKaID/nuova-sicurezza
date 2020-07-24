<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resident;

class ResidentController extends Controller
{    
    protected $helper;

    public function __construct()
    {
        $this->helper = new \Helper;
        $this->middleware('auth:senior');
    }

    public function index()
    {
        $resident = Resident::where('idtahun', $this->helper->idTahunAktif())->get();
        if($this->helper->isMobile())
            return view('m.senior.resident.index', ['resident'=>$resident]);
        return view('senior.resident.index', ['resident'=>$resident]);
    }

    public function detail($id)
    {
        $ta = $this->helper->idTahunAktif();
        $tahun = \Str::replaceFirst('/', '-', $this->helper->tahunAktif());
        $resident = Resident::where('id', $id)->where('idtahun', $this->helper->idTahunAktif())->first();
        
        if($this->helper->isMobile())
            return view('m.senior.resident.detail', [
                'resident' => $resident,
                'tahun' => $tahun,
            ]);
        
        return view('senior.resident.detail', [
            'resident' => $senior,
            'tahun' => $tahun,
        ]);
    }
}
