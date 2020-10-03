<?php

namespace App\Http\Controllers\Divman;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Resident;

class PoinController extends Controller
{
    
    protected $helper;
    
    public function __construct()
    {
        $this->helper = new Helper;
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

        $resident = Resident::where('resident.idtahun', $ta)->paginate(16);

        if($this->helper->isMobile())
            return view('m.divman.poin.index', [
                'tahun' => $tahun,
                'resident' => $resident
            ]);

        return view('divman.poin.index', [
            'tahun' => $tahun,
            'resident' => $resident
        ]);
    }
}
