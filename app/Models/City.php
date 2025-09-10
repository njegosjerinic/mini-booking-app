<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // ⚠️ Ovo ti fali
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function listings()
    {
        return $this->hasMany(Listing::class);
    }
}
