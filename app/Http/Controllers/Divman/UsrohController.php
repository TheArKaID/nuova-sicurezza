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
        $ta = $this->helper->tahunAktif();
        $tahun = Tahun::find($ta)->first();
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
        $ta = $this->helper->tahunAktif();
        $tahun = Tahun::find($ta)->first();
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
            'usroh' => 'required',
            'lantai' => 'required',
            'gedung' => 'required'
        ]);

        $usroh = new Usroh;
        $usroh->idtahun = $this->helper->tahunAktif();
        $usroh->nama = $request->usroh;
        $usroh->lantai = $request->lantai;
        $usroh->gedung = $request->gedung;
        $usroh->save();

        return redirect(route('divman.usroh'));

    }
}
