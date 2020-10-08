<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Pengaturan;
use App\Senior;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
            session()->flash('error', 'Gagal. Pastikan Username dan Token Benar.');
            return redirect()->back();
        }
        
        $token->resettoken = rand(100000, 999999);
        $token->save();

        session(['username' => $request->username]);
        session(['restoken' => true]);
        return redirect(route('senior.resetpassword'));
    }

    public function resetPassword()
    {
        $istoken = session('restoken', false);

        if($istoken) {
            return view('senior.auth.reset');
        } else {
            return redirect(route('senior.login'));
        }
    }

    public function postResetPassword(Request $request)
    {
        $this->validate($request, [
            'newpassword' => 'required|digits:8',
            'renewpassword' => 'required|digits:8'
        ]);

        if($request->newpassword!==$request->renewpassword) {
            session()->flash('error', 'Password Tidak sama');
            return redirect()->back();
        }

        $username = session('username', false);

        if($username) {
            session_unset();
            $helper = new Helper;
            $senior = Senior::where('username', $username)->where('idtahun', $helper->idTahunAktif())->first();
            $senior->password = Hash::make($request->newpassword);
            $senior->save();

            session()->flash('berhasil', 'Password Berhasil Direset. Silahkan Login');
            return redirect(route('senior.login'));
        }
    }
}
