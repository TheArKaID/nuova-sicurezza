<?php

namespace App\Http\Controllers\Divman;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Tengko;

class TengkoController extends Controller
{
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
        $tengko = Tengko::where('idtahun', $ta)->get();
        $tahun = $this->helper->tahunAktif();
        if($this->helper->isMobile())
            return view('m.divman.tengko.index', [
                'tahun' => $tahun,
                'tengko' => $tengko,
            ]);
        
        return view('divman.tengko.index', [
            'tahun' => $tahun,
            'tengko' => $tengko,
        ]);
    }

    public function tambah()
    {
        $ta = $this->helper->idTahunAktif();
        $tahun = $this->helper->tahunAktif();
        if($this->helper->isMobile())
            return view('m.divman.tengko.tambah', [
                'tahun' => $tahun,
            ]);
        
        return view('divman.tengko.tambah', [
            'tahun' => $tahun,
        ]);
    }

    public function tambahTengko(Request $request)
    {
        $this->validate($request,[
            'tipe' => 'required',
            'penjelasan' => 'required'
        ]);

        $tengko = new Tengko;
        $tengko->idtahun = $this->helper->idTahunAktif();
        $tengko->tipe = $request->tipe;
        $tengko->penjelasan = $request->penjelasan;
        $tengko->save();
        
        return redirect(route('divman.tengko'));
    }
}
