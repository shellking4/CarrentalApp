<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Role\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('check_user_role:admin');
    }

    public function index()
    {
        $id = Auth::user()->id;
        $allUsers = User::all();
        $users = $allUsers->except([$id]);
        return view('admins.users', [
            'users' => $users
        ]);
    }

    public function render_update_form(User $user, Request $request)
    {
        $user = $request->user;
        return view('admins.update_user', [
            'user' => $user
        ]);
    }

    public function update(int $id, UpdateUserRequest $request)
    {
        $user = User::find($id);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->login = $request->login;
        $user->save();
        return redirect()->route('users@dashboard');
    }

    public function delete(User $user)
    {
        $user->delete();

        return redirect()->route('users@dashboard');
    }
}
