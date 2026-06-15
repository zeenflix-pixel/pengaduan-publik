@extends('layouts.app')
@section('title', 'Buat Pengaduan')
@section('page-title', 'Buat Pengaduan Baru')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-semibold"><i class="bi bi-pencil-square me-2 text-primary"></i>Form Pengaduan</h6>
            </div>
            <div class="card-body">
                <form action="/masyarakat/pengaduan" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kategori Pengaduan <span class="text-danger">*</span></label>
                        <select name="id_kategori" class="form-select @error('id_kategori') is-invalid @enderror" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategori as $k)
                                <option value="{{ $k->id_kategori }}" {{ old('id_kategori') == $k->id_kategori ? 'selected' : '' }}>
                                    {{ $k->nama_kategori }}
                                    @if($k->deskripsi) ({{ $k->deskripsi }}) @endif
                                </option>
                            @endforeach
                        </select>
                        @error('id_kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Isi Laporan <span class="text-danger">*</span></label>
                        <textarea name="isi_laporan" rows="6"
                            class="form-control @error('isi_laporan') is-invalid @enderror"
                            placeholder="Jelaskan pengaduan Anda secara lengkap dan jelas (minimal 20 karakter)..."
                            required>{{ old('isi_laporan') }}</textarea>
                        @error('isi_laporan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        <div class="form-text">Sertakan lokasi, waktu kejadian, dan detail permasalahan.</div>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-send me-1"></i> Kirim Pengaduan
                        </button>
                        <a href="/masyarakat/pengaduan" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
