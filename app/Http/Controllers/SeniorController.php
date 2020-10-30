<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Senior;
use App\Tahun;
use Illuminate\Support\Facades\Auth;

class SeniorController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new Helper;
    }

    public function index()
    {
        $ta = $this->helper->idTahunAktif();
        $senior = Senior::where('idtahun', $ta)
            ->where('jeniskelamin', (session('seniorstatus', Auth::user()->jeniskelamin)))->get();
        $senior = $this->sortSenior($senior);
        $tahun = $this->helper->tahunAktif();
        if($this->helper->isMobile())
            return view('m.senior.senior.index', [
                'tahun' => $tahun,
                'senior' => $senior
            ]);
        return view('senior.senior.index', [
            'tahun' => $tahun,
            'senior' => $senior
        ]);
    }
    
    public function indexX()
    {
        if(is_bool(session('seniorstatus', false))) {
            session(['seniorstatus' => Auth::user()->jeniskelamin===0 ? 1 : 0]);
        } else {
            session(['seniorstatus' => session('seniorstatus')===0 ? 1: 0]);
        }
        return redirect(route('senior.senior'));
    }

    public function detail($id)
    {
        $senior = Senior::where('id', $id)->where('idtahun', $this->helper->idTahunAktif())->first();
        $tahunsenior = Tahun::find($senior->idtahun);
        $tahun = Str::replaceFirst('/', '-', $tahunsenior->tahunajaran);
        
        if($senior===null) {
            return redirect(route('senior.senior'))->withErrors(['Senior Tidak Ditemukan!']);
        }

        if($this->helper->isMobile())
            return view('m.senior.senior.detail', [
                'senior' => $senior,
                'tahun' => $tahun,
            ]);
        
        return view('senior.senior.detail', [
            'senior' => $senior,
            'tahun' => $tahun,
        ]);
    }

    public function sortSenior($senior)
    {
        for ($j=0; $j < count($senior); $j++) { 
            for ($i=0; $i < count($senior)-1;$i++) { 
                if($senior[$i]->kamar->nomor > $senior[$i+1]->kamar->nomor){
                    $temp = $senior[$i+1];
                    $senior[$i+1] = $senior[$i];
                    $senior[$i] = $temp;
                }
            }
        }
        return $senior;
    }
}
