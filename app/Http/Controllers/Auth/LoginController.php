<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('auth.login');
    }

    public function authenticate(LoginUserRequest $request)
    {
        if (!Auth::attempt($request->only('login', 'password'))) {
            return back()->with('status', 'IDENTIFIANTS DE CONNEXION INVALIDES');
        }
        return redirect()->route('home');
    }
}
