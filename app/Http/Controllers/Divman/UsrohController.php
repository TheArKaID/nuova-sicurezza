<?php

namespace App\Http\Controllers\Divman;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use \App\Tahun;
use \App\Usroh;

class UsrohController extends Controller
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
        $usroh = Usroh::where('idtahun', $ta)->get();
        if($this->helper->isMobile())
            return view('m.divman.usroh.index', [
                'usroh' => $usroh,
                'tahun' => $tahun
            ]);

        return view('divman.usroh.index', [
            'usroh' => $usroh,
            'tahun' => $tahun
        ]);
    }

    public function tambah()
    {
        $ta = $this->helper->idTahunAktif();
        $tahun = $this->helper->tahunAktif();
        if($this->helper->isMobile())
            return view('m.divman.usroh.tambah', [
                'tahun' => $tahun
            ]);

        return view('divman.usroh.tambah', [
            'tahun' => $tahun
        ]);
    }

    public function tambahUsroh(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'lantai' => 'required',
            'gedung' => 'required'
        ]);

        $usroh = new Usroh;
        $usroh->idtahun = $this->helper->idTahunAktif();
        $usroh->nama = $request->nama;
        $usroh->lantai = $request->lantai;
        $usroh->gedung = $request->gedung;
        $usroh->save();

        return redirect(route('divman.usroh'));
    }

    public function detail($id)
    {
        $usroh = Usroh::where('id', $id)->where('idtahun', $this->helper->idTahunAktif())->first();
        
        if($usroh==null)
            return redirect()->back();

        if($this->helper->isMobile())
            return view('m.divman.usroh.detail', [
                'usroh' => $usroh
            ]);

        return view('divman.usroh.detail', [
            'usroh' => $usroh
        ]);
    }

    public function simpan(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'nama' => 'required',
            'lantai' => 'required',
            'gedung' => 'required'
        ]);

        $usroh = Usroh::where('id', $request->id)->where('idtahun', $this->helper->idTahunAktif())->first();
        $usroh->update($request->all());
        
        return redirect(route('divman.usroh'));
    }

    public function hapus($id)
    {
        $usroh = Usroh::where('id', $id)->where('idtahun', $this->helper->idTahunAktif())->first();
        $usroh->delete();
        
        return redirect(route('divman.usroh'));
    }
}
