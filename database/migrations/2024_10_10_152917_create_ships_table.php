<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

         /*
        
        b :
- operator : nama, alamat, website, email, no hp, 
- kapal : nama, keberangkatan, waktu berangkat, kedatangan, waktu kedatangan, keterangan, ID Operator
- pelanggan : tgl,  kapal, jumlah penumpang datang, jumlah penumpang turun, 
- user : nama, no telp, email, password, role,...
- review : point, nama, review, status
        */
    public function up(): void
    {
        Schema::create('ships', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('departure_route');
            $table->time('departure_time');
            $table->string('arrival_route');
            $table->time('arrival_time');
            $table->string('type');
            $table->unsignedBigInteger('operator_id'); 
            $table->foreign('operator_id')->references('id')->on('operators')->onDelete('cascade');
    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ships');
    }
};
