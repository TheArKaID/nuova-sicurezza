<?php

namespace App\Http\Controllers\Divman;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    protected $mobile;
    
    public function __construct()
    {
        $this->mobile = new \Helper;
        $this->middleware('auth:senior');
        $this->middleware(function ($request, $next) {
            if(!Auth::user()->isdivman)
                return redirect('/s');
                
            return $next($request);
        });
    }

    public function index()
    {
        if($this->helper->isMobile())
            return view('m.divman.tahun', [
                'tahun' => $tahun,
                'pengaturan' => $pengaturan
            ]);
    }
    
}
