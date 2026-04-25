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
        Schema::create('program_kerjas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karismatif_profile_id')->constrained()->cascadeOnDelete();
            $table->foreignId('bidang_id')->constrained()->cascadeOnDelete();
            //! eksplisitkan nama table di database nya agar laravel tidak salah merujuk
            $table->foreignId('responsible_people_id')->constrained('responsible_people')->cascadeOnDelete();
            $table->foreignId('mission_id')->constrained()->cascadeOnDelete();
            $table->string('nama_proker');
            $table->text('deskripsi');
            $table->string('photo_proker_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_kerjas');
    }
};
