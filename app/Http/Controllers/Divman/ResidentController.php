<?php

namespace App\Http\Controllers\Divman;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Resident;
use App\Usroh;

class ResidentController extends Controller
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
        $resident = Resident::where('idtahun', $ta)->get();
        $tahun = $this->helper->tahunAktif();
        if($this->helper->isMobile())
            return view('m.divman.resident.index', [
                'tahun' => $tahun,
                'resident' => $resident,
            ]);
        
        return view('divman.resident.index', [
            'tahun' => $tahun,
            'resident' => $resident,
        ]);
    }

    public function tambah()
    {
        $ta = $this->helper->idTahunAktif();
        $usroh = Usroh::where('idtahun', $ta)->get();
        $tahun = $this->helper->tahunAktif();
        if($this->helper->isMobile())
            return view('m.divman.resident.tambah', [
                'tahun' => $tahun,
                'usroh' => $usroh,
            ]);
        
        return view('divman.resident.tambah', [
            'tahun' => $tahun,
            'usroh' => $usroh,
        ]);
    }

    public function getKamar($idusroh)
    {
        $kamar = DB::table('kamar')
            ->select('kamar.id', 'kamar.nomor')
            ->leftJoin('resident', 'kamar.id', '=', 'resident.idkamar')
            ->leftJoin('senior', 'kamar.id', '=', 'senior.idkamar')
            ->where('kamar.idtahun', $this->helper->idTahunAktif())
            ->where('kamar.idusroh', $idusroh)
            ->whereNull('resident.idkamar')
            ->whereNull('senior.idkamar')
            ->get();
        if(count($kamar)===0)
            $kamar = 0;
        return $kamar;
    }
}
