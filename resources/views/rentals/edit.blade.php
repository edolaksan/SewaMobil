@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-4">Edit Rental</h1>

        <!-- Form Edit Rental -->
        <form action="{{ route('rentals.update', $rental->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="car_id" class="form-label">Car:</label>
                <select name="car_id" class="form-select" required>
                    @foreach ($cars as $car)
                        <option value="{{ $car->id }}" {{ $car->id == $rental->car_id ? 'selected' : '' }}>
                            {{ $car->brand }} - {{ $car->model }} ({{ $car->license_plate }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="start_date" class="form-label">Start Date:</label>
                <input type="date" class="form-control" name="start_date" value="{{ $rental->start_date }}" required>
            </div>

            <div class="mb-3">
                <label for="end_date" class="form-label">End Date:</label>
                <input type="date" class="form-control" name="end_date" value="{{ $rental->end_date }}" required>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Update Rental</button>
                <a href="{{ route('rentals.index') }}" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </div>
@endsection
