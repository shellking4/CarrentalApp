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
        if ($request->file('car_image') == null) {
            $image = '/storage/car_images/car8.jpeg';
        } else {
            $imagePath = $request->file('car_image');
            $imageName = $imagePath->getClientOriginalName();
            $path = $request->file('car_image')->storeAs('car_images', $imageName, 'public');
            $image = '/storage/' . $path;
        }
        Car::create([
            'model' => $request->model,
            'clearName' => $request->clearname,
            'description' => $request->description,
            'image' => $image,
            'nbPlaces' => $request->nbplaces,
            'price' => $request->price
        ]);
        return redirect()->route('cars@dashboard')->with('add_success', "succesfully added an element");
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
        if (!$car->wasChanged()) {
            return redirect()->route('cars@dashboard');
        }
        return redirect()->route('cars@dashboard')->with('update_success', "successfully updated an element");
    }

    public function delete(Car $car)
    {
        $car->renter()->dissociate();
        $car->delete();

        return back()->with('delete_success', "successfully deleted an element");
    }
}
