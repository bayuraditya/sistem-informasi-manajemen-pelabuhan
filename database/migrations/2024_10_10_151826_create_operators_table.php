<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        /*
        
        b :
- operator : nama, alamat, website, email, no hp, 
- kapal : nama, keberangkatan, waktu berangkat, kedatangan, waktu kedatangan, keterangan, ID Operator
- pelanggan : tgl,  kapal, jumlah penumpang datang, jumlah penumpang turun, 
- user : nama, no telp, email, password, role,...
- review : point, nama, review, status
        */
        Schema::create('operators', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('website')->nullable();
            $table->string('handphone_number')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operators');
    }
};
