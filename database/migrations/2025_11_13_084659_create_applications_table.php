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
    Schema::create('applications', function (Blueprint $table) {
        $table->id();
        $table->foreignId('job_id')->constrained('jobs')->onDelete('cascade');
        $table->string('name');
        $table->string('email');
        $table->string('phone');
        $table->string('city')->nullable();
        $table->string('cv_path');            // lokasi file CV
        $table->string('status')->default('submitted'); // submitted / reviewed / accepted / rejected
        $table->text('notes')->nullable();    // catatan HR (future)
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::dropIfExists('applications');
}

};
