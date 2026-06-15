@extends('layouts.app')
@section('title', 'Kategori Pengaduan')
@section('page-title', 'Manajemen Kategori')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr><th>ID</th><th>Nama Kategori</th><th>Deskripsi</th><th>Jumlah Pengaduan</th><th>Aksi</th></tr>
                    </thead>
                    <tbody>
                        @forelse($kategori as $k)
                        <tr>
                            <td class="fw-semibold">{{ $k->id_kategori }}</td>
                            <td>{{ $k->nama_kategori }}</td>
                            <td class="small text-muted">{{ $k->deskripsi ?? '-' }}</td>
                            <td class="text-center"><span class="badge bg-primary">{{ $k->pengaduan_count }}</span></td>
                            <td>
                                <form action="/admin/kategori/{{ $k->id_kategori }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">Belum ada kategori</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-semibold"><i class="bi bi-tags me-2 text-primary"></i>Tambah Kategori</h6>
            </div>
            <div class="card-body">
                <form action="/admin/kategori" method="POST">
                    @csrf
                    <div class="mb-2">
                        <label class="form-label small fw-semibold">ID Kategori <span class="text-danger">*</span> <span class="text-muted">(3 karakter)</span></label>
                        <input type="text" name="id_kategori" maxlength="3" class="form-control form-control-sm @error('id_kategori') is-invalid @enderror"
                               placeholder="contoh: INF" value="{{ old('id_kategori') }}" required>
                        @error('id_kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-semibold">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" name="nama_kategori" class="form-control form-control-sm @error('nama_kategori') is-invalid @enderror"
                               value="{{ old('nama_kategori') }}" required>
                        @error('nama_kategori')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control form-control-sm" rows="2">{{ old('deskripsi') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm w-100">
                        <i class="bi bi-plus-lg me-1"></i> Tambah Kategori
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
