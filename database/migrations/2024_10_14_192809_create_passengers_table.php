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
            $table->unsignedBigInteger('ship_id')->nullable(); 
            $table->integer('departure_passenger')->nullable();
            $table->integer('departure_passenger_retribution')->nullable();
            $table->bigInteger('retribution')->nullable();
            $table->enum('retribution_status', ['lunas', 'belum lunas'])->default('belum lunas');
            $table->integer('arrival_passenger')->nullable();
            $table->unsignedBigInteger('user_passenger_id')->nullable(); 
            $table->unsignedBigInteger('user_retribution_id')->nullable(); 
            $table->timestamps();
            
            $table->foreign('ship_id')->references('id')->on('ships')->onDelete('cascade');
            $table->foreign('user_passenger_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_retribution_id')->references('id')->on('users')->onDelete('cascade');

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
