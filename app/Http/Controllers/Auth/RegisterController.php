<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /**
     * Menampilkan form registrasi pengguna.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Menangani proses registrasi pengguna.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        // Validasi input pengguna menggunakan fungsi validator
        $this->validator($request->all())->validate();

        // Membuat pengguna baru menggunakan fungsi create
        $user = $this->create($request->all());

        // Setelah registrasi berhasil, login pengguna dan arahkan ke dashboard
        auth()->login($user);

        return redirect()->route('home')->with('success', 'Registrasi berhasil!');
    }

    /**
     * Validator untuk memvalidasi data input pengguna.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'address' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:15'],
            'driver_license_number' => ['required', 'string', 'max:20', 'unique:users,driver_license_number'],
        ]);
    }

    /**
     * Membuat pengguna baru dalam database.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'address' => $data['address'],
            'phone_number' => $data['phone_number'],
            'driver_license_number' => $data['driver_license_number'],
        ]);
    }
}
