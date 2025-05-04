<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;

class Customer extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'dob',
        'avatar',
        'role',
        'email_verified_at',
        'nomer_rekening',
        'nama_rekening',
        'tanggal_lahir',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'dob' => 'date',
        'tanggal_lahir' => 'date',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($customer) {
            if (!empty($customer->password)) {
                $customer->password = Hash::make($customer->password);
            }
        });

        static::updating(function ($customer) {
            if (!empty($customer->password) && $customer->isDirty('password')) {
                $customer->password = Hash::make($customer->password);
            }
        });
    }

    public function scopeOnlyCustomerAndDriver($query)
    {
        return $query->whereIn('role', ['customer', 'driver']);
    }
}
