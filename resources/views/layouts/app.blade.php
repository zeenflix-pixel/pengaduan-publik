<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Pengaduan Publik')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .sidebar { min-height: 100vh; background: #1a3c5e; }
        .sidebar .nav-link { color: #adb5bd; padding: 10px 16px; border-radius: 6px; margin: 2px 8px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: rgba(255,255,255,0.1); color: #fff; }
        .sidebar .nav-link i { margin-right: 8px; }
        .sidebar-brand { color: #fff; font-size: 1.1rem; font-weight: 700; padding: 20px 16px; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .topbar { background: #fff; border-bottom: 1px solid #dee2e6; padding: 12px 24px; }
        .badge-menunggu { background-color: #ffc107; color: #000; }
        .badge-proses    { background-color: #0d6efd; }
        .badge-selesai   { background-color: #198754; }
        .card { border: none; box-shadow: 0 1px 6px rgba(0,0,0,0.08); }
    </style>
</head>
<body>
<div class="d-flex">
    {{-- SIDEBAR --}}
    <div class="sidebar" style="width:240px; flex-shrink:0;">
        <div class="sidebar-brand">
            <i class="bi bi-megaphone-fill me-2"></i>Pengaduan Publik
        </div>
        <nav class="nav flex-column pt-2">
            @if(auth()->user()->role === 'masyarakat')
                <a href="/masyarakat/dashboard" class="nav-link @if(request()->is('masyarakat/dashboard')) active @endif">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <a href="/masyarakat/pengaduan" class="nav-link @if(request()->is('masyarakat/pengaduan*')) active @endif">
                    <i class="bi bi-file-earmark-text"></i> Pengaduan Saya
                </a>
                <a href="/masyarakat/pengaduan/buat" class="nav-link @if(request()->is('masyarakat/pengaduan/buat')) active @endif">
                    <i class="bi bi-plus-circle"></i> Buat Pengaduan
                </a>
            @elseif(auth()->user()->role === 'petugas')
                <a href="/petugas/dashboard" class="nav-link @if(request()->is('petugas/dashboard')) active @endif">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <a href="/petugas/pengaduan" class="nav-link @if(request()->is('petugas/pengaduan*')) active @endif">
                    <i class="bi bi-inbox"></i> Daftar Pengaduan
                </a>
            @elseif(auth()->user()->role === 'admin')
                <a href="/admin/dashboard" class="nav-link @if(request()->is('admin/dashboard')) active @endif">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <a href="/admin/pengaduan" class="nav-link @if(request()->is('admin/pengaduan*')) active @endif">
                    <i class="bi bi-inbox-fill"></i> Semua Pengaduan
                </a>
                <a href="/admin/petugas" class="nav-link @if(request()->is('admin/petugas*')) active @endif">
                    <i class="bi bi-person-badge"></i> Data Petugas
                </a>
                <a href="/admin/kategori" class="nav-link @if(request()->is('admin/kategori*')) active @endif">
                    <i class="bi bi-tags"></i> Kategori
                </a>
                <a href="/admin/masyarakat" class="nav-link @if(request()->is('admin/masyarakat*')) active @endif">
                    <i class="bi bi-people"></i> Data Masyarakat
                </a>
            @endif
        </nav>
        <div class="mt-auto p-3" style="position:absolute; bottom:0; width:100%;">
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm w-100">
                    <i class="bi bi-box-arrow-left me-1"></i> Logout
                </button>
            </form>
        </div>
    </div>

    {{-- MAIN CONTENT --}}
    <div class="flex-grow-1">
        <div class="topbar d-flex justify-content-between align-items-center">
            <h6 class="mb-0 fw-semibold text-muted">@yield('page-title', 'Dashboard')</h6>
            <span class="badge bg-secondary">{{ ucfirst(auth()->user()->role) }}: {{ auth()->user()->name }}</span>
        </div>
        <div class="p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show">
                    <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @yield('content')
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
