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
        Schema::table('daftung', function (Blueprint $table) {
                    $table->string('Nama_Admin')->nullable(); // Menambahkan kolom Nama_Admin

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('daftung', function (Blueprint $table) {
                       $table->dropColumn('Nama_Admin'); // Menghapus kolom Nama_Admin saat rollback

        });
    }
};
