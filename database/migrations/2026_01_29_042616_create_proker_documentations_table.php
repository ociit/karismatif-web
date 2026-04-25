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
        Schema::create('proker_documentations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_kerja_id')->constrained()->cascadeOnDelete();
            $table->string('photo_documentation_path');
            $table->text('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proker_documentations');
    }
};
