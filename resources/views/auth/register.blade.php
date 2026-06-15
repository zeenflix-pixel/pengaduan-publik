<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Sistem Pengaduan Publik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #1a3c5e 0%, #2d6a9f 100%); min-height: 100vh; display: flex; align-items: center; padding: 30px 0; }
        .card { border: none; border-radius: 16px; box-shadow: 0 8px 32px rgba(0,0,0,0.2); }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 col-sm-10">
            <div class="card p-4">
                <div class="text-center mb-4">
                    <i class="bi bi-person-plus-fill fs-1 text-primary"></i>
                    <h4 class="fw-bold mt-2">Daftar Akun</h4>
                    <p class="text-muted small">Buat akun untuk menyampaikan pengaduan</p>
                </div>
                <form action="/register" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">NIK <span class="text-danger">*</span></label>
                        <input type="text" name="nik" class="form-control @error('nik') is-invalid @enderror"
                               placeholder="16 digit NIK" maxlength="16" value="{{ old('nik') }}" required>
                        @error('nik')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                               placeholder="Nama sesuai KTP" value="{{ old('nama') }}" required>
                        @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nomor Telepon</label>
                        <input type="text" name="telepon" class="form-control"
                               placeholder="08xxxxxxxxxx" value="{{ old('telepon') }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Alamat</label>
                        <textarea name="alamat" class="form-control" rows="2" placeholder="Alamat lengkap">{{ old('alamat') }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                               placeholder="Minimal 6 karakter" required>
                        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Konfirmasi Password <span class="text-danger">*</span></label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                        <i class="bi bi-person-check me-1"></i> Daftar Sekarang
                    </button>
                </form>
                <hr>
                <div class="text-center">
                    <span class="text-muted small">Sudah punya akun?</span>
                    <a href="/login" class="small fw-semibold ms-1">Masuk di sini</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
