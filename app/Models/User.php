<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Atribut yang dapat diisi massal
    protected $fillable = [
        'name',
        'username',
        'password',
    ];

    // Atribut yang tidak boleh di-serialize (disembunyikan)
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Opsi untuk mengatur atribut mutator agar password selalu di-hash
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
