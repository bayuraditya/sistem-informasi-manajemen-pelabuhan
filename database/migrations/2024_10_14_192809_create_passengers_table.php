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
        Schema::create('passengers', function (Blueprint $table) {
            $table->id();
            /*
            tgl,jumlah penumpang departure, jumlah penumpang arrival
             */
            $table->date('date');
            $table->unsignedBigInteger('ship_id'); 
            $table->foreign('ship_id')->references('id')->on('ships')->onDelete('cascade');
            $table->integer('departing_passenger');
            $table->integer('arrival_passenger');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passengers');
    }
};