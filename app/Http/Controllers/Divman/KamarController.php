<?php

namespace App\Http\Controllers\Divman;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    protected $mobile;
    
    public function __construct()
    {
        $this->mobile = new \Helper;
        $this->middleware('auth:senior');
    }

    
}
