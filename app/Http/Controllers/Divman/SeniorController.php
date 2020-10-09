<?php

namespace App\Http\Controllers\Divman;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Kamar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Senior;
use App\Usroh;
use Illuminate\Support\Facades\Hash;

class SeniorController extends Controller
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
        $ta = $this->helper->idTahunAktif();
        $senior = Senior::where('idtahun', $ta)
            ->where('jeniskelamin', Auth::user()->jeniskelamin)->get();

        $senior = $this->sortSenior($senior);
        $tahun = $this->helper->tahunAktif();
        if($this->helper->isMobile())
            return view('m.divman.senior.index', [
                'tahun' => $tahun,
                'senior' => $senior,
            ]);
        
        return view('divman.senior.index', [
            'tahun' => $tahun,
            'senior' => $senior,
        ]);
    }

    public function tambah()
    {
        $ta = $this->helper->idTahunAktif();
        $tahun = $this->helper->tahunAktif();
        $usroh = Usroh::where('idtahun', $ta)
            ->where('jeniskelamin', Auth::user()->jeniskelamin)->get();

        if($this->helper->isMobile())
            return view('m.divman.senior.tambah', [
                'tahun' => $tahun,
                'usroh' => $usroh,
            ]);
        
        return view('divman.senior.tambah', [
            'tahun' => $tahun,
            'usroh' => $usroh,
        ]);
    }

    public function tambahSenior(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'nim' => 'required|unique:senior,nim|digits:11',
            'jeniskelamin' => 'required',
            'username' => 'required|between:3,10|unique:senior,username',
            'password' => 'required|between:8,20',
            'repassword' => 'required|between:8,20',
            'isdivman' => 'required',
            'status' => 'required',
            'idusroh' => 'required',
            'idkamar' => 'required'
        ]);

        // Password
        if($request->password!=$request->repassword)
            return redirect()->back()->withInput()->withErrors('Password dan Repassword tidak sama!');

        // Username
        $un = Senior::where('username', $request->username)->first();
        if($un!=null)
            return redirect()->back()->withInput()->withErrors('Username Telah Digunakan');
        
        $senior = new Senior;

        $senior->idtahun = $this->helper->idTahunAktif();
        $senior->idusroh = $request->idusroh;
        $senior->idkamar = $request->idkamar;
        $senior->nama = $request->nama;
        $senior->nim = $request->nim;
        $senior->jeniskelamin = $request->jeniskelamin;
        $senior->username = $request->username;
        $senior->password = Hash::make($request->password);
        $senior->isdivman = $request->isdivman;
        $senior->status = $request->status;
        
        $senior->save();
        
        // Foto
        if($request->hasFile('foto')){
            $this->validate($request, ['foto' => 'mimes:jpeg,jpg,png|max:2048',]);
            $file = $request->file('foto');
            $ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            $name = $senior->id .".". $ext;
            $tahun = Str::replaceFirst('/', '-', $this->helper->tahunAktif());
            $file->move('storage/foto/' .$tahun. "/senior/", $name);
            $senior->foto = $name;
            $senior->save();
        }

        return redirect(route('divman.senior'));
    }

    public function detail($id)
    {
        $ta = $this->helper->idTahunAktif();
        $tahun = Str::replaceFirst('/', '-', $this->helper->tahunAktif());
        $senior = Senior::where('id', $id)
            ->where('idtahun', $this->helper->idTahunAktif())
            ->where('jeniskelamin', Auth::user()->jeniskelamin)->first();
        $usroh = Usroh::where('idtahun', $ta)
            ->where('jeniskelamin', Auth::user()->jeniskelamin)->get();
        
        if($this->helper->isMobile())
            return view('m.divman.senior.detail', [
                'senior' => $senior,
                'usroh' => $usroh,
                'tahun' => $tahun,
            ]);
        
        return view('divman.senior.detail', [
            'senior' => $senior,
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
            'username' => 'required|between:3,10',
            'isdivman' => 'required',
            'status' => 'required',
            'idusroh' => 'required',
            'idkamar' => 'required'
        ]);

        $senior = Senior::where('id', $request->id)
            ->where('idtahun', $this->helper->idTahunAktif())
            ->where('jeniskelamin', Auth::user()->jeniskelamin)->first();

        // Password
        if($request->password || $request->repassword){
            $this->validate($request, [
                'password' => 'required|between:8,20',
                'repassword' => 'required|between:8,20',
            ]);

            if($request->password!=$request->repassword)
                return redirect()->back()->withInput()->withErrors('Password dan Repassword tidak sama!');

            $senior->password = Hash::make($request->password);
        }

        // Foto
        if($request->hasFile('foto')){
            $this->validate($request, ['foto' => 'mimes:jpeg,jpg,png|max:2048',]);
            $file = $request->file('foto');
            $ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            $name = $request->id .".". $ext;
            $tahun = Str::replaceFirst('/', '-', $this->helper->tahunAktif());
            $file->move('storage/foto/' .$tahun. "/senior/", $name);
            $senior->foto = $name;
        }

        $senior->idtahun = $this->helper->idTahunAktif();
        $senior->idusroh = $request->idusroh;
        $senior->idkamar = $request->idkamar;
        $senior->nama = $request->nama;
        $senior->nim = $request->nim;
        $senior->jeniskelamin = $request->jeniskelamin;
        $senior->username = $request->username;
        $senior->isdivman = $request->isdivman;
        $senior->status = $request->status;
        
        $senior->save();
        
        return redirect(route('divman.senior'));
    }

    public function hapus($id)
    {
        $senior = Senior::where('id', $id)
            ->where('idtahun', $this->helper->idTahunAktif())
            ->where('jeniskelamin', Auth::user()->jeniskelamin)->first();
        
        if($senior->foto){
            $tahun = Str::replaceFirst('/', '-', $this->helper->tahunAktif());
            Storage::delete('public/foto/' .$tahun. '/senior/' .$senior->foto);
        }
        
        $senior->delete();
        
        return redirect(route('divman.senior'));
    }

    public function getKamar($idusroh)
    {
        $kamar = Kamar::where('idtahun', $this->helper->idTahunAktif())
                ->where('jeniskelamin', Auth::user()->jeniskelamin)
                ->where('idusroh', $idusroh)
                ->doesntHave('resident')->doesntHave('senior')
                ->get();
                
        if(count($kamar)===0)
            $kamar = 0;
        return $kamar;
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