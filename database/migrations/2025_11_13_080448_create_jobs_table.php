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
    Schema::create('jobs', function (Blueprint $table) {
        $table->id();
        $table->string('title');                     // Nama posisi, misal: Staff Finance
        $table->string('slug')->unique();           // Untuk URL nanti, misal: staff-finance
        $table->string('location')->nullable();     // Lokasi kerja
        $table->string('type')->default('Full-time'); // Full-time, Internship, dll
        $table->text('short_description')->nullable(); // Ringkasan singkat
        $table->longText('description')->nullable();   // Deskripsi lengkap
        $table->longText('requirements')->nullable();  // Syarat/qualifikasi
        $table->boolean('is_open')->default(true);     // Masih buka / tutup
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
