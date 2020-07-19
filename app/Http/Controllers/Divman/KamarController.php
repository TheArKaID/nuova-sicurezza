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
        $ta = $this->helper->idTahunAktif();
        $tahun = $this->helper->tahunAktif();
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
        $ta = $this->helper->idTahunAktif();
        $tahun = $this->helper->tahunAktif();
        $usroh = Usroh::where('idtahun', $this->helper->idTahunAktif())->get();
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
        $kamar->idtahun = $this->helper->idTahunAktif();
        $kamar->nomor = $request->nomor;
        $kamar->idusroh = $request->idusroh;
        $kamar->save();
        
        return redirect(route('divman.kamar'));
    }

    public function detail($id)
    {
        $kamar = Kamar::where('id', $id)->where('idtahun', $this->helper->idTahunAktif())->first();
        $usroh = Usroh::where('idtahun', $this->helper->idTahunAktif())->get();
        
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

        $kamar = Kamar::where('id', $request->id)->where('idtahun', $this->helper->idTahunAktif())->first();
        $kamar->update($request->all());

        return redirect(route('divman.kamar'));
    }
    
    public function hapus($id)
    {
        $kamar = Kamar::where('id', $id)->where('idtahun', $this->helper->idTahunAktif())->first();
        $kamar->delete();
        
        return redirect(route('divman.kamar'));
    }

}
