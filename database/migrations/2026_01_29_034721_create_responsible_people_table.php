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
        Schema::create('responsible_people', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karismatif_profile_id')->constrained()->cascadeOnDelete();
            $table->foreignId('bidang_id')->constrained()->cascadeOnDelete();
            $table->string('nama_pengurus');
            $table->string('nama_panggilan');
            $table->string('photo_profile_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('responsible_people');
    }
};
