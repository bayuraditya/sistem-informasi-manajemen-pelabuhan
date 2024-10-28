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
        Schema::create('retributions', function (Blueprint $table) {
            $table->id();
            $table->string('month')->nullable();
            $table->bigInteger('target')->nullable();
            $table->bigInteger('total')->nullable();
            // $table->enum('status', ['tercapai', 'belum tercapai'])->default('belum tercapai');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retributions');
    }
};
