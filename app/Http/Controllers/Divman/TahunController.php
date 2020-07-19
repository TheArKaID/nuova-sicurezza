<?php

namespace App\Http\Controllers\Divman;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Tahun;
use App\Pengaturan;

class TahunController extends Controller
{
    protected $helper, $isdivman;
    
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
        $tahun = Tahun::all();
        $pengaturan = Pengaturan::first();
        if($this->helper->isMobile())
            return view('m.divman.tahun', [
                'tahun' => $tahun,
                'pengaturan' => $pengaturan
            ]);
        return view('senior.tahun', [
            'tahun' => $tahun,
            'pengaturan' => $pengaturan
        ]);
    }

    public function tambahTahun(Request $request)
    {
        $this->validate($request, [
            'tahunawal' => 'required',
            'tahunakhir' => 'required'
        ]);

        $tahunawal = $request->tahunawal;
        $tahunakhir = $request->tahunakhir;
        $tahunajaran = $tahunawal.'/'.$tahunakhir;
        
        // Cek apakah kalau dikurangi hasilnya 1
        if(($tahunakhir-$tahunawal)!=1){
            return redirect()->back()->withInput()->withErrors(["tahun" => "Tahun Awal harus lebih rendah 1 tahun dari Tahun Akhir"]);
        }

        //Cek di database
        $tahun = Tahun::where('tahunajaran', $tahunajaran)->first();
        if($tahun!=null){
            return redirect()->back()->withInput()->withErrors(['tahun' => 'Tahun sudah ada']);
        }
        
        $tahun = new Tahun;
        $tahun = $tahunajaran;
        $tahun->save();
        return redirect()->back()->with('sukses', 'Data Tahun Berhasil Ditambahkan');
    }

    public function setTahun(Request $request)
    {
        $this->validate($request, [
            'tahun' => 'required'
        ]);
        $tahun = Tahun::find($request->tahun);
        if($tahun==null){
            return redirect()->back()->withInput()->withErrors(['tahun' => 'Tahun Tidak Ditemukan']);
        }

        $pengaturan = Pengaturan::first();
        $pengaturan->idtahunaktif = $request->tahun;
        $pengaturan->save();
        
        return redirect()->back()->with('sukses', 'Tahun Aktif Berhasil Diubah');
    }

    public function hapusTahun(Request $request)
    {
        $this->validate($request, [
            'tahun' => 'required'
        ]);
        
        $tahun = Tahun::find($request->tahun);
        if($tahun==null){
            return redirect()->back()->withInput()->withErrors(['tahun' => 'Tahun Tidak Ditemukan']);
        }

        $pengaturan = Pengaturan::first();
        if($pengaturan->idtahunaktif==$request->tahun){
            return redirect()->back()->withInput()->withErrors(['tahun' => 'Tahun Sedang Aktif. Harap Ubah Tahun Aktif Terlebih Dahulu']);
        }

        $tahun->delete();
        
        return redirect()->back()->with('sukses', 'Tahun Telah Dihapus');
    }
}
