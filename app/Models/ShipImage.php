<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShipImage extends Model
{
    use HasFactory;
    protected $fillable = ['image','ship_id'];
    protected $table = 'ship_images';
    public function ship()
    {
        return $this->belongsTo(Ship::class);
    }

}
