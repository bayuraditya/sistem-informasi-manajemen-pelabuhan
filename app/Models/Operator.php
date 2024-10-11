<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    use HasFactory;
    Protected $fillable = ['name','address','website','handphone_number','email'];

    public function ships()
    {
        return $this->hasMany(Ship::class);
    }
}
