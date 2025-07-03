<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passenger extends Model
{
    use HasFactory;
    Protected $fillable = ['date','ship_id','departure_passenger','arrival_passenger'];
    
// Full texts
// id
// date
// ship_id
// departure_passenger
// retribution
// arrival_passenger
// user_id

    // public function ships(){
    //     return $this->hasMany(Ship::class);
    // }
    public function ship(){
        return $this->belongsTo(Ship::class);
    }
    // public function user(){
    //     return $this->belongsTo(User::class);
    // }
    public function passengerUser()
    {
        return $this->belongsTo(User::class, 'user_passenger_id');
    }

    // Relasi ke User untuk kolom user_retribution_id
    public function retributionUser()
    {
        return $this->belongsTo(User::class, 'user_retribution_id');
    }
}
