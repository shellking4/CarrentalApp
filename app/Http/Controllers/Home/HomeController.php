<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\FreeRentFormRequest;
use App\Http\Requests\PassResetFormRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Http\Requests\RentFormRequest;
use App\Models\Car;
use App\Models\User;
use App\Util\Value;
use Barryvdh\DomPDF\Facade as PDF;
use DateInterval;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public static $rentsCount;
    public static $freeRentsCount;

    public function __construct()
    {
        self::$rentsCount = new Value();
        self::$freeRentsCount = new Value();
    }

    public function index()
    {
        //$matchThese = ['isFreeRented' => false, 'isRented' => false];
        $cars = Car::all();
        return view('parc.cars', [
            'cars' => $cars
        ]);
    }

    public function getUserFreeRents(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }
        $freeRents = $user->rentedCars->where('isFreeRented', true)->all();
        $value = new Value();
        return view('parc.freeRents', [
            'freeRents' => $freeRents,
            'value' => $value
        ]);
    }

    public function getUserRents(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }
        $rents = $user->rentedCars->where('isRented', true)->all();
        $owedRentAmount = $user->owedRentAmount;


        return view('parc.rents', [
            'rents' => $rents,
            'owedRentAmount' => $owedRentAmount,
            'value' => self::$rentsCount
        ]);
    }

    public function showCarrentalPolicies(Request $request)
    {
        return view('parc.policies');
    }

    public function freeRent(Car $car, FreeRentFormRequest $request)
    {
        $user = User::find(Auth::user()->id);
        if (!$user) {
            return redirect()->route('login');
        }
        $user->rentedCars()->save($car);
        $car->isFreeRented = true;
        $car->locationDaysNumber = $request->rentTime;
        $now = new DateTime();
        $dateInterval = DateInterval::createFromDateString("$car->locationDaysNumber days");
        $now->add($dateInterval);
        $endOfRent = date('c', $now->getTimestamp());
        $car->endOfRentDate = $endOfRent;
        $car->save();
        return redirect()->route('auth.user_free_rents')->with('free_rent_success', 'Car successfully freely rented');
    }

    public function rent(Car $car, RentFormRequest $request)
    {
        $rentTime = $request->rentTime;
        $user = User::find(Auth::user()->id);
        if (!$user) {
            return redirect()->route('login');
        }
        $user->rentedCars()->save($car);
        $car->costIfRented = $car->price * $rentTime;
        $car->locationDaysNumber = $request->rentTime;
        $car->isRented = true;
        $user->owedRentAmount += $car->costIfRented;
        $now = new DateTime();
        $dateInterval = DateInterval::createFromDateString("$car->locationDaysNumber days");
        $now->add($dateInterval);
        $endOfRent = date('c', $now->getTimestamp());
        $car->endOfRentDate = $endOfRent;
        $car->save();
        $user->save();
        return redirect()->route('auth.user_rents')->with('rent_success', 'Car successfully freely rented');
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
        $car->locationDaysNumber = null;
        $car->endOfRentDate = null;
        $car->save();
        return redirect()->route('auth.user_rents');
    }

    public function sendFreeRentedCarBack(Car $car)
    {
        $car->isFreeRented = false;
        $car->renter()->dissociate();
        $car->locationDaysNumber = null;
        $car->endOfRentDate = null;
        $car->save();
        return redirect()->route('auth.user_free_rents');
    }

    public function pdfview(Request $request)
    {
        if ($request->has('download')) {
            $pdf = PDF::loadView('parc.policiesView');
            return $pdf->download('policies.pdf');
        }
        return view('parc.policies');
    }

    public function renderPassResetForm()
    {
        return view('auth.passReset');
    }

    public function resetPassword(PassResetFormRequest $request)
    {
        $user = User::find(Auth::user()->id);
        $user->password = Hash::make($request->password);
        $user->save();
        $credentials = [
            'login' => $user->login,
            'password' => $request->password
        ];
        if (!Auth::attempt($credentials)) {
            return back()->with('status', 'IDENTIFIANTS DE CONNEXION INVALIDES');
        }
        return redirect()->route('home')->with('pass_reset_success', 'Password Successfully Reset');
    }
}
