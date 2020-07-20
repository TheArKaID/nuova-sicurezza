<?php

namespace App\Http\Controllers\Divman;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Senior;
use App\Usroh;

class SeniorController extends Controller
{
    protected $helper;
    
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
        $senior = Senior::where('idtahun', $ta)->get();
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
        $usroh = Usroh::where('idtahun', $ta)->get();
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

    public function tambahKamar(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'nim' => 'required|unique:senior,nim|digits:11',
            'jeniskelamin' => 'required',
            'username' => 'required|between:3,10|unique:senior,username',
            'password' => 'required|between:8,20',
            'repassword' => 'required|between:8,20',
            'isdivman' => 'required',
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
        $senior->foto = $request->foto;
        $senior->username = $request->username;
        $senior->password = \Hash::make($request->password);
        $senior->isdivman = $request->isdivman;
        $senior->save();
        
        return redirect(route('divman.senior'));
    }

    public function getKamar($idusroh)
    {
        $kamar = DB::table('kamar')
            ->select('kamar.id', 'kamar.nomor')
            ->leftJoin('resident', 'kamar.id', '=', 'resident.idkamar')
            ->leftJoin('senior', 'kamar.id', '=', 'senior.idkamar')
            ->where('kamar.idtahun', $this->helper->idTahunAktif())
            ->where('kamar.idusroh', $idusroh)
            ->whereNull('resident.idkamar')
            ->whereNull('senior.idkamar')
            ->get();
        if(count($kamar)===0)
            $kamar = 0;
        return $kamar;
    }
}