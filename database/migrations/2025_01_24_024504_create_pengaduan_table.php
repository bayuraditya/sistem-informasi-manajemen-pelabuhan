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
        Schema::create('pengaduan', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('nik')->unique(); // NIK
            $table->string('nama'); // Nama
            $table->string('no_hp'); // No HP
            $table->string('email')->nullable(); // Email (opsional)
            $table->text('alamat'); // Alamat
            $table->string('judul'); // Judul
            $table->text('deskripsi'); // Deskripsi
            $table->string('file')->nullable(); // File (foto, dokumen, dll)
            $table->enum('status', ['diterima', 'ditolak'])->default('diterima'); // Status (diterima, ditolak)
            $table->enum('status_keaktifan', ['aktif', 'tidak aktif'])->default('aktif'); // Status keaktifan
            $table->text('respon_admin')->nullable(); // Respon Admin
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Foreign key user_id mengarah ke tabel users
            $table->text('respon_pengadu')->nullable(); // Respon Pengadu
            $table->timestamps(); // Created_at dan Updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengaduan');
    }
};
