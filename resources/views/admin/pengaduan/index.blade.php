@extends('layouts.app')
@section('title', 'Semua Pengaduan')
@section('page-title', 'Manajemen Pengaduan')

@section('content')
{{-- Filter --}}
<div class="card mb-3">
    <div class="card-body py-2">
        <form method="GET" action="/admin/pengaduan" class="row g-2 align-items-center">
            <div class="col-auto">
                <select name="status" class="form-select form-select-sm">
                    <option value="">Semua Status</option>
                    <option value="menunggu" {{ request('status')=='menunggu'?'selected':'' }}>Menunggu</option>
                    <option value="proses"   {{ request('status')=='proses'?'selected':'' }}>Proses</option>
                    <option value="selesai"  {{ request('status')=='selesai'?'selected':'' }}>Selesai</option>
                </select>
            </div>
            <div class="col-auto">
                <select name="kategori" class="form-select form-select-sm">
                    <option value="">Semua Kategori</option>
                    @foreach($kategori as $k)
                        <option value="{{ $k->id_kategori }}" {{ request('kategori')==$k->id_kategori?'selected':'' }}>
                            {{ $k->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                <a href="/admin/pengaduan" class="btn btn-outline-secondary btn-sm ms-1">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr><th>ID</th><th>Pelapor</th><th>Kategori</th><th>Tanggal</th><th>Status</th><th>Tanggapan</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @forelse($pengaduan as $p)
                    <tr>
                        <td class="small fw-semibold">{{ $p->id_pengaduan }}</td>
                        <td class="small">{{ $p->masyarakat->nama ?? '-' }}<br><span class="text-muted">{{ $p->nik }}</span></td>
                        <td><span class="badge bg-secondary">{{ $p->kategori->nama_kategori }}</span></td>
                        <td class="small">{{ \Carbon\Carbon::parse($p->tanggal_lapor)->format('d/m/Y H:i') }}</td>
                        <td><span class="badge badge-{{ $p->status }}">{{ ucfirst($p->status) }}</span></td>
                        <td class="text-center">{{ $p->tanggapan->count() }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="/admin/pengaduan/{{ $p->id_pengaduan }}" class="btn btn-outline-primary btn-sm"><i class="bi bi-eye"></i></a>
                                <form action="/admin/pengaduan/{{ $p->id_pengaduan }}" method="POST" onsubmit="return confirm('Hapus pengaduan ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="text-center text-muted py-4">Tidak ada data</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $pengaduan->links() }}</div>
    </div>
</div>
@endsection
