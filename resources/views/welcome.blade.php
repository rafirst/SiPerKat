<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Perpindahan Masyarakat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), 
                        url('https://images.unsplash.com/photo-1517732306149-e8f829eb588a'); /* Gambar orang menyeberang */
            background-size: cover;
            background-position: center;
            background-attachment: fixed; /* Membuat background tetap saat scroll */
            height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
        }
        
        /* Tambahkan overlay gradien */
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6));
            opacity: 0.85;
            z-index: 1;
        }
        
        /* Pastikan konten berada di atas overlay */
        .hero-section .container {
            position: relative;
            z-index: 2;
        }
        
        .feature-card {
            transition: transform 0.3s;
            border: none;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
        }
        
        .social-icons a {
            transition: transform 0.3s;
            display: inline-block;
        }
        
        .social-icons a:hover {
            transform: translateY(-5px);
        }
        
        .contact-info {
            color: #666;
        }
        
        .contact-info p {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">SiPerKat</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#layanan">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#alur">Alur Proses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#kontak">Kontak</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary ms-2" href="/login">Masuk</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section text-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h1 class="display-4 fw-bold">Layanan Perpindahan Penduduk Online</h1>
                    <p class="lead">Permudah proses administrasi perpindahan penduduk dengan sistem online yang efisien dan terintegrasi.</p>
                    <a href="/register" class="btn btn-primary btn-lg">Daftar Sekarang</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Layanan Section -->
    <section id="layanan" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Layanan Kami</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card feature-card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-home fa-3x mb-3 text-primary"></i>
                            <h5 class="card-title">Surat Pindah</h5>
                            <p class="card-text">Pengurusan surat pindah antar daerah dengan mudah dan cepat</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card feature-card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-file-alt fa-3x mb-3 text-primary"></i>
                            <h5 class="card-title">Tracking Status</h5>
                            <p class="card-text">Pantau status pengajuan perpindahan secara real-time</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card feature-card h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-database fa-3x mb-3 text-primary"></i>
                            <h5 class="card-title">Data Terintegrasi</h5>
                            <p class="card-text">Integrasi data kependudukan antar wilayah</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Alur Proses Section -->
    <section id="alur" class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Alur Proses Perpindahan</h2>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="timeline">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">1. Pendaftaran Online</h5>
                                <p class="card-text">Daftar dan lengkapi data diri pada sistem</p>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">2. Upload Dokumen</h5>
                                <p class="card-text">Unggah dokumen persyaratan yang dibutuhkan</p>
                            </div>
                        </div>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title">3. Verifikasi</h5>
                                <p class="card-text">Proses verifikasi oleh petugas</p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">4. Penerbitan Surat</h5>
                                <p class="card-text">Penerbitan surat keterangan pindah</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kontak Section -->
    <section id="kontak" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Hubungi Kami</h2>
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <!-- Social Media Icons -->
                    <div class="social-icons mb-4">
                        <a href="https://www.facebook.com/profile.php?id=61563907139370&mibextid=ZbWKwL" class="mx-3 text-decoration-none">
                            <i class="fab fa-facebook fa-3x text-primary"></i>
                        </a>
                        <a href="https://www.instagram.com/rafirst_/profilecard/?igsh=MWt2cTMzMTJzeGFnNw==" class="mx-3 text-decoration-none">
                            <i class="fab fa-instagram fa-3x" style="color: #E1306C;"></i>
                        </a>
                        <a href="https://www.linkedin.com/in/rafi-abdillah-570049317?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=android_app" class="mx-3 text-decoration-none">
                            <i class="fab fa-linkedin fa-3x" style="color: #0077B5;"></i>
                        </a>
                    </div>
                    
                    <!-- Contact Information -->
                    <div class="contact-info mt-4">
                        <p><i class="fas fa-envelope me-2"></i> email@siperkat.com</p>
                        <p><i class="fas fa-phone me-2"></i> (021) 1234-5678</p>
                        <p><i class="fas fa-map-marker-alt me-2"></i> Jl. No. 123, Jakarta</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p>&copy; 2024 SiPerKat - Sistem Informasi Perpindahan Masyarakat. Hak Cipta Dilindungi.</p>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js"></script>
</body>
</html>
