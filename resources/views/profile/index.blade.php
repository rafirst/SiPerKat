@extends('layouts.app')

@section('content')
<div class="container py-5" >
    <div class="row">
        <div class="col-lg-4">
            <div class="card mb-4" style="margin-left: 45%">
                <div class="card-body text-center" >
                    <div class="profile-image mb-3">
                        @if($user->profile && $user->profile->foto)
                            <img src="{{ asset('storage/profile_photos/'.$user->profile->foto) }}" 
                                 alt="Profile" 
                                 id="profileImageDisplay"
                                 class="rounded-circle"
                                 style="width: 150px; height: 150px; object-fit: cover; cursor: pointer;"
                                 onclick="document.getElementById('profileImageInput').click()">
                        @else
                            <img src="{{ asset('img/Profile.png') }}" 
                                 alt="Default Profile"
                                 id="profileImageDisplay"
                                 class="rounded-circle"
                                 style="width: 150px; height: 150px; object-fit: cover; cursor: pointer;"
                                 onclick="document.getElementById('profileImageInput').click()">
                        @endif
                        
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" id="profileForm">
                            @csrf
                            <input type="file" 
                                   id="profileImageInput" 
                                   name="foto" 
                                   style="display: none;" 
                                   accept="image/jpeg,image/png,image/jpg"
                                   onchange="uploadFoto(this)">
                        </form>
                    </div>
                    
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    <h5 class="my-3">{{ $user->name }}</h5>
                    <p class="text-muted mb-4">{{ $user->email }}</p>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                </div>  
            </div>
        </div>
        
        <div class="col-lg-8">
            <form action="{{ route('profile.store') }}" method="POST">
                @csrf
                <div class="card mb-4" >
                    <div class="card-body">
                        <h5 class="card-title mb-4">Informasi Profile</h5>
                        
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <label class="fw-bold">Nama Lengkap</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" value="{{ $user->name }}" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <label class="fw-bold">Email</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}" readonly>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <label class="fw-bold">Asal RT</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" 
                                       class="form-control @error('rt') is-invalid @enderror" 
                                       name="rt" 
                                       value="{{ old('rt', $user->profile->rt ?? '') }}">
                                @error('rt')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <label class="fw-bold">Alamat</label>
                            </div>
                            <div class="col-sm-9">
                                <textarea class="form-control @error('alamat') is-invalid @enderror" 
                                          name="alamat" 
                                          rows="3">{{ old('alamat', $user->profile->alamat ?? '') }}</textarea>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <label class="fw-bold">No. Telepon</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" 
                                       class="form-control @error('no_telepon') is-invalid @enderror" 
                                       name="no_telepon" 
                                       value="{{ old('no_telepon', $user->profile->no_telepon ?? '') }}">
                                @error('no_telepon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <label class="fw-bold">NIK</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" 
                                       class="form-control @error('nik') is-invalid @enderror" 
                                       name="nik" 
                                       value="{{ old('nik', $user->profile->nik ?? '') }}">
                                @error('nik')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.card {
    border-radius: 15px;
}
.form-control {
    background-color: #f8f9fa;
}
.btn-danger {
    padding: 10px 30px;
}
.profile-photo-container:hover .photo-overlay {
    cursor: pointer;
    opacity: 1;
}

.photo-overlay {
    opacity: 0;
    transition: opacity 0.3s ease;
}
</style>

<script>
function uploadFoto(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        
        reader.onload = function(e) {
            document.getElementById('profileImageDisplay').src = e.target.result;
        }
        
        reader.readAsDataURL(input.files[0]);
        
        var formData = new FormData(document.getElementById('profileForm'));
        
        formData.append('_method', 'PUT');
        
        fetch('{{ route('profile.update') }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            credentials: 'same-origin'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: data.message || 'Gagal mengupload foto'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Terjadi kesalahan saat mengupload foto'
            });
        });
    }
}
</script>

@if(session('error'))
    <script>
        alert('{{ session('error') }}');
    </script>
@endif

@if(session('success'))
    <script>
        alert('{{ session('success') }}');
    </script>
@endif

<script>
document.querySelector('form[action="{{ route('profile.store') }}"]').addEventListener('submit', function(e) {
    // e.preventDefault(); // Uncomment untuk debugging
    const formData = new FormData(this);
    console.log('Form data:');
    for (let [key, value] of formData.entries()) {
        console.log(key + ': ' + value);
    }
});
</script>
@endsection 