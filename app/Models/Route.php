<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;
    protected $fillable = [
        'route'
    ];
    // public function ship()
    // {
    //     return $this->belongsTo(Ship::class);
    // }
    public function shipsAsDeparture()
    {
        return $this->hasMany(Ship::class, 'departure_route_id');
    }

    // Relasi ke model Ship sebagai arrival_route
    public function shipsAsArrival()
    {
        return $this->hasMany(Ship::class, 'arrival_route_id');
    }
}
