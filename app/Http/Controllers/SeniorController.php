<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Senior;

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
        $senior = Senior::where('idtahun', $ta)->where('jeniskelamin', (Cache::get('seniorstatus')))->get();
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
        Cache::put('seniorstatus', !(Cache::get('seniorstatus')));
        return redirect(route('senior.senior'));
    }

    public function detail($id)
    {
        $ta = $this->helper->idTahunAktif();
        $tahun = Str::replaceFirst('/', '-', $this->helper->tahunAktif());
        $senior = Senior::where('id', $id)->where('idtahun', $this->helper->idTahunAktif())->first();
        
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
