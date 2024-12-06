@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Row untuk Cards -->
    <div class="row mb-4" style="margin-left: 11% ">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                TOTAL PERMOHONAN</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPermohonan }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                DIPROSES</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $diprosesCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                DISETUJUI</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $disetujuiCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                DITOLAK</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $ditolakCount }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-times fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Row untuk Chart dan Tabel -->
    <div class="row" style="margin-left: 13% ">
        <!-- Donut Chart -->
        <div class="col-xl-4">
            <div class="card full-width-card">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Status Permohonan</h6>
                </div>
                
                <div class="card-body1">
                    <!-- Tambahkan diagram di sini -->
                    <div class="row justify-content-center mb-4">
                        <div class="col-md-6">
                            <div class="chart-container">
                                <canvas id="userStatusChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <!-- Tambahkan diagram donut -->
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="chart-container">
                                <canvas id="statusChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                    <!-- Konten tabel tetap sama -->
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('userStatusChart');
    
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Total Permohonan', 'Diproses', 'Diterima', 'Ditolak'],
            datasets: [{
                data: [
                    {{ $totalPermohonan }}, 
                    {{ $diprosesCount }}, 
                    {{ $disetujuiCount }}, 
                    {{ $ditolakCount }}
                ],
                backgroundColor: [
                    '#4e73df',  // biru
                    '#f6c23e',  // kuning
                    '#1cc88a',  // hijau
                    '#e74a3b'   // merah
                ],
                hoverBackgroundColor: [
                    '#2e59d9',
                    '#daa520',
                    '#169b6b',
                    '#c23321'
                ],
                borderWidth: 1
            }]
        },
        options: {
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                },
                title: {
                    display: true,
                    text: 'Statistik Status Permohonan',
                    padding: {
                        top: 10,
                        bottom: 20
                    },
                    font: {
                        size: 16,
                        weight: 'bold'
                    }
                }
            },
            cutout: '70%'
        }
    });

});
</script>
@endpush

<style>
.chart-container {
    position: relative;
    height: 400px;
    margin: auto;
}

.card {
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
    border: none;
    border-radius: 0.35rem;
}

.card-header {
    background-color: #f8f9fc;
    border-bottom: 1px solid #e3e6f0;
}

.card-body1{
    height: 550px;
}


/* Style untuk melebarkan card sampai ke kanan */
.full-width-card {
     
    width: 313%;
    border-radius: 0;
}

.full-width-card .card-header {
    border-radius: 0;
}

/* Responsif untuk layar kecil */
@media (max-width: 768px) {
    .full-width-card {
        margin-left: -10px;
        margin-right: -10px;
        width: calc(100% + 20px);
    }
}

/* Style untuk melebarkan card sampai pojok kanan */
.status-card {
    margin-left: -30px;  /* Sesuaikan nilai ini jika perlu */
    margin-right: -30px;
    width: calc(100% + 60px);  /* Sesuaikan dengan total margin left dan right */
    border-radius: 0;
    box-shadow: none;
}

.status-card .card-header {
    border-radius: 0;
    background-color: #f8f9fc;
    border-bottom: 1px solid #e3e6f0;
}

.container-fluid.px-0 {
    padding-left: 0 !important;
    padding-right: 0 !important;
    overflow-x: hidden;  /* Mencegah horizontal scroll */
}

.Status.Permohonan {
    margin-right: -24rem;
    width: calc(100% + 24rem);
    background: white;
    padding: 1rem;
    border-radius: 0.5rem;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

/* Responsif untuk layar kecil */
@media (max-width: 768px) {
    .status-card {
        margin-left: -15px;
        margin-right: -15px;
        width: calc(100% + 30px);
    }
}

.status-permohonan-wrapper {
    margin-right: calc(-200vw + 100% + 350px); /* 250px adalah lebar sidebar */
    margin-left: -20px;
}

.status-permohonan-wrapper .card {
    border-radius: 0;
    border: none;
    box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
}

.status-permohonan-wrapper .card-header {
    background: #f8f9fc;
    border-bottom: 1px solid #e3e6f0;
}

/* Responsif untuk layar kecil */
@media (max-width: 768px) {
    .status-permohonan-wrapper {
        margin-right: -15px;
        margin-left: -15px;
    }
}

.chart-container {
    position: relative;
    height: 300px;
    width: 100%;
    margin: 20px auto;
}



</style>
@endsection
