<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Resident;
use App\Usroh;
use App\Pencatatan;
use App\Tahun;
use App\Tengko;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ResidentController extends Controller
{    
    protected $helper;

    public function __construct()
    {
        $this->helper = new Helper;
    }

    public function index()
    {
        $tahun = $this->helper->tahunAktif();

        $resident = Resident::where('resident.idtahun', $this->helper->idTahunAktif())
            ->where('resident.jeniskelamin', (Auth::user()->jeniskelamin))
            ->where('resident.idusroh', '=', Auth::user()->usroh->id)->get();
            
        if($resident!==null)
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
        $resident = Resident::where('id', $id)
                    ->where('jeniskelamin', (Auth::user()->jeniskelamin))
                    ->where('idtahun', $this->helper->idTahunAktif())->first();
     
        $tahunresident = Tahun::find($resident->idtahun);
        $tahun = Str::replaceFirst('/', '-', $tahunresident->tahunajaran);

        if($resident===NULL) {
            return redirect(route('senior.resident'))->withErrors(['Resident Tidak Ditemukan!']);
        }

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

    public function edit(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required',
            'nim' => 'required|digits:11',
        ]);

        $resident = Resident::where('id', $id)
            ->where('idtahun', $this->helper->idTahunAktif())
            ->where('jeniskelamin', Auth::user()->jeniskelamin)->first();

        if($resident===NULL) {
            return redirect(route('senior.resident'))->withErrors(['Maaf, Resident Tidak Ditemukan']);
        }

        // Foto
        if($request->foto){
            $name = $request->id .".jpg";
            $tahunresident = Tahun::find($request->idtahun);
            $tahun = Str::replaceFirst('/', '-', $tahunresident->tahunajaran);

            $img = explode(',', $request->foto);
            $image = base64_decode($img[1]);
        
            if (!is_dir("storage/foto/" .$tahun. "/resident/")) {
                // dir doesn't exist, make it
                mkdir("storage/foto/" .$tahun. "/resident/", 0777, true);
            }

            file_put_contents("storage/foto/" .$tahun. "/resident/" .$name, $image);

            $resident->foto = $name;
        }

        $resident->nama = $request->nama;
        $resident->nim = $request->nim;
        $resident->save();

        return redirect()->back()->with(['sukses' => 'Data Berhasil Diperbaharui']);
    }
    
    public function poin($id)
    {
        $resident = Resident::where('id', $id)->where('idtahun', $this->helper->idTahunAktif())
                    ->where('jeniskelamin', (Auth::user()->jeniskelamin))->first();
                    
        if($resident===NULL) {
            return redirect(route('senior.resident'))->withErrors(['Resident Tidak Ditemukan!']);
        }

        $pencatatan = Pencatatan::where('idresident', $id)->where('idtahun', $this->helper->idTahunAktif())->get();

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
        if($tengko===NULL) {
            return redirect(route('senior.resident'))->withErrors(['Tengko Tidak Ditemukan!']);
        }

        $resident = Resident::where('idtahun', $ta)->where('id', $request->idresident)->first();
        if($resident===NULL) {
            return redirect(route('senior.resident'))->withErrors(['Resident Tidak Ditemukan!']);
        }

        if($resident->usroh->id!=Auth::user()->usroh->id){
            return redirect(route('senior.resident'))->withErrors(['Resident Tidak Ditemukan!']);
        }

        $pencatatan = new Pencatatan;
        $pencatatan->idresident = $request->idresident;
        $pencatatan->idtengko = $request->idtengko;
        $pencatatan->idtahun = $ta;
        $pencatatan->idsenior = Auth::user()->id;
        $pencatatan->keterangan = $request->keterangan ?: "-";
        $pencatatan->tanggal = $request->tanggal;
        $pencatatan->save();

        return redirect()->back()->with(['sukses' => "Catatan Poin Telah Ditambahkan!"]);
    }

    public function hapusPoin($idpoin)
    {
        $pencatatan = Pencatatan::where('id', $idpoin)->with('resident')->first();
        if($pencatatan===NULL) {
            return redirect(route('senior.resident'))->withErrors(['Maaf, Data Tidak Ditemukan!']);
        }

        if(!($pencatatan->resident->usroh->id==Auth::user()->usroh->id)){
            return redirect(route('senior.resident'))->withErrors(['Maaf, Data Tidak Ditemukan!']);
        }
        
        $pencatatan->delete();

        return redirect()->back()->with(['sukses' => 'Data Berhasil Dihapus!']);
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
