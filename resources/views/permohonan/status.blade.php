@extends('layouts.app')

@section('content')
<div class="container py-4" style="width: 80%; margin-left: 15%">
    <div class="row justify-content-center">
        <div class="col-md-8" style="margin-left: 20%"></div>
            <div class="card shadow" style="width: 80%">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Status Permohonan</h5>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <form id="cekStatusForm">
                                <div class="input-group">
                                    <input type="text" 
                                        class="form-control" 
                                        placeholder="Masukkan Nomor Surat" 
                                        name="nomor_surat"
                                        value="{{ request('nomor_surat') }}"
                                        required>
                                    <button class="btn btn-primary" type="submit">
                                        Cek Status
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="text-center text-muted">
                        <p>Masukkan nomor surat untuk melihat status permohonan Anda</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="hasilPencarian" style="display: none;" class="mt-4">
    <div class="card" style="width: 70%; margin-left: 21%">
        <div class="card-header">
            <h5>Detail Permohonan</h5>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>No Surat</th>
                        <th>Nama Pemohon</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody id="hasilData">
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.querySelector('button[type="submit"]').addEventListener('click', function(e) {
    e.preventDefault();
    const noSurat = document.querySelector('input[name="nomor_surat"]').value;
    
    if (!noSurat) {
        alert('Silakan masukkan nomor surat terlebih dahulu');
        return;
    }

    fetch('/api/permohonan/cek-status/' + noSurat)
        .then(response => {
            if (!response.ok) {
                throw new Error('Nomor surat tidak ditemukan');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                const hasil = document.getElementById('hasilData');
                let statusBadge;
                
                // Sesuaikan warna badge dengan status
                switch(data.permohonan.status) {
                    case 'proses':
                        statusBadge = '<span class="badge bg-warning">Proses</span>';
                        break;
                    case 'disetujui':
                        statusBadge = '<span class="badge bg-success">Disetujui</span>';
                        break;
                    case 'ditolak':
                        statusBadge = '<span class="badge bg-danger">Ditolak</span>';
                        break;
                }

                hasil.innerHTML = `
                    <tr>
                        <td>${data.permohonan.nomor_surat}</td>
                        <td>${data.permohonan.nama_pemohon}</td>
                        <td>${data.permohonan.tanggal_pengajuan}</td>
                        <td>${statusBadge}</td>
                    </tr>
                `;
                document.getElementById('hasilPencarian').style.display = 'block';
            } else {
                alert('Nomor surat tidak ditemukan');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert(error.message);
        });
});
</script>
@endsection 