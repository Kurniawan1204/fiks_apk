<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('daftung', function (Blueprint $table) {
            $table->timestamp('input_time')->nullable(); // Menambahkan kolom untuk waktu penginputan
        });
    }
    
    public function down()
    {
        Schema::table('daftung', function (Blueprint $table) {
            $table->dropColumn('input_time'); // Menghapus kolom saat migrasi dirollback
        });
    }
    
};
