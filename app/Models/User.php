<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['identifier', 'name', 'email', 'password', 'role'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['password' => 'hashed'];

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isPetugas(): bool
    {
        return $this->role === 'petugas';
    }

    public function isMasyarakat(): bool
    {
        return $this->role === 'masyarakat';
    }

    public function masyarakat()
    {
        return $this->hasOne(Masyarakat::class, 'nik', 'identifier');
    }

    public function petugas()
    {
        return $this->hasOne(Petugas::class, 'id_petugas', 'identifier');
    }
}
