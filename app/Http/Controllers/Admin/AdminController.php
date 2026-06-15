<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Kategori, Masyarakat, Pengaduan, Petugas, Tanggapan, User};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // ===================== DASHBOARD =====================
    public function dashboard()
    {
        $stats = [
            'total_pengaduan' => Pengaduan::count(),
            'menunggu'        => Pengaduan::where('status', 'menunggu')->count(),
            'proses'          => Pengaduan::where('status', 'proses')->count(),
            'selesai'         => Pengaduan::where('status', 'selesai')->count(),
            'total_masyarakat'=> Masyarakat::count(),
            'total_petugas'   => Petugas::count(),
        ];
        $terbaru = Pengaduan::with(['masyarakat', 'kategori'])->latest('tanggal_lapor')->take(10)->get();
        return view('admin.dashboard', compact('stats', 'terbaru'));
    }

    // ===================== PENGADUAN =====================
    public function pengaduanIndex(Request $request)
    {
        $query = Pengaduan::with(['masyarakat', 'kategori', 'tanggapan']);
        if ($request->status) $query->where('status', $request->status);
        if ($request->kategori) $query->where('id_kategori', $request->kategori);
        $pengaduan = $query->latest('tanggal_lapor')->paginate(15);
        $kategori  = Kategori::all();
        return view('admin.pengaduan.index', compact('pengaduan', 'kategori'));
    }

    public function pengaduanShow(string $id)
    {
        $pengaduan = Pengaduan::with(['masyarakat', 'kategori', 'tanggapan.petugas'])->findOrFail($id);
        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    public function pengaduanUpdateStatus(Request $request, string $id)
    {
        $request->validate(['status' => 'required|in:menunggu,proses,selesai']);
        Pengaduan::findOrFail($id)->update(['status' => $request->status]);
        return back()->with('success', 'Status diperbarui!');
    }

    public function pengaduanDestroy(string $id)
    {
        Pengaduan::findOrFail($id)->delete();
        return redirect('/admin/pengaduan')->with('success', 'Pengaduan dihapus!');
    }

    // ===================== PETUGAS =====================
    public function petugasIndex()
    {
        $petugas = Petugas::all();
        return view('admin.petugas.index', compact('petugas'));
    }

    public function petugasCreate()
    {
        return view('admin.petugas.create');
    }

    public function petugasStore(Request $request)
    {
        $request->validate([
            'id_petugas'   => 'required|max:5|unique:petugas,id_petugas',
            'nama_petugas' => 'required|max:100',
            'jabatan'      => 'nullable|max:50',
            'telepon'      => 'nullable|max:15',
            'password'     => 'required|min:6',
        ]);

        Petugas::create($request->only('id_petugas', 'nama_petugas', 'jabatan', 'telepon'));

        User::create([
            'identifier' => $request->id_petugas,
            'name'       => $request->nama_petugas,
            'password'   => Hash::make($request->password),
            'role'       => 'petugas',
        ]);

        return redirect('/admin/petugas')->with('success', 'Petugas berhasil ditambahkan!');
    }

    public function petugasDestroy(string $id)
    {
        Petugas::findOrFail($id)->delete();
        User::where('identifier', $id)->delete();
        return redirect('/admin/petugas')->with('success', 'Petugas dihapus!');
    }

    // ===================== KATEGORI =====================
    public function kategoriIndex()
    {
        $kategori = Kategori::withCount('pengaduan')->get();
        return view('admin.kategori.index', compact('kategori'));
    }

    public function kategoriStore(Request $request)
    {
        $request->validate([
            'id_kategori'   => 'required|max:3|unique:kategori',
            'nama_kategori' => 'required|max:50',
            'deskripsi'     => 'nullable',
        ]);
        Kategori::create($request->only('id_kategori', 'nama_kategori', 'deskripsi'));
        return redirect('/admin/kategori')->with('success', 'Kategori ditambahkan!');
    }

    public function kategoriDestroy(string $id)
    {
        Kategori::findOrFail($id)->delete();
        return redirect('/admin/kategori')->with('success', 'Kategori dihapus!');
    }

    // ===================== MASYARAKAT =====================
    public function masyarakatIndex()
    {
        $masyarakat = Masyarakat::withCount('pengaduan')->paginate(15);
        return view('admin.masyarakat.index', compact('masyarakat'));
    }
}
