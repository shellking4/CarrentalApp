<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Role\UserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Car;

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

    public function renderUpdateForm(User $user, Request $request)
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
        $cars = $user->rentedCars;
        foreach ($cars as $car) {
            $car->renter()->dissociate();
            $car->save();
        }
        $user->delete();
        return redirect()->route('users@dashboard');
    }

    public function getUserFreeRents(User $user)
    {
        $freeRents = $user->rentedCars->where('isFreeRented', true)->all();
        $owedRentAmount = $user->owedRentAmount;
        return view('admins.freeRents', [
            'user' => $user,
            'freeRents' => $freeRents,
            'owedRentAmount' => $owedRentAmount
        ]);
    }

    public function getUserRents(User $user)
    {
        $rents = $user->rentedCars->where('isRented', true)->all();
        $owedRentAmount = $user->owedRentAmount;
        return view('admins.rents', [
            'user' => $user,
            'rents' => $rents,
            'owedRentAmount' => $owedRentAmount
        ]);
    }

    public function getUserWithRentedCars()
    {
        $id = Auth::user()->id;
        $allUsers = User::all()->except([$id]);
        $users = [];
        foreach ($allUsers as $user) {
            $userCars = $user->rentedCars;
            foreach ($userCars as $car) {
                if ($car->isRented == true) {
                    $users[] = $user;
                    break;
                }
            }
        }
        return view('admins.usersWithRentedCars', [
            'users' => $users
        ]);
    }

    public function getUserWithFreeRentedCars()
    {
        $id = Auth::user()->id;
        $allUsers = User::all()->except([$id]);
        $users = [];
        foreach ($allUsers as $user) {
            $userCars = $user->rentedCars;
            foreach ($userCars as $car) {
                if ($car->isFreeRented == true) {
                    $users[] = $user;
                    break;
                }
            }
        }
        return view('admins.userWithFreeRentedCars', [
            'users' => $users
        ]);
    }
}
