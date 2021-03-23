<?php

namespace App\Http\Controllers\Admin\Car;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Models\Car;
use App\Role\UserRole;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('check_user_role:admin');
    }

    public function index()
    {
        $cars = Car::paginate(10);
        return view('admins.cars', [
            'cars' => $cars
        ]);
    }

    public function renderAddForm()
    {
        return view('admins.add_car');
    }

    public function add(StoreCarRequest $request)
    {
        $imagePath = $request->file('car_image');
        $imageName = $imagePath->getClientOriginalName();
        $path = $request->file('car_image')->storeAs('car_images', $imageName, 'public');
        $image = '/storage/' . $path;
        Car::create([
            'model' => $request->model,
            'clearName' => $request->clearname,
            'description' => $request->description,
            'image' => $image,
            'nbPlaces' => $request->nbplaces,
            'price' => $request->price
        ]);
        return redirect()->route('cars@dashboard');
    }

    public function renderUpdateForm(Car $car, Request $request)
    {
        $car = $request->car;
        return view('admins.update_car', [
            'car' => $car
        ]);
    }

    public function update(int $id, UpdateCarRequest $request)
    {
        $car = Car::find($id);
        $car->model = $request->model;
        $car->clearName = $request->clearname;
        $car->description = $request->description;
        if ($request->file('car_image') == null) {
            $car->image = $car->image;
        } else {
            $imagePath = $request->file('car_image');
            $imageName = $imagePath->getClientOriginalName();
            $path = $request->file('car_image')->storeAs('car_images', $imageName, 'public');
            $image = '/storage/' . $path;
            $car->image = $image;
        }
        $car->nbPlaces = $request->nbplaces;
        $car->price = $request->price;
        $car->save();
        return redirect()->route('cars@dashboard');
    }

    public function delete(Car $car)
    {
        $car->renter()->dissociate();
        $car->delete();

        return back();
    }
}
