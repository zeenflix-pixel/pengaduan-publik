@extends('layouts.app')
@section('title', 'Data Petugas')
@section('page-title', 'Manajemen Petugas')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-semibold">Daftar Petugas</h6>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr><th>ID</th><th>Nama</th><th>Jabatan</th><th>Telepon</th><th>Aksi</th></tr>
                    </thead>
                    <tbody>
                        @forelse($petugas as $p)
                        <tr>
                            <td class="fw-semibold">{{ $p->id_petugas }}</td>
                            <td>{{ $p->nama_petugas }}</td>
                            <td>{{ $p->jabatan ?? '-' }}</td>
                            <td>{{ $p->telepon ?? '-' }}</td>
                            <td>
                                <form action="/admin/petugas/{{ $p->id_petugas }}" method="POST" onsubmit="return confirm('Hapus petugas ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">Belum ada petugas</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-semibold"><i class="bi bi-person-plus me-2 text-primary"></i>Tambah Petugas</h6>
            </div>
            <div class="card-body">
                <form action="/admin/petugas" method="POST">
                    @csrf
                    <div class="mb-2">
                        <label class="form-label small fw-semibold">ID Petugas <span class="text-danger">*</span></label>
                        <input type="text" name="id_petugas" maxlength="5" class="form-control form-control-sm @error('id_petugas') is-invalid @enderror"
                               placeholder="contoh: P001" value="{{ old('id_petugas') }}" required>
                        @error('id_petugas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-semibold">Nama Petugas <span class="text-danger">*</span></label>
                        <input type="text" name="nama_petugas" class="form-control form-control-sm @error('nama_petugas') is-invalid @enderror"
                               value="{{ old('nama_petugas') }}" required>
                        @error('nama_petugas')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-semibold">Jabatan</label>
                        <input type="text" name="jabatan" class="form-control form-control-sm" value="{{ old('jabatan') }}">
                    </div>
                    <div class="mb-2">
                        <label class="form-label small fw-semibold">Telepon</label>
                        <input type="text" name="telepon" class="form-control form-control-sm" value="{{ old('telepon') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control form-control-sm" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm w-100">
                        <i class="bi bi-plus-lg me-1"></i> Tambah Petugas
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
