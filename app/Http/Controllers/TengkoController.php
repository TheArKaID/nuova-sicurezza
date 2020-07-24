<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tengko;

class TengkoController extends Controller
{
    public function __construct()
    {
        $this->helper = new \Helper;
        $this->middleware('auth:senior');
    }

    public function index()
    {
        $ta = $this->helper->idTahunAktif();
        $tengko = Tengko::where('idtahun', $ta)->get();
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
}
