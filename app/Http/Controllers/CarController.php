<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{

    public function getAllCars(){
        return Car::all();
    }

    // GET /api/cars - Retrieve all cars
    public function index()
    {
        return Car::paginate(5);
    }

    // POST /api/cars - Create a new car
    public function store(Request $request)
    {
        //return $request->all();
        // create new car
        $current_date = date('Y-m-d', time());
        $car = new Car();
        $car->name = $request->input('name');
        $car->brand = $request->input('brand');
        $car->model = $request->input('model');
        $car->country = $request->input('country');
        $car->creation_date = $current_date;
        $car->save();

        return $car;
    }

    // GET /api/cars/{id} - Retrieve a specific car by ID
    public function show($id)
    {
        return Car::findOrFail($id);
    }

    // PUT /api/cars/{id} - Update a specific car by ID
    public function update(Request $request, $id)
    {
        $car = Car::findOrFail($id);
        $current_date = date('Y-m-d', time());
        $car->name = $request->input('name');
        $car->brand = $request->input('brand');
        $car->model = $request->input('model');
        $car->country = $request->input('country');
        $car->update_date = $current_date;
        $car->save();
        return $car;
    }

    // DELETE /api/cars - Delete a specific car by ID
    public function destroy($id)
    {
        Car::findOrFail($id)->delete();
        return response()->json(['message' => 'Car deleted successfully']);
    }
}
