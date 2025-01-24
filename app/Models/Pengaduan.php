<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;
    protected $table = 'pengaduan';
    protected $fillable = [
        'id',
        'nik',
        'nama',
        'no_hp',
        'email',
        'alamat',
        'judul',
        'deskripsi',
        'file',
        'status',
        'status_keaktifan',
        'respon_admin',
        'respon_pengadu'
    ];
}
