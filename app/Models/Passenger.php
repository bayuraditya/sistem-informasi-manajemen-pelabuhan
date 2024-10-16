<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;
    Protected $fillable = ['date','ship_id','departure_passenger','arrival_passenger'];
    
    // public function ships(){
    //     return $this->hasMany(Ship::class);
    // }
    public function ship(){
        return $this->belongsTo(Passenger::class);
    }
}
