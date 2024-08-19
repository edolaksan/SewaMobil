<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    // Tambahkan atribut yang bisa diisi secara massal
    protected $fillable = [
        'car_id',
        'user_id',
        'start_date',
        'end_date',
        'return_date'
    ];

    // Relasi dengan model Car
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    // Tambahkan relasi user jika diperlukan
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
