@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Return a Car</h1>

        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Display Success Message -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Return Car Form -->
        <form method="POST" action="{{ route('rentals.returnCar') }}">
            @csrf
            <div>
                <label for="license_plate">License Plate:</label>
                <input type="text" name="license_plate" id="license_plate" required>
            </div>

            <button type="submit">Return Car</button>
        </form>
    </div>
@endsection
