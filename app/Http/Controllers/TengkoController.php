<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Tengko;
use Illuminate\Support\Facades\Auth;

class TengkoController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new Helper;
    }

    public function index()
    {
        $tengko = null;
        if(isset($_GET['cari'])) {
            $tengko = $this->getSearch($_GET['cari']);
        } else {
            $tengko = $this->getAll();
        }

        $tahun = $this->helper->tahunAktif();
        if($this->helper->isMobile())
            return view('m.senior.tengko.index', [
                'tahun' => $tahun,
                'tengko' => $tengko,
            ]);
        
        return view('senior.tengko.index', [
            'tahun' => $tahun,
            'tengko' => $tengko,
        ]);
    }

    public function getAll()
    {
        $ta = $this->helper->idTahunAktif();
        $ringan = Tengko::where('idtahun', $ta)->where('tipe', 'Ringan')
            ->where('jeniskelamin', Auth::user()->jeniskelamin)
            ->orderBy('poin')->get();
        $sedang = Tengko::where('idtahun', $ta)->where('tipe', 'Sedang')
            ->where('jeniskelamin', Auth::user()->jeniskelamin)
            ->orderBy('poin')->get();
        $berat = Tengko::where('idtahun', $ta)->where('tipe', 'Berat')
            ->where('jeniskelamin', Auth::user()->jeniskelamin)
            ->orderBy('poin')->get();
        $tengko = array('ringan' => $ringan, 'sedang' => $sedang, 'berat' => $berat);
        
        return $tengko;
    }

    public function getSearch($query)
    {
        $ta = $this->helper->idTahunAktif();
        $ringan = Tengko::where('idtahun', $ta)->where('tipe', 'Ringan')
                ->where('penjelasan', 'LIKE', '%' .$query. '%')
                ->where('jeniskelamin', Auth::user()->jeniskelamin)->orderBy('poin')->get();
        $sedang = Tengko::where('idtahun', $ta)->where('tipe', 'Sedang')
                ->where('penjelasan', 'LIKE', '%' .$query. '%')
                ->where('jeniskelamin', Auth::user()->jeniskelamin)->orderBy('poin')->get();
        $berat = Tengko::where('idtahun', $ta)->where('tipe', 'Berat')
                ->where('penjelasan', 'LIKE', '%' .$query. '%')
                ->where('jeniskelamin', Auth::user()->jeniskelamin)->orderBy('poin')->get();
        $tengko = array('ringan' => $ringan, 'sedang' => $sedang, 'berat' => $berat);
        
        return $tengko;
    }

    public function getPelanggaran($tipe)
    {
        $ta = $this->helper->idTahunAktif();
        $tengko = Tengko::where('idtahun', $ta)->where('jeniskelamin', Auth::user()->jeniskelamin)->where('tipe', $tipe)->get();
        $result = array();
        foreach ($tengko as $key => $value) {
            $res['id'] = $value['id'];
            $res['pelanggaran'] = $value['penjelasan'] .' - '. $value['poin'];
            array_push($result, $res);
        }
        
        return $result;
    }
}
