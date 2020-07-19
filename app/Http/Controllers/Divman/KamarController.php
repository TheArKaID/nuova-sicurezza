<?php

namespace App\Http\Controllers\Divman;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Kamar;
use App\Tahun;
use App\Usroh;

class KamarController extends Controller
{
    protected $helper;
    
    public function __construct()
    {
        $this->helper = new \Helper;
        $this->middleware('auth:senior');
        $this->middleware(function ($request, $next) {
            if(!Auth::user()->isdivman)
                return redirect('/s');
                
            return $next($request);
        });
    }

    public function index()
    {
        $ta = $this->helper->tahunAktif();
        $tahun = Tahun::find($ta)->first();
        $kamar = Kamar::where('idtahun', $ta)->get();
        if($this->helper->isMobile())
            return view('m.divman.kamar.index', [
                'tahun' => $tahun,
                'kamar' => $kamar
            ]);

        return view('divman.kamar.index', [
            'tahun' => $tahun,
            'kamar' => $kamar
        ]);
    }

    public function tambah()
    {
        $ta = $this->helper->tahunAktif();
        $tahun = Tahun::find($ta)->first();
        $usroh = Usroh::where('idtahun', $this->helper->tahunAktif())->get();
        if($this->helper->isMobile())
            return view('m.divman.kamar.tambah', [
                'tahun' => $tahun,
                'usroh' => $usroh
            ]);

        return view('divman.kamar.tambah', [
            'tahun' => $tahun,
            'usroh' => $usroh
        ]);
    }

    public function tambahKamar(Request $request)
    {
        $this->validate($request,[
            'nomor' => 'required',
            'idusroh' => 'required'
        ]);

        $kamar = new Kamar;
        $kamar->idtahun = $this->helper->tahunAktif();
        $kamar->nomor = $request->nomor;
        $kamar->idusroh = $request->idusroh;
        $kamar->save();
        
        return redirect(route('divman.kamar'));
    }

    public function detail($id)
    {
        $kamar = Kamar::where('id', $id)->where('idtahun', $this->helper->tahunAktif())->first();
        $usroh = Usroh::where('idtahun', $this->helper->tahunAktif())->get();
        
        if($this->helper->isMobile())
            return view('m.divman.kamar.detail', [
                'kamar' => $kamar,
                'usroh' => $usroh
            ]);

        return view('divman.kamar.detail', [
            'kamar' => $kamar,
            'usroh' => $usroh
        ]);
    }

    public function simpan(Request $request)
    {
        $this->validate($request, [
            'nomor' => 'required',
            'idusroh' => 'required'
        ]);

        $kamar = Kamar::where('id', $request->id)->where('idtahun', $this->helper->tahunAktif())->first();
        $kamar->update($request->all());

        return redirect(route('divman.kamar'));
    }
}
