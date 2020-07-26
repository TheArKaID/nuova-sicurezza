<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resident;
use App\Usroh;
use App\Pencatatan;

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
        $tahun = $this->helper->tahunAktif();
        $resident = Resident::where('idtahun', $this->helper->idTahunAktif())->get();
        $resident = $this->sortResidentByKamar($resident);
        $resident = $this->sortResidentByUsroh($resident);
        if($this->helper->isMobile())
            return view('m.senior.resident.index', [
                'resident'=> $resident,
                'tahun' => $tahun
            ]);
        return view('senior.resident.index', [
            'resident'=> $resident,
            'tahun' => $tahun
        ]);
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
            'resident' => $resident,
            'tahun' => $tahun,
        ]);
    }
    
    public function poin($id)
    {
        $ta = $this->helper->idTahunAktif();
        $resident = Resident::where('id', $id)->where('idtahun', $this->helper->idTahunAktif())->first();
        $pencatatan = Pencatatan::where('idresident', $id)->where('idtahun', $this->helper->idTahunAktif())->get();

        if($this->helper->isMobile())
            return view('m.senior.resident.poin', [
                'resident' => $resident,
                'pencatatan' => $pencatatan
            ]);
        
        return view('senior.resident.poin', [
            'resident' => $resident,
            'pencatatan' => $pencatatan
        ]);
    }

    public function tambahPoin(Request $request)
    {
        $ta = $this->helper->idTahunAktif();
        $resident = Resident::where('id', $id)->where('idtahun', $this->helper->idTahunAktif())->first();
        if($resident->usroh->id!=\Auth::user()->usroh->id)
            return redirect()->back();
    }
    public function sortResidentByUsroh($resident)
    {
        $datas = array();
        $usroh = Usroh::where('idtahun', $this->helper->idTahunAktif())->get();
        foreach ($usroh as $key => $value) {
            $data = array();
            foreach ($resident as $k => $v) {
                if($v->usroh->id==$value->id){
                    array_push($data, $v);
                }
            }
            $datas[$value->nama] = $data;
        }
        return $datas;
    }

    public function sortResidentByKamar($resident)
    {
        for ($j=0; $j < count($resident); $j++) { 
            for ($i=0; $i < count($resident)-1;$i++) { 
                if($resident[$i]->kamar->nomor > $resident[$i+1]->kamar->nomor){
                    $temp = $resident[$i+1];
                    $resident[$i+1] = $resident[$i];
                    $resident[$i] = $temp;
                }
            }
        }
        return $resident;
    }
}
