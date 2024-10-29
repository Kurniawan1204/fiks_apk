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
        Schema::create('jumlah_daftung', function (Blueprint $table) {
            $table->id();
            $table->date('Tgl_permohonan', 50);            
            $table->string('Nama_Pemohon', 100);
            $table->string('Nama_Pelanggan', 100);
            $table->bigInteger('idpel');
            $table->string('Transaksi', 25);
            $table->bigInteger('No_HP');
            $table->bigInteger('NO_agenda');
            $table->string('Status', 100);
            $table->integer('Daya');
            $table->string('Tarif', 100);
            $table->string('Alamat', 250);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jumlah_daftung');
    }
};
