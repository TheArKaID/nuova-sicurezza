<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        return view('senior.tahun');
    }
}
