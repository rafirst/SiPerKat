@extends('layouts.app')

@section('content')
<div class="container-fluid login-container">
    <div class="card shadow-lg" style="min-width: 350px; max-width: 400px;">
        <div class="card-body p-5">
            <h2 class="text-center mb-4">Selamat Datang</h2>
            <p class="text-center text-muted mb-4">Sistem Informasi Perpindahan Penduduk Antar RT</p>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Ingat Saya</label>
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-3">Login</button>

                <div class="text-center">
                    <p class="mb-0">Belum punya akun? <a href="{{ route('register') }}" class="text-decoration-none">Register</a></p>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Background Styles */
.login-container {
    min-height: 100vh;
    width: 100%;
    margin: 0;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.6)),
    url('https://images.unsplash.com/photo-1517732306149-e8f829eb588a');
    background-size: 100% 100%;
    background-position: center;
    background-repeat: no-repeat;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
}

/* Card Styles */
.card {
    border-radius: 15px;
    border: none;
    backdrop-filter: blur(5px);
    background: rgba(255, 255, 255, 0.95);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    z-index: 1000;
}

/* Form Styles */
.form-control {
    border-radius: 8px;
    padding: 12px;
    border: 1px solid #e2e8f0;
    background: rgba(255, 255, 255, 0.9);
}

.form-control:focus {
    border-color: #4a90e2;
    box-shadow: 0 0 0 0.2rem rgba(74, 144, 226, 0.25);
}

.btn-primary {
    background-color: #4a90e2;
    border: none;
    padding: 12px;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    background-color: #357abd;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(74, 144, 226, 0.4);
}

/* Text Styles */
h2 {
    color: #2d3748;
    font-weight: 600;
}

.text-muted {
    color: #718096 !important;
}

/* Link Styles */
a {
    color: #4a90e2;
    transition: all 0.3s ease;
}

a:hover {
    color: #357abd;
    text-decoration: none;
}

/* Checkbox Style */
.form-check-input:checked {
    background-color: #4a90e2;
    border-color: #4a90e2;
}

/* Responsive adjustments */
@media (max-width: 576px) {
    .card {
        margin: 15px;
        min-width: auto;
    }
}
</style>
@endsection 