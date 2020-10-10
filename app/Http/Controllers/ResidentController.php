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
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

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
        $tahun = Str::replaceFirst('/', '-', $this->helper->tahunAktif());
        $resident = Resident::where('id', $id)
                    ->where('jeniskelamin', (Auth::user()->jeniskelamin))
                    ->where('idtahun', $this->helper->idTahunAktif())->first();
        
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
        if($request->hasFile('foto')){
            $this->validate($request, ['foto' => 'mimes:jpeg,jpg,png|max:2048',]);
            $file = $request->file('foto');
            $name = $request->id .".jpg";
            $tahun = Str::replaceFirst('/', '-', $this->helper->tahunAktif());
            
            $img = Image::make($file)->encode('jpg');
            
            $quality = 0;
            $imgsize = $file->getSize();
            if($imgsize<500000) {
                $quality = 60;
            } else if($imgsize>500000 && $imgsize<1000000) {
                $quality = 40;
            } else if($imgsize>1000000 && $imgsize<1500000) {
                $quality = 20;
            } else {
                $quality = 8;
            }
            $img->save('storage/foto/' .$tahun. "/resident/".$name, $quality);

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
