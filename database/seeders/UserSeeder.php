<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admins
        User::create([
            'name' => 'Reyhan',
            'username' => 'reyhanadmin',
            'email' => 'admin@rhyru9.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'dob' => '1990-01-15',
            'avatar' => 'images/boy.png',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'rhyru9 Super Admin',
            'username' => 'superadmin',
            'email' => 'super@rhyru9.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'dob' => '1988-05-12',
            'avatar' => 'images/boy.png',
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Drivers
        $drivers = [
            [
                'name' => 'John Driver',
                'username' => 'john_driver',
                'email' => 'john@rhyru9.id',
                'password' => Hash::make('driver123'),
                'role' => 'driver',
                'dob' => '1995-07-22',
                'avatar' => 'images/boy.png',
                'nomer_rekening' => '12345678901234',
                'nama_rekening' => 'John Driver',
            ],
            [
                'name' => 'Sarah Driver',
                'username' => 'sarah_driver',
                'email' => 'sarah@rhyru9.id',
                'password' => Hash::make('driver123'),
                'role' => 'driver',
                'dob' => '1992-03-18',
                'avatar' => 'images/boy.png',
                'nomer_rekening' => '23456789012345',
                'nama_rekening' => 'Sarah Driver',
            ],
            [
                'name' => 'Mike Driver',
                'username' => 'mike_driver',
                'email' => 'mike@rhyru9.id',
                'password' => Hash::make('driver123'),
                'role' => 'driver',
                'dob' => '1990-11-30',
                'avatar' => 'images/boy.png',
                'nomer_rekening' => '34567890123456',
                'nama_rekening' => 'Mike Driver',
            ]
        ];

        foreach ($drivers as $driver) {
            User::create(array_merge($driver, [
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // Customers
        $customers = [
            [
                'name' => 'Alice Customer',
                'username' => 'alice_customer',
                'email' => 'alice@rhyru9.id',
                'password' => Hash::make('customer123'),
                'role' => 'customer',
                'dob' => '1998-02-14',
                'avatar' => 'images/boy.png',
                'nomer_rekening' => '12345678901234',
                'nama_rekening' => 'Alice A. Customer',
            ],
            [
                'name' => 'Bob Customer',
                'username' => 'bob_customer',
                'email' => 'bob@rhyru9.id',
                'password' => Hash::make('customer123'),
                'role' => 'customer',
                'dob' => '1996-09-05',
                'avatar' => 'images/boy.png',
                'nomer_rekening' => '23456789012345',
                'nama_rekening' => 'Bob B. Customer',
            ],
            [
                'name' => 'Carol Customer',
                'username' => 'carol_customer',
                'email' => 'carol@rhyru9.id',
                'password' => Hash::make('customer123'),
                'role' => 'customer',
                'dob' => '1999-12-25',
                'avatar' => 'images/boy.png',
                'nomer_rekening' => '34567890123456',
                'nama_rekening' => 'Carol C. Customer',
            ],
            [
                'name' => 'David Customer',
                'username' => 'david_customer',
                'email' => 'david@rhyru9.id',
                'password' => Hash::make('customer123'),
                'role' => 'customer',
                'dob' => '1997-06-17',
                'avatar' => 'images/boy.png',
                'nomer_rekening' => '45678901234567',
                'nama_rekening' => 'David D. Customer',
            ],
            [
                'name' => 'Emma Customer',
                'username' => 'emma_customer',
                'email' => 'emma@rhyru9.id',
                'password' => Hash::make('customer123'),
                'role' => 'customer',
                'dob' => '2000-04-30',
                'avatar' => 'images/boy.png',
                'nomer_rekening' => '55667788990011',
                'nama_rekening' => 'Emma E. Customer',
            ]
        ];

        foreach ($customers as $customer) {
            User::create(array_merge($customer, [
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
