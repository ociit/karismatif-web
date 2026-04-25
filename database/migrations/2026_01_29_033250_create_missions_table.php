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
        Schema::create('missions', function (Blueprint $table) {
            $table->id();
            
            //? CARA MEMBUAT RELASI:
            //? foreignId('karismatif_profile_id') -> Harus sama dengan nama_tabel_tunggal_id
            //? constrained() -> Memberitahu Laravel ini merujuk ke tabel 'karismatif_profiles'
            //? cascadeOnDelete() -> JIKA profil dihapus, MISI ini ikut terhapus otomatis (rapi!)
            $table->foreignId('karismatif_profile_id')->constrained()->cascadeOnDelete();
            
            $table->integer('urutan')->default(1);
            $table->string('nama_misi');
            $table->text('keterangan_misi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('missions');
    }
};
