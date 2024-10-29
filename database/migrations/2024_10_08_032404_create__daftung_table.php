<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftungTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('daftung', function (Blueprint $table) {
            $table->id();
            $table->date('Tgl_permohonan');            
            $table->string('Nama_Pemohon', 100);
            $table->string('Nama_Pelanggan', 100);
            $table->bigInteger('idpel');
            $table->string('Transaksi', 25);
            $table->bigInteger('No_HP');
            $table->string('Status', 100);
            $table->integer('Daya');
            $table->string('Tarif', 100);
            $table->string('Alamat', 250);
            $table->boolean('is_validated')->default(false); // Menambahkan kolom is_validated
            $table->timestamps(); // Menambahkan kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftung');
    }
}

