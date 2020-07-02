<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Tahun;

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
        // dd($tahun[0]->tahunajaran);
        return view('senior.tahun', [
            'tahun' => $tahun
        ]);
    }
}
