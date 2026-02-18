<?php

namespace App\Models;

// Ganti bagian ini agar bisa digunakan untuk Auth
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'customers';

    protected $fillable = [
        'username',
        'foto',
        'email',
        'password',
        'no_hp',
        'alamat',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}