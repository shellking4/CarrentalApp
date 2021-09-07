<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use App\Role\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function index(Request $request)
    {
        return view('auth.register');
    }

    public function storeUser(RegisterUserRequest $request)
    {
        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->login = $request->login;
        $user->password = Hash::make($request->password);
        $user->save();
        Auth::attempt($request->only('login', 'password'));
        return redirect()->route('home');
    }

    public function storeAdmin(RegisterUserRequest $request)
    {
        $role = UserRole::ROLE_ADMIN;
        $user = new User();
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->login = $request->login;
        $user->password = Hash::make($request->password);
        $user->addRole($role);

        $user->save();

        Auth::attempt($request->only('login', 'password'));
        return redirect()->route('cars@dashboard');
    }
}
