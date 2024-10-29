<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daftung extends Model
{
    use HasFactory;

    protected $table = 'daftung'; // Nama tabel
    protected $fillable = [
        'No',
        'Nama_Pelanggan',
        'idpel',
        'Transaksi',
        'Tgl_permohonan',
        'Jam_penginputan',
        'Nama_Admin',
        // tambahkan field lain yang diperlukan
    ];
}
