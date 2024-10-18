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
            $table->unsignedBigInteger('departure_route_id')->nullable();;
            $table->time('departure_time')->nullable();
            $table->unsignedBigInteger('arrival_route_id')->nullable();;
            $table->time('arrival_time')->nullable();
            $table->string('type')->nullable();
            $table->unsignedBigInteger('operator_id')->nullable();;

            $table->foreign('operator_id')->references('id')->on('operators')->onDelete('cascade');
            $table->foreign('departure_route_id')->references('id')->on('routes')->onDelete('cascade');
            $table->foreign('arrival_route_id')->references('id')->on('routes')->onDelete('cascade');
    
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
