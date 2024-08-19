<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class RentalController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $availableCars = Car::where('is_available', true)->get();
        return view('rentals.create', compact('availableCars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $rentalConflict = Rental::where('car_id', $request->car_id)
            ->where(function ($query) use ($request) {
                $query->whereBetween('start_date', [$request->start_date, $request->end_date])
                    ->orWhereBetween('end_date', [$request->start_date, $request->end_date]);
            })
            ->exists();

        if ($rentalConflict) {
            return redirect()->back()->withErrors(['error' => 'Mobil tidak tersedia pada tanggal yang diminta.']);
        }

        Rental::create([
            'car_id' => $request->car_id,
            'user_id' => Auth::id(),
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        $car = Car::find($request->car_id);
        $car->is_available = false;
        $car->save();

        return redirect()->route('rentals.index')->with('success', 'Mobil berhasil disewa.');
    }

    public function index()
    {
        $rentals = Rental::where('user_id', Auth::id())->get();
        return view('rentals.index', compact('rentals'));
    }

    public function showReturnForm()
    {
        return view('rentals.return');
    }

    // Memproses pengembalian mobil
    public function returnCar(Request $request)
    {

        $request->validate([
            'license_plate' => 'required|string',
        ]);

        $rental = Rental::whereHas('car', function ($query) use ($request) {
            $query->where('license_plate', $request->license_plate);
        })->whereNull('return_date')->first(); // Pastikan mobil belum dikembalikan

        if ($rental) {
            // Hitung jumlah hari penyewaan
            $rental->return_date = now();
            $rental->save();

            $days_rented = $rental->return_date->diffInDays($rental->rental_date);
            $daily_rate = $rental->car->daily_rate;
            $total_cost = $days_rented * $daily_rate;

            $rental->total_cost = $total_cost;
            $rental->save();

            return redirect()->route('rentals.showReturnForm')
            ->with('success', 'Car returned successfully! Total cost: $' . $total_cost);
        }

        return redirect()->back()->withErrors(['license_plate' => 'Car not found or already returned.']);
    }

    public function edit(Rental $rental)
    {
        $cars = Car::all();

        return view('rentals.edit', compact('rental', 'cars'));
    }

    public function update(Request $request, Rental $rental)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $rental->update([
            'car_id' => $request->car_id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('rentals.index')->with('success', 'Rental updated successfully!');
    }

    public function destroy(Rental $rental)
    {
        // Menghapus penyewaan
        $rental->delete();

        return redirect()->route('rentals.index')->with('success', 'Rental deleted successfully.');
    }
}
