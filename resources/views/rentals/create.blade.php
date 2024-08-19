@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">Rent a Car</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('rentals.store') }}" class="shadow p-4 rounded bg-light">
        @csrf
        <div class="mb-3">
            <label for="car_id" class="form-label">Choose a Car:</label>
            <select name="car_id" id="car_id" class="form-select" required>
                <option value="" disabled selected>Select a car</option>
                @foreach($availableCars as $car)
                    <option value="{{ $car->id }}">{{ $car->brand }} - {{ $car->model }} ({{ $car->license_plate }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date:</label>
            <input type="date" name="start_date" id="start_date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label">End Date:</label>
            <input type="date" name="end_date" id="end_date" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Rent Car</button>
    </form>
</div>
@endsection
