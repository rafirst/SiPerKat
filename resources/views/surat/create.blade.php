@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Form Pengajuan Surat Perpindahan RT</h5>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('permohonan.store') }}" method="POST">
                        @csrf
                        
                        {{-- Data Pemohon --}}
                        <div class="mb-4">
                            <h6 class="text-primary mb-3">Data Pemohon</h6>
                            <div class="mb-3">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" 
                                       class="form-control @error('nama') is-invalid @enderror" 
                                       name="nama" 
                                       value="{{ auth()->user()->name }}" 
                                       readonly>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat Asal</label>
                                <textarea class="form-control @error('alamat_asal') is-invalid @enderror" 
                                          name="alamat_asal" 
                                          rows="2" 
                                          readonly>{{ auth()->user()->alamat }}</textarea>
                                @error('alamat_asal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">RT Asal</label>
                                    <input type="text" 
                                           class="form-control" 
                                           value="{{ auth()->user()->rt }}" 
                                           readonly>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">RW Asal</label>
                                    <input type="text" 
                                           class="form-control" 
                                           value="{{ auth()->user()->rw }}" 
                                           readonly>
                                </div>
                            </div>
                        </div>

                        {{-- Data Perpindahan --}}
                        <div class="mb-4">
                            <h6 class="text-primary mb-3">Data Perpindahan</h6>
                            
                            <div class="mb-3">
                                <label class="form-label">RT Tujuan</label>
                                <select class="form-select @error('rt_tujuan') is-invalid @enderror" 
                                        name="rt_tujuan" 
                                        required>
                                    <option value="">Pilih RT Tujuan</option>
                                    @foreach($rts as $rt)
                                        <option value="{{ $rt->id }}">RT {{ $rt->nomor_rt }}</option>
                                    @endforeach
                                </select>
                                @error('rt_tujuan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alasan Perpindahan</label>
                                <textarea class="form-control @error('alasan_perpindahan') is-invalid @enderror" 
                                          name="alasan_perpindahan" 
                                          rows="3" 
                                          required>{{ old('alasan_perpindahan') }}</textarea>
                                @error('alasan_perpindahan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal Pengajuan</label>
                                <input type="date" 
                                       class="form-control @error('tanggal_pengajuan') is-invalid @enderror" 
                                       name="tanggal_pengajuan" 
                                       value="{{ date('Y-m-d') }}" 
                                       required>
                                @error('tanggal_pengajuan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Ajukan Permohonan</button>
                            <a href="{{ route('home') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
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

.form-control, .form-select {
    border-radius: 8px;
    padding: 10px 15px;
}

.btn {
    padding: 12px;
    border-radius: 8px;
}

.form-label {
    font-weight: 500;
    margin-bottom: 5px;
}
</style>
@endsection 