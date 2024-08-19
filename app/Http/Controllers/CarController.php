<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function create()
    {
        return view('cars.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'license_plate' => 'required|string|max:255|unique:cars',
            'rental_rate_per_day' => 'required|numeric',
        ]);

        Car::create([
            'brand' => $request->brand,
            'model' => $request->model,
            'license_plate' => $request->license_plate,
            'rental_rate_per_day' => $request->rental_rate_per_day,
            'is_available' => true,
        ]);

        return redirect()->route('cars.index')->with('success', 'Car added successfully!');
    }

    public function index()
    {
        $cars = Car::where('is_available', true)->get();
        return view('cars.index', compact('cars'));
    }

    public function search(Request $request)
    {
        $query = Car::query();

        if ($request->filled('brand')) {
            $query->where('brand', 'like', '%' . $request->brand . '%');
        }

        if ($request->filled('model')) {
            $query->where('model', 'like', '%' . $request->model . '%');
        }

        if ($request->filled('is_available')) {
            $query->where('is_available', $request->is_available == '1');
        }

        $cars = $query->get();

        return view('cars.index', compact('cars'));
    }

    public function edit($id)
    {
        $car = Car::findOrFail($id);
        return view('cars.edit', compact('car'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'license_plate' => 'required|string|max:255',
            'rental_rate_per_day' => 'required|numeric',
            'is_available' => 'required|boolean',
        ]);

        $car = Car::findOrFail($id);
        $car->update($request->all());

        return redirect()->route('cars.index')->with('success', 'Car updated successfully');
    }

    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        $car->delete();

        return redirect()->route('cars.index')->with('success', 'Car deleted successfully.');
    }

}

