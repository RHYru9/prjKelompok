<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder; // Pastikan UserSeeder dipanggil
use Database\Seeders\PaketSeeder; // Pastikan PaketSeeder dipanggil
use Database\Seeders\CustomersSeeder; // Pastikan CustomersSeeder dipanggil jika ada

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Memanggil seeder untuk setiap model yang diinginkan
        $this->call(UserSeeder::class); // Memanggil UserSeeder untuk memasukkan data pengguna
        $this->call(PaketSeeder::class); // Memanggil PaketSeeder untuk memasukkan data paket
    }
}
