<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            // Kolom yang umum
            $table->string('name');
            $table->string('username')->unique(); // Tambahkan kolom username
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default('customer');

            // Data tambahan
            $table->date('dob')->nullable(); // Hanya gunakan ini untuk tanggal lahir
            $table->text('avatar')->nullable();
            $table->string('nomer_rekening', 14)->nullable();
            $table->string('nama_rekening')->nullable();

            // Laravel default
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
