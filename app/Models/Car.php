<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    // Tambahkan atribut yang bisa diisi secara massal
    protected $fillable = [
        'brand',
        'model',
        'license_plate',
        'rental_rate_per_day',
        'is_available'
    ];

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}
