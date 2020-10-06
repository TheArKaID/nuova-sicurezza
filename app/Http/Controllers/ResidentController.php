<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Resident;
use App\Usroh;
use App\Pencatatan;
use App\Tengko;
use Illuminate\Support\Facades\Auth;

class ResidentController extends Controller
{    
    protected $helper;

    public function __construct()
    {
        $this->helper = new Helper;
        $this->middleware('auth:senior');
    }

    public function index()
    {
        $tahun = $this->helper->tahunAktif();
        $resident = Resident::where('idtahun', $this->helper->idTahunAktif())
                    ->where('jeniskelamin', (Auth::user()->jeniskelamin))->paginate(16);
        $resident = $this->sortResidentByKamar($resident);
        if($this->helper->isMobile())
            return view('m.senior.resident.index', [
                'resident'=> $resident,
                'tahun' => $tahun
            ]);
        return view('senior.resident.index', [
            'resident'=> $resident,
            'tahun' => $tahun
        ]);
    }

    public function detail($id)
    {
        $ta = $this->helper->idTahunAktif();
        $tahun = Str::replaceFirst('/', '-', $this->helper->tahunAktif());
        $resident = Resident::where('id', $id)
                    ->where('jeniskelamin', (Auth::user()->jeniskelamin))
                    ->where('idtahun', $this->helper->idTahunAktif())->first();
        
        if($resident===NULL)
            return redirect(route('senior.resident'));

        if($this->helper->isMobile())
            return view('m.senior.resident.detail', [
                'resident' => $resident,
                'tahun' => $tahun,
            ]);
        
        return view('senior.resident.detail', [
            'resident' => $resident,
            'tahun' => $tahun,
        ]);
    }
    
    public function poin($id)
    {
        $ta = $this->helper->idTahunAktif();
        $resident = Resident::where('id', $id)->where('idtahun', $this->helper->idTahunAktif())
                    ->where('jeniskelamin', (Auth::user()->jeniskelamin))->first();
        $pencatatan = Pencatatan::where('idresident', $id)->where('idtahun', $this->helper->idTahunAktif())->get();

        if($resident===NULL)
            return redirect(route('senior.resident'));

        if($this->helper->isMobile())
            return view('m.senior.resident.poin', [
                'resident' => $resident,
                'pencatatan' => $pencatatan
            ]);
        
        return view('senior.resident.poin', [
            'resident' => $resident,
            'pencatatan' => $pencatatan
        ]);
    }

    public function tambahPoin(Request $request)
    {
        $ta = $this->helper->idTahunAktif();
        $this->validate($request,[
            'idresident' => 'required',
            'idtengko' => 'required',
            'tanggal' => 'required'
        ]);
        
        $tengko = Tengko::where('idtahun', $ta)->where('id', $request->idtengko)->first();
        $resident = Resident::where('idtahun', $ta)->where('id', $request->idresident)->first();

        if($resident->usroh->id!=Auth::user()->usroh->id)
            return redirect(route('senior.resident'));

        $pencatatan = new Pencatatan;
        $pencatatan->idresident = $request->idresident;
        $pencatatan->idtengko = $request->idtengko;
        $pencatatan->idtahun = $ta;
        $pencatatan->idsenior = Auth::user()->id;
        $pencatatan->keterangan = $request->keterangan ?: "-";
        $pencatatan->tanggal = $request->tanggal;
        $pencatatan->save();

        return redirect()->back();
    }

    public function sortResidentByKamar($resident)
    {
        for ($j=0; $j < count($resident); $j++) { 
            for ($i=0; $i < count($resident)-1;$i++) { 
                if($resident[$i]->kamar->nomor > $resident[$i+1]->kamar->nomor){
                    $temp = $resident[$i+1];
                    $resident[$i+1] = $resident[$i];
                    $resident[$i] = $temp;
                }
            }
        }
        return $resident;
    }
}
