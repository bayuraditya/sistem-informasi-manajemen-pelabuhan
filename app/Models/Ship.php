<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'departure_route_id', 'departure_time', 'arrival_route_id', 'arrival_time', 'type', 'operator_id'
    ];

    // Relasi ke model Route untuk rute keberangkatan
    public function departureRoute()
    {
        return $this->belongsTo(Route::class, 'departure_route_id');
    }

    // Relasi ke model Route untuk rute kedatangan
    public function arrivalRoute()
    {
        return $this->belongsTo(Route::class, 'arrival_route_id');
    }

    // Relasi ke model Operator
    public function operator()
    {
        return $this->belongsTo(Operator::class);
    }

    // Relasi ke model Passenger
    public function passengers()
    {
        return $this->hasMany(Passenger::class);
    }
    
}
