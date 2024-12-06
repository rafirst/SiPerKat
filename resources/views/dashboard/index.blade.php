@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header">
            <h5 class="m-0 font-weight-bold">Daftar Permohonan Masuk</h5>
        </div>
        <div class="card-body">
            <!-- Search dan Filter -->
            <div class="row mb-4">
                <div class="col-md-8">
                    <form action="{{ route('admin.permohonan.index') }}" method="GET" class="form-inline">
                        <input type="text" name="search" class="form-control mr-2" placeholder="Cari nomor surat/nama" value="{{ request('search') }}">
                        <select name="status" class="form-control mr-2">
                            <option value="">Semua Status</option>
                            <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Proses</option>
                            <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </form>
                </div>
            </div>

            <!-- Tabel Permohonan -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No. Surat</th>
                            <th>Nama Pemohon</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($permohonan as $p)
                        <tr>
                            <td>{{ $p->nomor_surat }}</td>
                            <td>{{ $p->nama }}</td>
                            <td>{{ $p->created_at->format('d/m/Y') }}</td>
                            <td>
                                <span class="badge badge-{{ $p->status == 'proses' ? 'warning' : ($p->status == 'disetujui' ? 'success' : 'danger') }}">
                                    {{ ucfirst($p->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.permohonan.show', $p) }}" class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada permohonan</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            {{ $permohonan->links() }}
        </div>
    </div>
</div>
@endsection 