<?php

namespace App\Http\Controllers\Divman;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Resident;
use App\Usroh;
use App\Kamar;

class ResidentController extends Controller
{    
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
        $ta = $this->helper->idTahunAktif();
        $resident = Resident::where('idtahun', $ta)->get();
        $tahun = $this->helper->tahunAktif();
        if($this->helper->isMobile())
            return view('m.divman.resident.index', [
                'tahun' => $tahun,
                'resident' => $resident,
            ]);
        
        return view('divman.resident.index', [
            'tahun' => $tahun,
            'resident' => $resident,
        ]);
    }

    public function tambah()
    {
        $ta = $this->helper->idTahunAktif();
        $usroh = Usroh::where('idtahun', $ta)->get();
        $tahun = $this->helper->tahunAktif();
        if($this->helper->isMobile())
            return view('m.divman.resident.tambah', [
                'tahun' => $tahun,
                'usroh' => $usroh,
            ]);
        
        return view('divman.resident.tambah', [
            'tahun' => $tahun,
            'usroh' => $usroh,
        ]);
    }

    public function tambahResident(Request $request)
    {
        
        $this->validate($request, [
            'nama' => 'required',
            'nim' => 'required|unique:resident,nim|digits:11',
            'jeniskelamin' => 'required',
            'idusroh' => 'required',
            'idkamar' => 'required'
        ]);

        // Password
        if($request->password!=$request->repassword)
            return redirect()->back()->withInput()->withErrors('Password dan Repassword tidak sama!');

        $resident = new Resident;

        $resident->idtahun = $this->helper->idTahunAktif();
        $resident->idusroh = $request->idusroh;
        $resident->idkamar = $request->idkamar;
        $resident->nama = $request->nama;
        $resident->nim = $request->nim;
        $resident->jeniskelamin = $request->jeniskelamin;
        
        $resident->save();
        
        // Foto
        if($request->hasFile('foto')){
            $this->validate($request, ['foto' => 'mimes:jpeg,jpg,png|max:2048',]);
            $file = $request->file('foto');
            $ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            $name = $resident->id .".". $ext;
            $tahun = \Str::replaceFirst('/', '-', $this->helper->tahunAktif());
            $file->move('storage/foto/' .$tahun. "/resident/", $name);
            $resident->foto = $name;
            $resident->save();
        }

        return redirect(route('divman.resident'));
    }

    public function detail($id)
    {
        $ta = $this->helper->idTahunAktif();
        $tahun = \Str::replaceFirst('/', '-', $this->helper->tahunAktif());
        $resident = Resident::where('id', $id)->where('idtahun', $this->helper->idTahunAktif())->first();
        $usroh = Usroh::where('idtahun', $ta)->get();
        
        if($this->helper->isMobile())
            return view('m.divman.resident.detail', [
                'resident' => $resident,
                'usroh' => $usroh,
                'tahun' => $tahun,
            ]);
        
        return view('divman.resident.detail', [
            'resident' => $resident,
            'usroh' => $usroh,
            'tahun' => $tahun,
        ]);
    }

    public function simpan(Request $request)
    {
        
        $this->validate($request, [
            'nama' => 'required',
            'nim' => 'required|digits:11',
            'jeniskelamin' => 'required',
            'idusroh' => 'required',
            'idkamar' => 'required'
        ]);

        $resident = Resident::where('id', $request->id)->where('idtahun', $this->helper->idTahunAktif())->first();

        // Foto
        if($request->hasFile('foto')){
            $this->validate($request, ['foto' => 'mimes:jpeg,jpg,png|max:2048',]);
            $file = $request->file('foto');
            $ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            $name = $request->id .".". $ext;
            $tahun = \Str::replaceFirst('/', '-', $this->helper->tahunAktif());
            $file->move('storage/foto/' .$tahun. "/resident/", $name);
            $resident->foto = $name;
        }

        $resident->idtahun = $this->helper->idTahunAktif();
        $resident->idusroh = $request->idusroh;
        $resident->idkamar = $request->idkamar;
        $resident->nama = $request->nama;
        $resident->nim = $request->nim;
        $resident->jeniskelamin = $request->jeniskelamin;
        
        $resident->save();
        
        return redirect(route('divman.resident'));
    }

    public function hapus($id)
    {
        $resident = Resident::where('id', $id)->where('idtahun', $this->helper->idTahunAktif())->first();
        
        if($resident->foto){
            $tahun = \Str::replaceFirst('/', '-', $this->helper->tahunAktif());
            Storage::delete('public/foto/' .$tahun. '/resident/' .$resident->foto);
        }
        
        $resident->delete();
        
        return redirect(route('divman.resident'));
    }
    
    public function getKamar($idusroh)
    {
        $kamar = Kamar::where('idtahun', $this->helper->idTahunAktif())
                    ->where('idusroh', $idusroh)
                    ->doesntHave('resident')->doesntHave('senior')
                    ->get();
        if(count($kamar)===0)
            $kamar = 0;
        return $kamar;
    }
}
