<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use App\Models\Tanggapan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'menunggu' => Pengaduan::where('status', 'menunggu')->count(),
            'proses'   => Pengaduan::where('status', 'proses')->count(),
            'selesai'  => Pengaduan::where('status', 'selesai')->count(),
        ];
        $terbaru = Pengaduan::with(['masyarakat', 'kategori'])->latest('tanggal_lapor')->take(5)->get();
        return view('petugas.dashboard', compact('stats', 'terbaru'));
    }

    public function index()
    {
        $pengaduan = Pengaduan::with(['masyarakat', 'kategori', 'tanggapan'])
            ->latest('tanggal_lapor')
            ->paginate(15);
        return view('petugas.pengaduan.index', compact('pengaduan'));
    }

    public function show(string $id)
    {
        $pengaduan = Pengaduan::with(['masyarakat', 'kategori', 'tanggapan.petugas'])
            ->findOrFail($id);
        return view('petugas.pengaduan.show', compact('pengaduan'));
    }

    public function tanggapi(Request $request, string $id)
    {
        $request->validate([
            'isi_tanggapan' => 'required|string|min:5',
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        $idPetugas = auth()->user()->identifier;

        Tanggapan::create([
            'id_tanggapan'      => Tanggapan::generateId(),
            'id_pengaduan'      => $id,
            'id_petugas'        => $idPetugas,
            'tanggal_tanggapan' => now(),
            'isi_tanggapan'     => $request->isi_tanggapan,
        ]);

        // Update status ke 'proses' jika masih menunggu
        if ($pengaduan->status === 'menunggu') {
            $pengaduan->update(['status' => 'proses']);
        }

        return back()->with('success', 'Tanggapan berhasil dikirim!');
    }

    public function updateStatus(Request $request, string $id)
    {
        $request->validate(['status' => 'required|in:menunggu,proses,selesai']);
        Pengaduan::findOrFail($id)->update(['status' => $request->status]);
        return back()->with('success', 'Status pengaduan diperbarui!');
    }
}
