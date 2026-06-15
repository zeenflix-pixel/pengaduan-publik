{{-- petugas/pengaduan/index.blade.php --}}
@extends('layouts.app')
@section('title', 'Daftar Pengaduan')
@section('page-title', 'Daftar Pengaduan Masuk')

@section('content')
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr><th>ID Pengaduan</th><th>Pelapor</th><th>Kategori</th><th>Tanggal</th><th>Status</th><th>Tanggapan</th><th></th></tr>
                </thead>
                <tbody>
                    @forelse($pengaduan as $p)
                    <tr>
                        <td class="fw-semibold small">{{ $p->id_pengaduan }}</td>
                        <td class="small">{{ $p->masyarakat->nama ?? '-' }}</td>
                        <td><span class="badge bg-secondary">{{ $p->kategori->nama_kategori }}</span></td>
                        <td class="small">{{ \Carbon\Carbon::parse($p->tanggal_lapor)->format('d/m/Y H:i') }}</td>
                        <td><span class="badge badge-{{ $p->status }}">{{ ucfirst($p->status) }}</span></td>
                        <td class="text-center">{{ $p->tanggapan->count() }}</td>
                        <td><a href="/petugas/pengaduan/{{ $p->id_pengaduan }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-chat-dots me-1"></i>Tanggapi
                        </a></td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">Tidak ada pengaduan</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $pengaduan->links() }}</div>
    </div>
</div>
@endsection
