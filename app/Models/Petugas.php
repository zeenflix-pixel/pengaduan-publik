<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    protected $table = 'petugas';
    protected $primaryKey = 'id_petugas';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['id_petugas', 'nama_petugas', 'jabatan', 'telepon'];

    public function tanggapan()
    {
        return $this->hasMany(Tanggapan::class, 'id_petugas', 'id_petugas');
    }
}
