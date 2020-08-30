<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tengko;
use App\Resident;
use App\Pencatatan;

class TengkoController extends Controller
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
        $ringan = Tengko::where('idtahun', $ta)->where('tipe', 'Ringan')->get();
        $sedang = Tengko::where('idtahun', $ta)->where('tipe', 'Sedang')->get();
        $berat = Tengko::where('idtahun', $ta)->where('tipe', 'Berat')->get();
        $tengko = array('ringan' => $ringan, 'sedang' => $sedang, 'berat' => $berat);
        
        $tahun = $this->helper->tahunAktif();
        if($this->helper->isMobile())
            return view('m.senior.tengko.index', [
                'tahun' => $tahun,
                'tengko' => $tengko,
            ]);
        
        return view('senior.tengko.index', [
            'tahun' => $tahun,
            'tengko' => $tengko,
        ]);
    }

    public function getPelanggaran($tipe)
    {
        $ta = $this->helper->idTahunAktif();
        $tengko = Tengko::where('idtahun', $ta)->where('tipe', $tipe)->get();
        $result = array();
        foreach ($tengko as $key => $value) {
            $res['id'] = $value['id'];
            $res['pelanggaran'] = $value['penjelasan'] .' - '. $value['poin'];
            array_push($result, $res);
        }
        
        return $result;
    }
}
