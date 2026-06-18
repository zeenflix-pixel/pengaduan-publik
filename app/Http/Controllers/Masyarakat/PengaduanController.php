<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function dashboard()
    {
        $nik = auth()->user()->identifier;
        $stats = [
            'total'    => Pengaduan::where('nik', $nik)->count(),
            'menunggu' => Pengaduan::where('nik', $nik)->where('status', 'menunggu')->count(),
            'proses'   => Pengaduan::where('nik', $nik)->where('status', 'proses')->count(),
            'selesai'  => Pengaduan::where('nik', $nik)->where('status', 'selesai')->count(),
        ];
        $terbaru = Pengaduan::where('nik', $nik)->with('kategori')->latest('tanggal_lapor')->take(5)->get();
        return view('masyarakat.dashboard', compact('stats', 'terbaru'));
    }

    public function index()
    {
        $pengaduan = Pengaduan::where('nik', auth()->user()->identifier)
            ->with(['kategori', 'tanggapan'])
            ->latest('tanggal_lapor')
            ->paginate(10);
        return view('masyarakat.pengaduan.index', compact('pengaduan'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('masyarakat.pengaduan.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'isi_laporan' => 'required|string|min:20',
        ]);

       Pengaduan::create([
    'id_pengaduan'  => Pengaduan::generateId(),
    'nik'           => auth()->user()->nik,
    'id_kategori'   => $request->id_kategori,
    'tanggal_lapor' => now(),
    'isi_laporan'   => $request->isi_laporan,
    'email'         => $request->email, // <--- INI TAMBAHANNYA
    'status'        => 'menunggu',
]);

        return redirect('/masyarakat/pengaduan')->with('success', 'Pengaduan berhasil dikirim!');
    }

    public function show(string $id)
    {
        $pengaduan = Pengaduan::with(['kategori', 'tanggapan.petugas'])
            ->where('id_pengaduan', $id)
            ->where('nik', auth()->user()->identifier)
            ->firstOrFail();
        return view('masyarakat.pengaduan.show', compact('pengaduan'));
    }
}
