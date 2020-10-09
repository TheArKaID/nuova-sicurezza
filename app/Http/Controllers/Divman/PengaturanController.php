<?php

namespace App\Http\Controllers\Divman;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaturanController extends Controller
{
    protected $helper;
    
    public function __construct()
    {
        $this->helper = new Helper;
        
        $this->middleware(function ($request, $next) {
            if(!Auth::user()->isdivman)
                return redirect('/s');
                
            return $next($request);
        });
    }

    public function index()
    {
        $pengaturan = Pengaturan::first();
        
        if($this->helper->isMobile())
            return view('m.divman.pengaturan.index', [
                'pengaturan' => $pengaturan
            ]);

        return view('divman.pengaturan.index', [
            'pengaturan' => $pengaturan
        ]);
    }

    public function refreshToken()
    {
        $newtoken = rand(100000, 999999);
        $pengaturan = Pengaturan::first();
        $pengaturan->resettoken = $newtoken;
        $pengaturan->save();

        return redirect()->back()->with(['sukses' => 'Token Diperbaharui!']);
    }

    public function savePonsus(Request $request)
    {
        $this->validate($request, [
            'ponsus' => 'required|digits:6'
        ]);

        $pengaturan = Pengaturan::first();
        $pengaturan->ponsus = $request->ponsus;
        $pengaturan->save();

        return redirect()->back()->with(['sukses' => 'Kode Poin Khusus Diperbaharui!']);
    }
}
