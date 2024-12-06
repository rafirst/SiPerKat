@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Permohonan</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <!-- Detail Permohonan Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Permohonan</h6>
                    <div>
                        @if($permohonan->status == 'proses')
                        <button type="button" class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#approveModal">
                            <i class="fas fa-check"></i> Setujui
                        </button>
                        <button type="button" class="btn btn-danger me-2" data-bs-toggle="modal" data-bs-target="#rejectModal">
                            <i class="fas fa-times"></i> Tolak
                        </button>
                        @endif
                        @if($permohonan->status == 'diterima' || $permohonan->status == 'ditolak')
                        <a href="{{ route('surat.cetak', $permohonan->id) }}" 
                           class="btn btn-primary me-2" 
                           target="_blank">
                            <i class="fas fa-print"></i> Cetak Surat
                        </a>
                        @endif
                        <a href="{{ route('admin.response.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th class="bg-light" width="200">Nomor Surat</th>
                            <td>{{ $permohonan->nomor_surat }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Nama Pemohon</th>
                            <td>{{ $permohonan->user->name }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">NIK</th>
                            <td>{{ $permohonan->user->profile->nik ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">No. Telepon</th>
                            <td>{{ $permohonan->user->profile->no_telepon ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Tanggal Pengajuan</th>
                            <td>{{ $permohonan->created_at->format('d F Y') }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Alasan Pindah</th>
                            <td>{{ $permohonan->alasan_pindah }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Status</th>
                            <td>
                                @if($permohonan->status == 'proses')
                                    <span class="badge text-white" style="background-color: #e3f029;">
                                        {{ ucfirst($permohonan->status) }}
                                    </span>
                                @elseif($permohonan->status == 'diterima')
                                    <span class="badge text-white" style="background-color: #1cc88a;">
                                        {{ ucfirst($permohonan->status) }}
                                    </span>
                                @elseif($permohonan->status == 'ditolak')
                                    <span class="badge text-white" style="background-color: #e74a3b;">
                                        {{ ucfirst($permohonan->status) }}
                                    </span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Setujui -->
<div class="modal fade" id="approveModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.response.approve', $permohonan->id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Setujui Permohonan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Setujui</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Tolak -->
<div class="modal fade" id="rejectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.response.reject', $permohonan->id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tolak Permohonan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea name="keterangan" class="form-control" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Tolak</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.badge {
    padding: 8px 12px;
    font-size: 14px;
    border-radius: 4px;
}
.text-bg-warning {
    background-color: #ffc107;
    color: #000;
}
.text-bg-success {
    background-color: #198754;
    color: #fff;
}
.text-bg-danger {
    background-color: #dc3545;
    color: #fff;
}
.text-bg-secondary {
    background-color: #6c757d;
    color: #fff;
}
.btn i {
    margin-right: 5px;
}
</style>

@push('scripts')
<script>
$(document).ready(function() {
    // Tampilkan alert jika ada pesan sukses
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
        });
    @endif
});
</script>
@endpush
@endsection
