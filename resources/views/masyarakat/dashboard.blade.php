@extends('layouts.app')
@section('title', 'Dashboard Saya')
@section('page-title', 'Dashboard')

@section('content')
<div class="row g-3 mb-4">
    <div class="col-md-3 col-6">
        <div class="card p-3 text-center">
            <div class="fs-2 fw-bold text-primary">{{ $stats['total'] }}</div>
            <div class="text-muted small">Total Pengaduan</div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="card p-3 text-center">
            <div class="fs-2 fw-bold text-warning">{{ $stats['menunggu'] }}</div>
            <div class="text-muted small">Menunggu</div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="card p-3 text-center">
            <div class="fs-2 fw-bold text-primary">{{ $stats['proses'] }}</div>
            <div class="text-muted small">Diproses</div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="card p-3 text-center">
            <div class="fs-2 fw-bold text-success">{{ $stats['selesai'] }}</div>
            <div class="text-muted small">Selesai</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center bg-white py-3">
        <h6 class="mb-0 fw-semibold">Pengaduan Terbaru</h6>
        <a href="/masyarakat/pengaduan/buat" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Buat Pengaduan
        </a>
    </div>
    <div class="card-body p-0">
        @forelse($terbaru as $p)
        <div class="d-flex align-items-center border-bottom p-3">
            <div class="flex-grow-1">
                <div class="fw-semibold small">{{ $p->id_pengaduan }}</div>
                <div class="text-muted small">{{ $p->kategori->nama_kategori }} &bull; {{ \Carbon\Carbon::parse($p->tanggal_lapor)->format('d M Y') }}</div>
                <div class="small text-truncate" style="max-width:400px;">{{ $p->isi_laporan }}</div>
            </div>
            <div class="ms-3 d-flex align-items-center gap-2">
                <span class="badge badge-{{ $p->status }}">{{ ucfirst($p->status) }}</span>
                <a href="/masyarakat/pengaduan/{{ $p->id_pengaduan }}" class="btn btn-outline-secondary btn-sm">
                    <i class="bi bi-eye"></i>
                </a>
            </div>
        </div>
        @empty
        <div class="p-4 text-center text-muted">
            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
            Belum ada pengaduan. <a href="/masyarakat/pengaduan/buat">Buat pengaduan pertama</a>
        </div>
        @endforelse
    </div>
</div>
@endsection
