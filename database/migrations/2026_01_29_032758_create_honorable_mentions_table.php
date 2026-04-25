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
        Schema::create('honorable_mentions', function (Blueprint $table) {
            $table->id();
            $table->string('photo_appreciate_path');
            $table->string('nama');
            $table->text('mention');
            $table->text('story')->nullable();
            $table->json('gallery_path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('honorable_mentions');
    }
};
