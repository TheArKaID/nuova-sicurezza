<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

use App\Tahun;
use App\Pengaturan;

class SeniorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:senior');
    }

    public function index()
    {
        return view('senior.dashboard');
    }

    public function tahun()
    {
        $tahun = Tahun::all();
        $pengaturan = Pengaturan::first();
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
        $tahun->tahunajaran = $tahunajaran;
        $tahun->save();
        return redirect()->back()->with('sukses', 'Data Tahun Berhasil ditambahkan');
    }
}
