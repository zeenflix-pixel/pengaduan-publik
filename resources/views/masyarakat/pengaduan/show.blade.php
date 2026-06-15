@extends('layouts.app')
@section('title', 'Detail Pengaduan')
@section('page-title', 'Detail Pengaduan')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-header bg-white py-3 d-flex justify-content-between">
                <h6 class="mb-0 fw-semibold">{{ $pengaduan->id_pengaduan }}</h6>
                <span class="badge badge-{{ $pengaduan->status }} fs-6">{{ ucfirst($pengaduan->status) }}</span>
            </div>
            <div class="card-body">
                <table class="table table-borderless small mb-3">
                    <tr><th width="140">Kategori</th><td>{{ $pengaduan->kategori->nama_kategori }}</td></tr>
                    <tr><th>Tanggal Lapor</th><td>{{ \Carbon\Carbon::parse($pengaduan->tanggal_lapor)->format('d F Y, H:i') }}</td></tr>
                    <tr><th>Status</th><td><span class="badge badge-{{ $pengaduan->status }}">{{ ucfirst($pengaduan->status) }}</span></td></tr>
                </table>
                <div class="bg-light rounded p-3">
                    <p class="fw-semibold small text-muted mb-1">ISI LAPORAN</p>
                    <p class="mb-0">{{ $pengaduan->isi_laporan }}</p>
                </div>
            </div>
        </div>

        {{-- Tanggapan --}}
        <div class="card">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-semibold"><i class="bi bi-chat-dots me-2"></i>Tanggapan Petugas ({{ $pengaduan->tanggapan->count() }})</h6>
            </div>
            <div class="card-body">
                @forelse($pengaduan->tanggapan as $t)
                <div class="d-flex mb-3">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                         style="width:40px;height:40px;font-size:14px;">
                        <i class="bi bi-person-badge-fill"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="bg-light rounded p-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="fw-semibold small">{{ $t->petugas->nama_petugas ?? $t->id_petugas }}</span>
                                <span class="text-muted small">{{ \Carbon\Carbon::parse($t->tanggal_tanggapan)->format('d/m/Y H:i') }}</span>
                            </div>
                            <p class="mb-0 small">{{ $t->isi_tanggapan }}</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center text-muted py-3">
                    <i class="bi bi-hourglass-split fs-2 d-block mb-2"></i>
                    Belum ada tanggapan dari petugas.
                </div>
                @endforelse
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center p-4">
                <a href="/masyarakat/pengaduan" class="btn btn-outline-secondary w-100 mb-2">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
                <a href="/masyarakat/pengaduan/buat" class="btn btn-primary w-100">
                    <i class="bi bi-plus-circle me-1"></i> Buat Pengaduan Baru
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
