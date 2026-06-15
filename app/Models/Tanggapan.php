<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    protected $table = 'tanggapan';
    protected $primaryKey = 'id_tanggapan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['id_tanggapan', 'id_pengaduan', 'id_petugas', 'tanggal_tanggapan', 'isi_tanggapan'];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class, 'id_pengaduan', 'id_pengaduan');
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'id_petugas', 'id_petugas');
    }

    public static function generateId(): string
    {
        $prefix = 'TGP' . now()->format('ymd');
        $last = self::where('id_tanggapan', 'like', $prefix . '%')->count();
        return $prefix . str_pad($last + 1, 3, '0', STR_PAD_LEFT);
    }
}
