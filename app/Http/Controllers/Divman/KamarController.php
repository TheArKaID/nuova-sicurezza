<?php

namespace App\Http\Controllers\Divman;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Kamar;
use App\Usroh;

class KamarController extends Controller
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
        $tahun = $this->helper->tahunAktif();
        $kamar = Kamar::where('idtahun', $this->helper->idTahunAktif())
            ->where('jeniskelamin', Auth::user()->jeniskelamin)->paginate(16);
            
        if($this->helper->isMobile())
            return view('m.divman.kamar.index', [
                'tahun' => $tahun,
                'kamar' => $kamar
            ]);

        return view('divman.kamar.index', [
            'tahun' => $tahun,
            'kamar' => $kamar
        ]);
    }

    public function tambah()
    {
        $tahun = $this->helper->tahunAktif();
        $usroh = Usroh::where('idtahun', $this->helper->idTahunAktif())
            ->where('jeniskelamin', Auth::user()->jeniskelamin)->get();

        if($this->helper->isMobile())
            return view('m.divman.kamar.tambah', [
                'tahun' => $tahun,
                'usroh' => $usroh
            ]);

        return view('divman.kamar.tambah', [
            'tahun' => $tahun,
            'usroh' => $usroh
        ]);
    }

    public function tambahKamar(Request $request)
    {
        $this->validate($request,[
            'nomor' => 'required',
            'idusroh' => 'required'
        ]);

        $kamar = new Kamar;
        $kamar->idtahun = $this->helper->idTahunAktif();
        $kamar->nomor = $request->nomor;
        $kamar->idusroh = $request->idusroh;
        $kamar->jeniskelamin = Auth::user()->jeniskelamin;
        $kamar->save();
        
        return redirect(route('divman.kamar'))->with(['sukses' => 'Kamar Berhasil Ditambahkan!']);
    }

    public function detail($id)
    {
        $kamar = Kamar::where('id', $id)
            ->where('jeniskelamin', Auth::user()->jeniskelamin)
            ->where('idtahun', $this->helper->idTahunAktif())->first();

        if($kamar===NULL) {
            return redirect(route('divman.kamar'))->withErrors(['Kamar Tidak Ditemukan!']);
        }

        $usroh = Usroh::where('idtahun', $this->helper->idTahunAktif())
            ->where('jeniskelamin', Auth::user()->jeniskelamin)->get();
        
        if($this->helper->isMobile())
            return view('m.divman.kamar.detail', [
                'kamar' => $kamar,
                'usroh' => $usroh
            ]);

        return view('divman.kamar.detail', [
            'kamar' => $kamar,
            'usroh' => $usroh
        ]);
    }

    public function simpan(Request $request)
    {
        $messages = ['required' => ':attribute Harus Diisi!'];

        $this->validate($request, [
            'nomor' => 'required',
            'idusroh' => 'required'
        ], $messages);

        $kamar = Kamar::where('id', $request->id)
            ->where('jeniskelamin', Auth::user()->jeniskelamin)
            ->where('idtahun', $this->helper->idTahunAktif())->first();
        
        if($kamar===NULL) {
            return redirect()->back()->withErrors(['Kamar Tidak Ditemukan']);
        }

        $kamar->update($request->all());

        return redirect(route('divman.kamar'))->with(['sukses' => 'Data Berhasil Disimpan!']);
    }
    
    public function hapus($id)
    {
        $kamar = Kamar::where('id', $id)
            ->where('jeniskelamin', Auth::user()->jeniskelamin)
            ->where('idtahun', $this->helper->idTahunAktif())->first();

        if($kamar===NULL) {
            return redirect()->back()->withErrors(['Kamar Tidak Ditemukan']);
        }

        $kamar->delete();
        
        return redirect(route('divman.kamar'))->with(['sukses' => 'Kamar Berhasil Dihapus!']);
    }

}
