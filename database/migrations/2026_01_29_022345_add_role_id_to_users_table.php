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
        Schema::table('users', function (Blueprint $table) {
            //? Kita tambahkan kolom role_id
            //? after('id') artinya kolom ini akan diletakkan setelah kolom id
            //? default(2) artinya otomatis jadi 'staff' (sesuai id di RoleSeeder)
            //? constrained('roles') artinya kolom ini terkoneksi ke tabel roles
            $table->foreignId('role_id')->after('id')->default(2)->constrained('roles');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Ini untuk membatalkan jika nanti ada error
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
};
