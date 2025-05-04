<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_referensi',
        'nama_pengirim',
        'nama_penerima',
        'jenis_paket',
        'kategori',
        'berat_kg',
        'harga',
        'alamat_tujuan',
        'jenis_pengiriman',
        'status',
    ];
}
