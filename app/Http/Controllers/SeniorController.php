<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
