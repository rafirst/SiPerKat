@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Profile Admin</h1>
    </div>

    <div class="row">
        <!-- Profile Card -->
        <div class="col-xl-4 col-lg-5">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <form action="{{ route('admin.profile.updateFoto') }}" method="POST" enctype="multipart/form-data" id="foto-form">
                        @csrf
                        <div class="position-relative d-inline-block mb-3">
                            @php
                                $fotoPath = $user->foto ? public_path('storage/profile-photos/' . $user->foto) : null;
                                $fotoUrl = $user->foto ? asset('storage/profile-photos/' . $user->foto) : asset('images/default-profile.png');
                            @endphp
                            
                            <!-- Debug info -->
                            @if(config('app.debug'))
                                <div style="display:none">
                                    <p>Foto DB: {{ $user->foto }}</p>
                                    <p>Foto Path: {{ $fotoPath }}</p>
                                    <p>Foto URL: {{ $fotoUrl }}</p>
                                    <p>File Exists: {{ $fotoPath && file_exists($fotoPath) ? 'Yes' : 'No' }}</p>
                                </div>
                            @endif

                            <img src="{{ $fotoUrl }}" 
                                 alt="Profile Picture" 
                                 class="rounded-circle img-thumbnail" 
                                 style="width: 150px; height: 150px; object-fit: cover;"
                                 id="preview-foto"
                                 onerror="this.onerror=null; this.src='{{ asset('images/default-profile.png') }}';">

                            <label for="foto_profile" class="position-absolute bottom-0 end-0 bg-white rounded-circle p-2 shadow-sm" style="cursor: pointer;">
                                <i class="fas fa-camera text-primary"></i>
                            </label>
                            <input type="file" 
                                   id="foto_profile"
                                   name="foto_profile" 
                                   class="d-none"
                                   accept="image/jpeg,image/png">
                        </div>
                    </form>
                    <h5 class="mb-1">{{ $user->nama_lengkap }}</h5>
                    <p class="text-muted mb-3">{{ $user->email }}</p>
                    <button class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </button>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>

        <!-- Detail Akun -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Detail Akun</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.profile.update') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" 
                                   class="form-control @error('nama_lengkap') is-invalid @enderror" 
                                   name="nama_lengkap" 
                                   value="{{ old('nama_lengkap', $user->nama_lengkap) }}" 
                                   required>
                            @error('nama_lengkap')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   name="email" 
                                   value="{{ old('email', $user->email) }}" 
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Nomor Telepon</label>
                            <input type="text" 
                                   class="form-control @error('no_telepon') is-invalid @enderror" 
                                   name="no_telepon" 
                                   value="{{ old('no_telepon', $user->no_telepon) }}">
                            @error('no_telepon')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password Baru</label>
                            <input type="password" 
                                   class="form-control @error('password') is-invalid @enderror" 
                                   name="password">
                            <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password</label>
                            <input type="password" 
                                   class="form-control" 
                                   name="password_confirmation">
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.img-account-profile {
    border: 2px solid #e3e6f0;
}
.card {
    border: none;
    border-radius: .35rem;
}
.card-header {
    background-color: #f8f9fc;
    border-bottom: 1px solid #e3e6f0;
    padding: 1rem 1.35rem;
    font-weight: 500;
    color: #4e73df;
}
.form-control {
    padding: .375rem .75rem;
    font-size: .875rem;
    line-height: 1.5;
    color: #6e707e;
    background-color: #fff;
    border: 1px solid #d1d3e2;
    border-radius: .35rem;
}
.form-control:focus {
    border-color: #bac8f3;
    box-shadow: 0 0 0 0.2rem rgba(78,115,223,.25);
}
.btn-primary {
    background-color: #4e73df;
    border-color: #4e73df;
}
.btn-primary:hover {
    background-color: #2e59d9;
    border-color: #2653d4;
}
.position-relative {
    position: relative;
}
.position-absolute {
    position: absolute;
}
.bottom-0 {
    bottom: 0;
}
.end-0 {
    right: 0;
}
</style>

<script>
document.getElementById('foto_profile').onchange = function(evt) {
    const [file] = this.files;
    if (file) {
        // Validasi ukuran file (max 5MB)
        if (file.size > 5 * 1024 * 1024) {
            alert('Ukuran file terlalu besar. Maksimal 5MB');
            this.value = '';
            return;
        }
        
        // Validasi tipe file
        if (!['image/jpeg', 'image/png'].includes(file.type)) {
            alert('Tipe file tidak didukung. Gunakan JPG atau PNG');
            this.value = '';
            return;
        }

        // Preview foto
        const img = document.getElementById('preview-foto');
        img.src = URL.createObjectURL(file);
        
        // Submit form
        document.getElementById('foto-form').submit();
    }
}
</script>

@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
        });
    </script>
@endif
@endsection
