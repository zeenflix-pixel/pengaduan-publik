@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Administrator')

@section('content')
<div class="row g-3 mb-4">
    <div class="col-md-2 col-6">
        <div class="card p-3 text-center">
            <div class="fs-2 fw-bold text-dark">{{ $stats['total_pengaduan'] }}</div>
            <div class="text-muted small">Total Pengaduan</div>
        </div>
    </div>
    <div class="col-md-2 col-6">
        <div class="card p-3 text-center border-start border-warning border-4">
            <div class="fs-2 fw-bold text-warning">{{ $stats['menunggu'] }}</div>
            <div class="text-muted small">Menunggu</div>
        </div>
    </div>
    <div class="col-md-2 col-6">
        <div class="card p-3 text-center border-start border-primary border-4">
            <div class="fs-2 fw-bold text-primary">{{ $stats['proses'] }}</div>
            <div class="text-muted small">Proses</div>
        </div>
    </div>
    <div class="col-md-2 col-6">
        <div class="card p-3 text-center border-start border-success border-4">
            <div class="fs-2 fw-bold text-success">{{ $stats['selesai'] }}</div>
            <div class="text-muted small">Selesai</div>
        </div>
    </div>
    <div class="col-md-2 col-6">
        <div class="card p-3 text-center border-start border-info border-4">
            <div class="fs-2 fw-bold text-info">{{ $stats['total_masyarakat'] }}</div>
            <div class="text-muted small">Masyarakat</div>
        </div>
    </div>
    <div class="col-md-2 col-6">
        <div class="card p-3 text-center border-start border-secondary border-4">
            <div class="fs-2 fw-bold text-secondary">{{ $stats['total_petugas'] }}</div>
            <div class="text-muted small">Petugas</div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-semibold">10 Pengaduan Terbaru</h6>
        <a href="/admin/pengaduan" class="btn btn-outline-primary btn-sm">Lihat Semua</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr><th>ID</th><th>Pelapor</th><th>Kategori</th><th>Tanggal</th><th>Status</th><th></th></tr>
                </thead>
                <tbody>
                    @foreach($terbaru as $p)
                    <tr>
                        <td class="small fw-semibold">{{ $p->id_pengaduan }}</td>
                        <td class="small">{{ $p->masyarakat->nama ?? '-' }}</td>
                        <td><span class="badge bg-secondary">{{ $p->kategori->nama_kategori }}</span></td>
                        <td class="small">{{ \Carbon\Carbon::parse($p->tanggal_lapor)->format('d/m/Y H:i') }}</td>
                        <td><span class="badge badge-{{ $p->status }}">{{ ucfirst($p->status) }}</span></td>
                        <td><a href="/admin/pengaduan/{{ $p->id_pengaduan }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-eye"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
