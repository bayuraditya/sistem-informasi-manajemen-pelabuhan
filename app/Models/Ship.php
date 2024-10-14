<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ship extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'departure_place',
        'departure_time',
        'arrival_place',
        'arrival_time',
        'type',
        'operator_id'
    ];
    public function operator()
    {
        return $this->belongsTo(Operator::class);
    }
    // public function passenger()
    // {
    //     return $this->belongsTo(Passenger::class);
    // }
    public function passengers()
    {
        return $this->hasMany(Ship::class);
    }
}
