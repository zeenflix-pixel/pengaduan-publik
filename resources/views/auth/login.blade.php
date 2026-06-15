<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Pengaduan Publik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #1a3c5e 0%, #2d6a9f 100%); min-height: 100vh; display: flex; align-items: center; }
        .card { border: none; border-radius: 16px; box-shadow: 0 8px 32px rgba(0,0,0,0.2); }
        .brand-icon { font-size: 3rem; color: #1a3c5e; }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 col-sm-10">
            <div class="card p-4">
                <div class="text-center mb-4">
                    <i class="bi bi-megaphone-fill brand-icon"></i>
                    <h4 class="fw-bold mt-2">Sistem Pengaduan Publik</h4>
                    <p class="text-muted small">Masuk ke akun Anda</p>
                </div>
                <form action="/login" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">NIK / ID Petugas / admin</label>
                        <input type="text" name="identifier" class="form-control @error('identifier') is-invalid @enderror"
                               placeholder="Masukkan NIK atau ID" value="{{ old('identifier') }}" required>
                        @error('identifier')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" name="remember" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember">Ingat saya</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
                    </button>
                </form>
                <hr>
                <div class="text-center">
                    <span class="text-muted small">Belum punya akun?</span>
                    <a href="/register" class="small fw-semibold ms-1">Daftar sebagai Masyarakat</a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
