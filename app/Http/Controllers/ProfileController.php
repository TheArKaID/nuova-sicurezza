<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Helpers\Helper;
use App\Senior;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $helper;
    
    public function __construct()
    {
        $this->helper = new Helper;
    }

    public function index()
    {
        $senior = Auth::user();
        $tahun = Str ::replaceFirst('/', '-', $this->helper->tahunAktif());
        
        if($this->helper->isMobile())
            return view('m.senior.profile.index', [
                'tahun' => $tahun,
                'profile' => $senior
                
            ]);
        
        return view('senior.profile.index', [
            'tahun' => $tahun,
            'profile' => $senior
            
        ]);
    }
}
