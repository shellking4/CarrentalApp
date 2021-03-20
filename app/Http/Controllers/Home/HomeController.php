<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $matchThese = ['isFreeRented' => false, 'isRented' => false];
        $cars = Car::where($matchThese)->get();
        return view('parc.cars', [
            'cars' => $cars
        ]);
    }

    public function getUserFreeRents()
    {
        $freeRents = Auth::user()->rentedCars->where('isFreeRented', true)->all();
        return view('parc.freeRents', [
            'freeRents' => $freeRents
        ]);
    }

    public function getUserRents()
    {
        $rents = Auth::user()->rentedCars->where('isRented', true)->all();
        return view('parc.rents', [
            'rents' => $rents
        ]);
    }

    public function showCarrentalPolicies(Request $request)
    {
        return view('parc.policies');
    }

    public function freeRent(Car $car)
    {
        $user = User::find(Auth::user()->id);
        $user->rentedCars()->save($car);
        $car->isFreeRented = true;
        $car->save();
        return back();
    }

    public function rent(Car $car)
    {
        $user = User::find(Auth::user()->id);
        $user->rentedCars()->save($car);
        $car->isRented = true;
        $car->save();
        return back();
    }
}
