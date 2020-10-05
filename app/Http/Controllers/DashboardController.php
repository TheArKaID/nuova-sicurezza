<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Resident;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new Helper;
        $this->middleware('auth:senior');
    }

    public function index()
    {
        $resident = $this->getResident();
        $rputra = $this->getResidentPutra();
        $rputri = $this->getResidentPutri();

        if($this->helper->isMobile())
            return view('m.senior.dashboard', [
                'resident' => $resident,
                'rputra' => $rputra,
                'rputri' => $rputri
            ]);
        return view('senior.dashboard', [
            'resident' => $resident,
            'rputra' => $rputra,
            'rputri' => $rputri
        ]);
    }

    public function getResident()
    {
        $resident = Cache::get('resident', false);
        if(is_bool($resident)) {
            $resident = Resident::where('idtahun', $this->helper->idTahunAktif())->count();
            Cache::put('resident', $resident, now()->addDay());
        }
        return $resident;
    }

    public function getResidentPutra()
    {
        $rputra = Cache::get('rputra', false);
        if(is_bool($rputra)) {
            $rputra = Resident::where('idtahun', $this->helper->idTahunAktif())
            ->where('jeniskelamin', (Auth::user()->jeniskelamin))->count();
            Cache::put('rputra', $rputra, now()->addDay());
        }

        return $rputra;
    }

    public function getResidentPutri()
    {
        $rputri = Cache::get('rputri', false);
        if(is_bool($rputri)) {
            $rputri = Resident::where('idtahun', $this->helper->idTahunAktif())
            ->where('jeniskelamin', '!=', (Auth::user()->jeniskelamin))->count();
            Cache::put('rputri', $rputri, now()->addDay());
        }

        return $rputri;
    }
}
