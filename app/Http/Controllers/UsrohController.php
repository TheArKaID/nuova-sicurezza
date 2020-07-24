<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Usroh;

class UsrohController extends Controller
{
    public function __construct()
    {
        $this->helper = new \Helper;
        $this->middleware('auth:senior');
    }

    public function index()
    {
        $ta = $this->helper->idTahunAktif();
        $tahun = $this->helper->tahunAktif();
        $usroh = Usroh::where('idtahun', $ta)->get();
        if($this->helper->isMobile())
            return view('m.senior.usroh.index', [
                'usroh' => $usroh,
                'tahun' => $tahun
            ]);

        return view('senior.usroh.index', [
            'usroh' => $usroh,
            'tahun' => $tahun
        ]);
    }

    public function detail($id)
    {
        $usroh = Usroh::where('id', $id)->where('idtahun', $this->helper->idTahunAktif())->first();
        
        if($usroh==null)
            return redirect()->back();

        if($this->helper->isMobile())
            return view('m.senior.usroh.detail', [
                'usroh' => $usroh
            ]);

        return view('senior.usroh.detail', [
            'usroh' => $usroh
        ]);
    }
}
