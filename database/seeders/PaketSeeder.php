<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Paket;

class PaketSeeder extends Seeder
{
    public function run()
    {
        Paket::create([
            'id_referensi' => 'PKT12345',
            'nama_pengirim' => 'Andi Suprianto',
            'nama_penerima' => 'Budi Santoso',
            'jenis_paket' => 'Barang',
            'kategori' => 'Elektronik',
            'berat_kg' => 2.5,
            'harga' => 500000,
            'alamat_tujuan' => 'Jl. Merdeka No.10, Jakarta',
            'jenis_pengiriman' => 'cargo',
            'status' => 'Baru',
        ]);
        // Add other Paket::create() calls here...
    }
}
