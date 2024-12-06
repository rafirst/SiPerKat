@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" style="margin-left: 20%">
            <div class="card shadow">
                <div class="card-header bg-white py-3">
                    <h5 class="mb-0">Perpindahan Masyarakat</h5>
                </div>

                <div class="card-body p-4">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('permohonan.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Pindah ke RT</label>
                            <input type="text" 
                                   class="form-control" 
                                   name="pindah_ke_rt" 
                                   value="{{ old('pindah_ke_rt') }}" 
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alasan Pindah</label>
                            <textarea class="form-control" 
                                      name="alasan_pindah" 
                                      rows="3" 
                                      required>{{ old('alasan_pindah') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat</label>
                            <textarea class="form-control" 
                                      name="alamat" 
                                      rows="3" 
                                      required>{{ old('alamat') }}</textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('home') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
