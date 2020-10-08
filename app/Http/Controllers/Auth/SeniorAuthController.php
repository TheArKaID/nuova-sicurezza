<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Pengaturan;
use App\Senior;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Validator;

class SeniorAuthController extends Controller
{
    use AuthenticatesUsers;

    protected $maxAttempts = 3;
    protected $decayMinutes = 2;

    public function __construct()
    {
        $this->middleware('guest:senior')->except('logout');
    }

    public function login()
    {
        return view('senior.auth.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required|min:8'
        ]);

        if (auth()->guard('senior')->attempt($request->only('username', 'password'))) {
            $request->session()->regenerate();
            $this->clearLoginAttempts($request);
            return redirect('/s');
        } else {
            $this->incrementLoginAttempts($request);
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['username' => "Username atau Password anda Salah!"]);
        }
    }

    public function logout()
    {
        auth()->guard('senior')->logout();
        session()->flush();

        return redirect()->route('senior.login');
    }

    public function forgotPassword()
    {
        return view('senior.auth.forgot');
    }

    public function postForgotPassword(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'resettoken' => 'required|digits:6'
        ]);

        $helper = new Helper;
        $senior = Senior::where('username', $request->username)
            ->where('idtahun', $helper->idTahunAktif())->first();
        $token = Pengaturan::first();

        if(($token->resettoken!=$request->resettoken) || $senior===null){
            $token->resettoken = rand(100000, 999999);
            $token->save();

            return redirect()->back()->withErrors(['Gagal. Pastikan Username dan Token Benar. Token telah Berubah.']);
        }
        
        session()->flash('restoken', $request->resettoken);
        return redirect(route('senior.resetpassword'));
    }
}
