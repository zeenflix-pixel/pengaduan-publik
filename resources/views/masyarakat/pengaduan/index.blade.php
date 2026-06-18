@extends('layouts.app')
@section('title', 'Pengaduan Saya')
@section('page-title', 'Pengaduan Saya')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center bg-white py-3">
        <h6 class="mb-0 fw-semibold">Riwayat Pengaduan</h6>
        <a href="/masyarakat/pengaduan/buat" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Buat Pengaduan Baru
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID Pengaduan</th>
                        <th>Kategori</th>
                        <th>Tanggal</th>
                        <th>Isi Laporan</th>
                        <th>Status</th>
                        <th>Tanggapan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengaduan as $p)
                    <tr>
                        <td class="fw-semibold small">{{ $p->id_pengaduan }}</td>
                        <td><span class="badge bg-secondary">{{ $p->kategori->nama_kategori ?? '-' }}</span></td>
                        <td class="small">{{ \Carbon\Carbon::parse($p->tanggal_lapor)->format('d/m/Y') }}</td>
                        <td class="small text-truncate" style="max-width:200px;">{{ $p->isi_laporan }}</td>
                        <td>
                            <span class="badge badge-{{ $p->status }}">{{ ucfirst($p->status) }}</span>
                        </td>
                        <td class="text-center">
                            @if($p->tanggapan && $p->tanggapan->count() > 0)
                                <span class="badge bg-info">{{ $p->tanggapan->count() }}</span>
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </td>
                        <td>
                            <a href="/masyarakat/pengaduan/{{ $p->id_pengaduan }}" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-eye"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                            Belum ada pengaduan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $pengaduan->links() }}</div>
    </div>
</div>
@endsection