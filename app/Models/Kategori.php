<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $table = 'kategori';
    protected $primaryKey = 'id_kategori';
    public $incrementing = false;
    protected $keyType = 'string';
     public $timestamps = false;

    protected $fillable = ['id_kategori', 'nama_kategori', 'deskripsi'];

    public function pengaduan()
    {
        return $this->hasMany(Pengaduan::class, 'id_kategori', 'id_kategori');
    }
}
