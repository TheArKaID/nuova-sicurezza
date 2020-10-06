<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;

class HelpController extends Controller
{
    protected $helper;
    
    public function __construct()
    {
        $this->helper = new Helper;
    }

    public function about()
    {
        if($this->helper->isMobile())
            return view('m.senior.help.about');
        
        return view('senior.help.about');
    }

    public function contact()
    {
        if($this->helper->isMobile())
            return view('m.senior.help.contact');
        
        return view('senior.help.contact');
    }

    public function faq()
    {
        if($this->helper->isMobile())
            return view('m.senior.help.faq');
        
        return view('senior.help.faq');
    }

    public function privacy()
    {
        if($this->helper->isMobile())
            return view('m.senior.help.privacy');
        
        return view('senior.help.privacy');
    }
}
