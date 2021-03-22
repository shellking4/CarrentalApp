<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\FreeRentFormRequest;
use App\Http\Requests\RentFormRequest;
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
        $user = Auth::user();
        $owedRentAmount = $user->owedRentAmount;
        $rents = $user->rentedCars->where('isRented', true)->all();
        return view('parc.rents', [
            'rents' => $rents,
            'owedRentAmount' => $owedRentAmount
        ]);
    }

    public function showCarrentalPolicies(Request $request)
    {
        return view('parc.policies');
    }

    public function freeRent(Car $car, FreeRentFormRequest $request)
    {
        $user = User::find(Auth::user()->id);
        $user->rentedCars()->save($car);
        $car->isFreeRented = true;
        $car->save();
        return redirect()->route('auth.user_free_rents')->with('free_rent_success', 'Car successfully freely rented');
    }

    public function rent(Car $car, RentFormRequest $request)
    {
        $rentTime = $request->rentTime;
        $user = User::find(Auth::user()->id);
        $user->rentedCars()->save($car);
        $car->costIfRented = $car->price * $rentTime;
        $car->isRented = true;
        $user->owedRentAmount += $car->costIfRented;
        $car->save();
        $user->save();
        return redirect()->route('auth.user_rents')->with('rent_success', 'Car successfully rented');
    }

    public function renderRentForm(Car $car)
    {
        return view('parc.rentForm', [
            'car' => $car
        ]);
    }

    public function renderFreeRentForm(Car $car)
    {
        return view('parc.freeRentForm', [
            'car' => $car
        ]);
    }

    public function sendRentedCarBack(Car $car)
    {
        $car->isRented = false;
        $car->renter()->dissociate();
        $car->costIfRented = null;
        $car->save();
        return redirect()->route('auth.user_rents');
    }

    public function sendFreeRentedCarBack(Car $car)
    {
        $car->isFreeRented = false;
        $car->renter()->dissociate();
        $car->save();
        return redirect()->route('auth.user_free_rents');
    }

    public function sendRentSuccessMessage()
    {
        return view('parc.rentSuccess');
    }

    public function sendFreeRentSuccessMessage()
    {
        return view('parc.freeRentSuccess');
    }
}
