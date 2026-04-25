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
        Schema::create('kriteria_ketercapaians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_kerja_id')->constrained()->cascadeOnDelete();
            $table->text('kriteria');
            $table->decimal('bobot_ketercapaian', 5, 2)->default(0);
            $table->boolean('isTercapai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kriteria_ketercapaians');
    }
};
