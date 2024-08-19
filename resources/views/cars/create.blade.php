@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="mb-4 text-center">Add New Car</h1>

    <form method="POST" action="{{ route('cars.store') }}" class="row g-3">
        @csrf
        <div class="col-md-6">
            <label for="brand" class="form-label">Brand:</label>
            <input type="text" class="form-control" name="brand" placeholder="Enter car brand" required>
        </div>

        <div class="col-md-6">
            <label for="model" class="form-label">Model:</label>
            <input type="text" class="form-control" name="model" placeholder="Enter car model" required>
        </div>

        <div class="col-md-6">
            <label for="license_plate" class="form-label">License Plate:</label>
            <input type="text" class="form-control" name="license_plate" placeholder="Enter license plate" required>
        </div>

        <div class="col-md-6">
            <label for="rental_rate_per_day" class="form-label">Rental Rate Per Day:</label>
            <input type="number" class="form-control" name="rental_rate_per_day" step="0.01" placeholder="Enter rental rate" required>
        </div>

        <div class="col-12 text-center mt-4">
            <button type="submit" class="btn btn-primary">Add Car</button>
        </div>
    </form>
</div>
@endsection
