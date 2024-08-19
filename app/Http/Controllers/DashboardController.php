<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCars = Car::count();
        $activeRentals = Rental::where('status', 'active')->count();

        return view('dashboard', compact('totalCars', 'activeRentals'));
    }
}
