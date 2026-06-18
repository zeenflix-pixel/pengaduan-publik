<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $table = 'pengaduan';
    protected $primaryKey = 'id_pengaduan';
    public $incrementing = false;
    protected $keyType = 'string';

  protected $fillable = ['id_pengaduan', 'nik', 'id_kategori', 'tanggal_lapor', 'isi_laporan', 'status', 'email'];

    public function masyarakat()
    {
        return $this->belongsTo(Masyarakat::class, 'nik', 'nik');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function tanggapan()
    {
        return $this->hasMany(Tanggapan::class, 'id_pengaduan', 'id_pengaduan');
    }

    public static function generateId(): string
    {
        $prefix = 'PGD' . now()->format('ymd');
        $last = self::where('id_pengaduan', 'like', $prefix . '%')->count();
        return $prefix . str_pad($last + 1, 3, '0', STR_PAD_LEFT);
    }
}
