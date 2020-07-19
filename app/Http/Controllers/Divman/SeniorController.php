<?php

namespace App\Http\Controllers\Divman;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SeniorController extends Controller
{
    protected $helper;
    
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
}
