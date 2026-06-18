<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Masyarakat extends Model
{
    protected $table = 'masyarakat';
    protected $primaryKey = 'nik';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false; // ← TAMBAHKAN INI

    protected $fillable = ['nik', 'nama', 'telepon', 'alamat','email'];

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'nik', 'nik');
    }
}