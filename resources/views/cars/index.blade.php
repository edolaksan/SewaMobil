@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h1 class="mb-4 text-center">Available Cars for Rent</h1>

        <!-- Display Success Message -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Tombol Create Car -->
        <div class="d-flex justify-content-between mb-4">
            <a href="{{ route('cars.create') }}" class="btn btn-primary">Create Car</a>
        </div>

        <!-- Form pencarian mobil -->
        <form method="GET" action="{{ route('cars.search') }}" class="mb-4">
            <div class="row g-3">
                <div class="col-md-4">
                    <label for="brand" class="form-label">Search by Brand:</label>
                    <input type="text" class="form-control" name="brand" value="{{ request('brand') }}"
                        placeholder="Enter brand">
                </div>

                <div class="col-md-4">
                    <label for="model" class="form-label">Search by Model:</label>
                    <input type="text" class="form-control" name="model" value="{{ request('model') }}"
                        placeholder="Enter model">
                </div>

                <div class="col-md-4">
                    <label for="is_available" class="form-label">Availability:</label>
                    <select name="is_available" class="form-select">
                        <option value="">All</option>
                        <option value="1" {{ request('is_available') == '1' ? 'selected' : '' }}>Available</option>
                        <option value="0" {{ request('is_available') == '0' ? 'selected' : '' }}>Not Available</option>
                    </select>
                </div>
            </div>
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>

        <!-- Daftar mobil -->
        <div class="row">
            @forelse($cars as $car)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $car->brand }} - {{ $car->model }}</h5>
                            <p class="card-text">
                                <strong>License Plate:</strong> {{ $car->license_plate }} <br>
                                <strong>Rental Rate:</strong> ${{ $car->rental_rate_per_day }} per day
                            </p>
                            <p class="card-text">
                                <strong>Status:</strong>
                                @if ($car->is_available)
                                    <span class="badge bg-success">Available</span>
                                @else
                                    <span class="badge bg-danger">Not Available</span>
                                @endif
                            </p>
                            <br>
                            <!-- Tombol Edit -->
                            <a href="{{ route('cars.edit', $car->id) }}" class="btn btn-warning">Edit</a>

                            <!-- Form Delete -->
                            <form action="{{ route('cars.destroy', $car->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this car?');">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center">No cars available for the selected criteria.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
