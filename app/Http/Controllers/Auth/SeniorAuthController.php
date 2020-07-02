<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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
            return redirect()->intended();
        } else {
            $this->incrementLoginAttempts($request);
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(["Data anda Salah!"]);
        }
    }

    public function logout()
    {
        auth()->guard('senior')->logout();
        session()->flush();

        return redirect()->route('senior.login');
    }
}
