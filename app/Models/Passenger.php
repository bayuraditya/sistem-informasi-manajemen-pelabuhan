<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;
    Protected $fillable = ['date','ship_id','departing_passenger'];
    
    public function ships(){
        return $this->hasMany(Ship::class);
    }
}
