<?php

namespace App\Http\Controllers\Divman;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Tengko;

class TengkoController extends Controller
{
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
        $tengko = Tengko::where('idtahun', $ta)
            ->where('jeniskelamin', Auth::user()->jeniskelamin)->get();

        $tahun = $this->helper->tahunAktif();
        if($this->helper->isMobile())
            return view('m.divman.tengko.index', [
                'tahun' => $tahun,
                'tengko' => $tengko,
            ]);
        
        return view('divman.tengko.index', [
            'tahun' => $tahun,
            'tengko' => $tengko,
        ]);
    }

    public function tambah()
    {
        $tahun = $this->helper->tahunAktif();
        if($this->helper->isMobile())
            return view('m.divman.tengko.tambah', [
                'tahun' => $tahun,
            ]);
        
        return view('divman.tengko.tambah', [
            'tahun' => $tahun,
        ]);
    }

    public function tambahTengko(Request $request)
    {
        $this->validate($request,[
            'tipe' => 'required',
            'penjelasan' => 'required',
            'poin' => 'required|numeric'
        ]);

        $tengko = new Tengko;
        $tengko->idtahun = $this->helper->idTahunAktif();
        $tengko->tipe = $request->tipe;
        $tengko->penjelasan = $request->penjelasan;
        $tengko->poin = $request->poin;
        $tengko->jeniskelamin = Auth::user()->jeniskelamin;
        $tengko->save();
        
        return redirect(route('divman.tengko'))->with(['sukses' => 'Tengko Telah Ditambahkan!']);
    }

    public function detail($id)
    {
        $tengko = Tengko::where('id', $id)
            ->where('idtahun', $this->helper->idTahunAktif())
            ->where('jeniskelamin', Auth::user()->jeniskelamin)->first();
        
        if($tengko===NULL) {
            return redirect(route('divman.tengko'))->withErrors(['Tengko Tidak Ditemukan!']);
        }

        if($this->helper->isMobile())
            return view('m.divman.tengko.detail', [
                'tengko' => $tengko
            ]);

        return view('divman.tengko.detail', [
            'tengko' => $tengko
        ]);
    }

    public function simpan(Request $request)
    {
        $this->validate($request, [
            'tipe' => 'required',
            'penjelasan' => 'required',
            'poin' => 'required|numeric'
        ]);

        $tengko = Tengko::where('id', $request->id)
            ->where('idtahun', $this->helper->idTahunAktif())
            ->where('jeniskelamin', Auth::user()->jeniskelamin)->first();
            
        if($tengko===NULL) {
            return redirect(route('divman.tengko'))->withErrors(['Tengko Tidak Ditemukan!']);
        }

        $tengko->update($request->all());

        return redirect(route('divman.tengko'))->with(['sukses' => 'Tengko Telah Diperbaharui!']);
    }

    public function hapus($id)
    {
        $tengko = Tengko::where('id', $id)
            ->where('idtahun', $this->helper->idTahunAktif())
            ->where('jeniskelamin', Auth::user()->jeniskelamin)->first();
            
        if($tengko===NULL) {
            return redirect(route('divman.tengko'))->withErrors(['Tengko Tidak Ditemukan!']);
        }

        $tengko->delete();
        
        return redirect(route('divman.tengko'))->with(['sukses' => 'Tengko Telah Dihapus!']);
    }
}
