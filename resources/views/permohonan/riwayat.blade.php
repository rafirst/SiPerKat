@php
use Illuminate\Support\Str;
@endphp

@extends('layouts.app')

@section('content')
<div class="container" style="margin-left: 15%">
    <div class="row justify-content-center">
        <div class="col-md-10" style="margin-left: 20%"></div>
            <div class="card shadow" style="width: 80%; margin-left: 10%">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Riwayat Permohonan</h5>
                </div>

                <div class="card-body p-4">
                    @if($permohonan->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Surat</th>
                                        <th>Tanggal</th>
                                        <th>Asal RT</th>
                                        <th>RT Tujuan</th>
                                        <th>Alasan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($permohonan as $index => $p)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            {{ $p->nomor_surat }}
                                            <button class="btn btn-sm btn-outline-secondary ms-2" 
                                                    onclick="copyToClipboard('{{ $p->nomor_surat }}')"
                                                    title="Salin nomor surat">
                                                <i class="bi bi-clipboard"></i>
                                            </button>
                                        </td>
                                        <td>{{ $p->created_at->format('d/m/Y') }}</td>
                                        <td>{{ $p->asal_rt }}</td>  
                                        
                                        <td>{{ $p->pindah_ke_rt }}</td>
                                        <td>{{ Str::limit($p->alasan_pindah, 50) }}</td>
                                        <td>
                                            @if($p->status == 'diterima')
                                                <span class="badge badge-success">Disetujui</span>
                                            @elseif($p->status == 'ditolak')
                                                <span class="badge badge-danger">Ditolak</span>
                                            @elseif($p->status == 'proses')
                                                <span class="badge badge-warning">Proses</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" 
                                                    class="btn btn-sm btn-info" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#detail-{{ $p->id }}">
                                                Detail
                                            </button>   
                                        </td>
                                    </tr>

                                    <!-- Modal Detail -->
                                    <div class="modal fade" id="detail-{{ $p->id }}" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Detail Permohonan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <dl class="row">
                                                        <dt class="col-sm-4">Nama</dt>
                                                        <dd class="col-sm-8">{{ $p->nama }}</dd>

                                                        <dt class="col-sm-4">Tanggal</dt>
                                                        <dd class="col-sm-8">{{ $p->created_at->format('d/m/Y H:i') }}</dd>

                                                        <dt class="col-sm-4">Asal RT</dt>
                                                        <dd class="col-sm-8">{{ $p->asal_rt }}</dd>

                                                        <dt class="col-sm-4">RT Tujuan</dt>
                                                        <dd class="col-sm-8">{{ $p->pindah_ke_rt }}</dd>

                                                        <dt class="col-sm-4">Alamat</dt>
                                                        <dd class="col-sm-8">{{ $p->alamat }}</dd>

                                                        <dt class="col-sm-4">Alasan</dt>
                                                        <dd class="col-sm-8">{{ $p->alasan_pindah }}</dd>

                                                        <dt class="col-sm-4">Status</dt>
                                                        <dd class="col-sm-8">
                                                            @if($p->status == 'diterima')
                                                                <span class="badge badge-success">Disetujui</span>
                                                            @elseif($p->status == 'ditolak')
                                                                <span class="badge badge-danger">Ditolak</span>
                                                            @elseif($p->status == 'proses')
                                                                <span class="badge badge-warning">Proses</span>
                                                            @endif
                                                        </dd>
                                                    </dl>
                                                </div>
                                                <div class="modal-footer">
                                                    @if($p->status == 'diterima')
                                                        <a href="{{ route('permohonan.cetak', $p->id) }}" class="btn btn-primary">
                                                            Cetak Surat
                                                        </a>
                                                    @elseif($p->status == 'ditolak')
                                                        <span class="badge badge-danger">Permohonan Ditolak</span>
                                                    @elseif($p->status == 'proses')
                                                        <span class="badge badge-warning">Sedang Diproses</span>
                                                    @endif
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <img src="{{ asset('images/empty.svg') }}" alt="Empty" class="mb-3" style="width: 200px">
                            <h6 class="text-muted">Belum ada riwayat permohonan</h6>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    border: none;
    border-radius: 10px;
}

.table th {
    font-weight: 600;
    background: #f8f9fa;
}

.badge {
    padding: 6px 12px;
    
}
</style>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        alert('Nomor surat berhasil disalin');
    }).catch(err => {
        console.error('Gagal menyalin teks: ', err);
    });
}
</script>
@endsection 