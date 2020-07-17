<?php

namespace App\Http\Controllers\Divman;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use \App\Tahun;

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
        if($this->helper->isMobile())
            return view('m.divman.usroh', [
                'tahun' => $tahun
            ]);
    }
}
