@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4 text-center">Edit Car</h1>

        <form method="POST" action="{{ route('cars.update', $car->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="brand" class="form-label">Brand</label>
                <input type="text" class="form-control" id="brand" name="brand" value="{{ old('brand', $car->brand) }}" required>
            </div>

            <div class="mb-3">
                <label for="model" class="form-label">Model</label>
                <input type="text" class="form-control" id="model" name="model" value="{{ old('model', $car->model) }}" required>
            </div>

            <div class="mb-3">
                <label for="license_plate" class="form-label">License Plate</label>
                <input type="text" class="form-control" id="license_plate" name="license_plate" value="{{ old('license_plate', $car->license_plate) }}" required>
            </div>

            <div class="mb-3">
                <label for="rental_rate_per_day" class="form-label">Rental Rate per Day</label>
                <input type="number" step="0.01" class="form-control" id="rental_rate_per_day" name="rental_rate_per_day"
                    value="{{ old('rental_rate_per_day', $car->rental_rate_per_day) }}" required>
            </div>

            <div class="mb-3">
                <label for="is_available" class="form-label">Availability</label>
                <select name="is_available" id="is_available" class="form-select">
                    <option value="1" {{ $car->is_available ? 'selected' : '' }}>Available</option>
                    <option value="0" {{ !$car->is_available ? 'selected' : '' }}>Not Available</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Update Car</button>
        </form>
    </div>
@endsection
