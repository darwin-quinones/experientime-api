<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{

    // GET /api/cars - Retrieve all cars
    public function index() {
        return Car::all();
    }

    // POST /api/cars - Create a new car
    public function store(Request $request){
        //return $request->all();
        // create new car
        $current_date = date('Y-m-d', time());
        $car = new Car();
        $car->nombre = $request->input('nombre');
        $car->marca = $request->input('marca');
        $car->modelo = $request->input('modelo');
        $car->pais = $request->input('pais');
        $car->fechaCreate = $current_date;
        $car->save();

        return $car;
    }

    // GET /api/cars/{id} - Retrieve a specific car by ID
    public function show($id) {
        return Car::findOrFail($id);
    }

    // PUT /api/cars/{id} - Update a specific car by ID
    public function update(Request $request, $id){
        $car = Car::findOrFail($id);
        $car->update($request->all());
        return $car;
    }

    // DELETE /api/cars - Delete a specific car by ID
    public function destroy($id){
        Car::findOrFail($id)->delete();
        return response()->json(['message' => 'Car deleted successfully']);
    }

}
