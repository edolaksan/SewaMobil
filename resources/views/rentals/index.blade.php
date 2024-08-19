@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <h1 class="text-center mb-4">Your Rentals</h1>
        <div class="d-flex justify-content-between mb-4">
            <!-- Tombol Create Rental -->
            <a href="{{ route('rentals.create') }}" class="btn btn-primary">Create Rental</a>

            <!-- Tombol Return Car -->
            <a href="{{ route('rentals.return') }}" class="btn btn-secondary">Return Car</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($rentals->isEmpty())
            <div class="alert alert-info text-center">You have no rentals at the moment.</div>
        @else
            <div class="row row-cols-1 row-cols-md-2 g-4">
                @foreach ($rentals as $rental)
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">{{ $rental->car->brand }} - {{ $rental->car->model }}</h5>
                                <p class="card-text">
                                    License Plate: <strong>{{ $rental->car->license_plate }}</strong>
                                </p>
                                <p class="card-text">
                                    Rental Period: <strong>{{ $rental->start_date }}</strong> to
                                    <strong>{{ $rental->end_date }}</strong>
                                </p>
                                <br>
                                <!-- Tombol Edit -->
                                <a href="{{ route('rentals.edit', $rental->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            </div>
                            <div class="card-footer text-muted">
                                Rental ID: {{ $rental->id }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
