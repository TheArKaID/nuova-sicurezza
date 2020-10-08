<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Helpers\Helper;
use App\Usroh;
use App\Senior;
use App\Resident;

class UsrohController extends Controller
{
    public function __construct()
    {
        $this->helper = new Helper;
    }

    public function index()
    {
        $ta = $this->helper->idTahunAktif();
        $tahun = $this->helper->tahunAktif();
        $usroh = Usroh::where('idtahun', $ta)
            ->where('jeniskelamin', Auth::user()->jeniskelamin)->get();
        
        if($this->helper->isMobile())
            return view('m.senior.usroh.index', [
                'usroh' => $usroh,
                'tahun' => $tahun
            ]);

        return view('senior.usroh.index', [
            'usroh' => $usroh,
            'tahun' => $tahun
        ]);
    }

    public function detail($id)
    {
        $is = Auth::user()->jeniskelamin==1 ? "=" : "!=";
        $tahun = Str::replaceFirst('/', '-', $this->helper->tahunAktif());
        $usroh = Usroh::where('id', $id)->where('idtahun', $this->helper->idTahunAktif())
            ->where('jeniskelamin', Auth::user()->jeniskelamin)->first();

        if($usroh===NULL)
            return redirect(route('senior.usroh'));

        $resident = Resident::where('idusroh', $id)
                            ->where('idtahun', $this->helper->idTahunAktif())->get();
        $resident = $this->sortResident($resident);

        $seniors = $usroh->senior()->get();
        $senior = array();
        foreach ($seniors as $s) {
            if($s->status==0)
                $senior[0] = $s;
            $senior[1] = $s;
        }
        
        if($usroh==null)
            return redirect()->back();

        if($this->helper->isMobile())
            return view('m.senior.usroh.detail', [
                'tahun' => $tahun,
                'usroh' => $usroh,
                'senior' => $senior,
                'resident' => $resident
            ]);

        return view('senior.usroh.detail', [
            'tahun' => $tahun,
            'usroh' => $usroh,
            'senior' => $senior,
            'resident' => $resident
        ]);
    }

    public function resident($id, $idr)
    {
        $resident = Resident::where('id', $idr)->where('idusroh', $id)
            ->where('jeniskelamin', Auth::user()->jeniskelamin)
            ->where('idtahun', $this->helper->idTahunAktif())->first();
        
        if($resident===null) {
            return redirect()->back()->withErrors(['Data Tidak Ditemukan!']);
        }
        
        if($this->helper->isMobile())
            return view('m.senior.usroh.resident', [
                'resident' => $resident,
                'tahun' => $this->helper->tahunAktif()
            ]);

        return view('senior.usroh.resident', [
            'resident' => $resident,
            'tahun' => $this->helper->tahunAktif()
        ]);
    }

    // Sort By Nomor Kamar
    public function sortResident($residents)
    {
        for ($j=0; $j < count($residents); $j++) { 
            for ($i=0; $i < count($residents)-1;$i++) { 
                if($residents[$i]->kamar->nomor > $residents[$i+1]->kamar->nomor){
                    $temp = $residents[$i+1];
                    $residents[$i+1] = $residents[$i];
                    $residents[$i] = $temp;
                }
            }
        }
        return $residents;
    }
}
