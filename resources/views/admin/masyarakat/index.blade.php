@extends('layouts.app')
@section('title', 'Data Masyarakat')
@section('page-title', 'Data Masyarakat')

@section('content')
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr><th>NIK</th><th>Nama</th><th>Telepon</th><th>Alamat</th><th>Jumlah Pengaduan</th></tr>
                </thead>
                <tbody>
                    @forelse($masyarakat as $m)
                    <tr>
                        <td class="fw-semibold small">{{ $m->nik }}</td>
                        <td>{{ $m->nama }}</td>
                        <td class="small">{{ $m->telepon ?? '-' }}</td>
                        <td class="small text-truncate" style="max-width:200px;">{{ $m->alamat ?? '-' }}</td>
                        <td class="text-center"><span class="badge bg-primary">{{ $m->pengaduan_count }}</span></td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center text-muted py-4">Belum ada data masyarakat</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-3">{{ $masyarakat->links() }}</div>
    </div>
</div>
@endsection
