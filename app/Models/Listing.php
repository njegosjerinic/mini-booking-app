<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'city_id',
        'price_per_night',
        'beds',
        'max_persons',
        'image_path',
    ];

    // Veza sa gradom
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    // Veza sa rezervacijama
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    // Veza sa recenzijama
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
