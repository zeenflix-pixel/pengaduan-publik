@extends('layouts.app')
@section('title', 'Detail Pengaduan')
@section('page-title', 'Detail & Tanggapan Pengaduan')

@section('content')
<div class="row">
    <div class="col-md-8">
        {{-- Detail pengaduan --}}
        <div class="card mb-3">
            <div class="card-header bg-white py-3 d-flex justify-content-between">
                <h6 class="mb-0 fw-semibold">{{ $pengaduan->id_pengaduan }}</h6>
                <form action="/petugas/pengaduan/{{ $pengaduan->id_pengaduan }}/status" method="POST" class="d-flex gap-2">
                    @csrf @method('PATCH')
                    <select name="status" class="form-select form-select-sm" style="width:140px;">
                        <option value="menunggu" {{ $pengaduan->status=='menunggu'?'selected':'' }}>Menunggu</option>
                        <option value="proses"   {{ $pengaduan->status=='proses'?'selected':'' }}>Proses</option>
                        <option value="selesai"  {{ $pengaduan->status=='selesai'?'selected':'' }}>Selesai</option>
                    </select>
                    <button type="submit" class="btn btn-sm btn-outline-primary">Update</button>
                </form>
            </div>
            <div class="card-body">
                <table class="table table-borderless small mb-3">
                    <tr><th width="140">Pelapor</th><td>{{ $pengaduan->masyarakat->nama ?? '-' }}</td></tr>
                    <tr><th>NIK</th><td>{{ $pengaduan->nik }}</td></tr>
                    <tr><th>Kategori</th><td>{{ $pengaduan->kategori->nama_kategori }}</td></tr>
                    <tr><th>Tanggal</th><td>{{ \Carbon\Carbon::parse($pengaduan->tanggal_lapor)->format('d F Y, H:i') }}</td></tr>
                </table>
                <div class="bg-light rounded p-3">
                    <p class="fw-semibold small text-muted mb-1">ISI LAPORAN</p>
                    <p class="mb-0">{{ $pengaduan->isi_laporan }}</p>
                </div>
            </div>
        </div>

        {{-- Riwayat tanggapan --}}
        <div class="card mb-3">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-semibold">Riwayat Tanggapan ({{ $pengaduan->tanggapan->count() }})</h6>
            </div>
            <div class="card-body">
                @forelse($pengaduan->tanggapan as $t)
                <div class="d-flex mb-3">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3 flex-shrink-0"
                         style="width:38px;height:38px;">
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
                <p class="text-muted text-center">Belum ada tanggapan</p>
                @endforelse
            </div>
        </div>

        {{-- Form tanggapan baru --}}
        <div class="card">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-semibold"><i class="bi bi-reply me-2 text-primary"></i>Beri Tanggapan</h6>
            </div>
            <div class="card-body">
                <form action="/petugas/pengaduan/{{ $pengaduan->id_pengaduan }}/tanggapi" method="POST">
                    @csrf
                    <div class="mb-3">
                        <textarea name="isi_tanggapan" rows="4" class="form-control @error('isi_tanggapan') is-invalid @enderror"
                            placeholder="Tulis tanggapan Anda..." required></textarea>
                        @error('isi_tanggapan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-send me-1"></i> Kirim Tanggapan
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <a href="/petugas/pengaduan" class="btn btn-outline-secondary w-100">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
