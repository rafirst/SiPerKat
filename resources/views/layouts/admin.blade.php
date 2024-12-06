@php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <!-- Custom styles -->
    <style>
        .sidebar {
            min-height: 100vh;
            background: #2c3e50;
            background: linear-gradient(180deg, #2c354f 10%, #2d3755 100%);
            transition: all 0.3s ease;
        }
        
        .sidebar-brand {
            padding: 1.5rem 1rem;
            color: white;
            text-decoration: none;
        }

        .nav-link {
            color: rgba(255,255,255,.8);
            padding: .75rem 1rem;
        }

        .nav-link:hover {
            color: white;
        }

        .nav-link.active {
            color: white;
            font-weight: bold;
        }

        .sidebar-divider {
            border-top: 1px solid rgba(255,255,255,.15);
            margin: 1rem 0;
        }

        .sidebar-heading {
            color: rgba(255,255,255,.4);
            font-size: .75rem;
            padding: 0 1rem;
            text-transform: uppercase;
        }

        #content-wrapper {
            background-color: #f8f9fc;
            width: 100%;
            overflow-x: hidden;
        }

        .topbar {
            height: 4.375rem;
            box-shadow: 0 .15rem 1.75rem 0 rgba(58,59,69,.15);
        }

        .img-profile {
            height: 2rem;
            width: 2rem;
            object-fit: cover;
        }

        .topbar .nav-item .nav-link .img-profile {
            height: 2rem;
            width: 2rem;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center" href="{{ route('admin.home') }}">
                <div class="sidebar-brand-icon">
                    <i class="fas fa-user-shield"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin Panel</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/home') ? 'active' : '' }}" href="{{ route('admin.home') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Permohonan
            </div>

            <!-- Nav Item - Tanggapi Permohonan -->
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin/response*') ? 'active' : '' }}" 
                   href="{{ route('admin.response.index') }}">
                    <i class="fas fa-fw fa-clipboard-list"></i>
                    <span>Response Permohonan</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                LAINNYA
            </div>

            <!-- Nav Item - Profile -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.profile') }}">
                    <i class="fas fa-user"></i>
                    <span>Profile</span>
                </a>
            </li>

            <!-- Nav Item - Logout -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        </ul>

        <!-- Content Wrapper -->
        <div id="content-wrapper">
            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4">
                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->nama_lengkap }}</span>
                            
                            <!-- Foto Profile -->
                            @php
                                $adminProfile = App\Models\AdminProfile::where('user_id', Auth::id())->first();
                                $fotoUrl = $adminProfile && $adminProfile->foto ? 
                                           asset('storage/profile-photos/' . $adminProfile->foto) : 
                                           asset('images/default-profile.png');
                            @endphp
                            
                            <img class="img-profile rounded-circle"
                                 src="{{ $fotoUrl }}"
                                 alt="Profile"
                                 style="width: 32px; height: 32px; object-fit: cover;"
                                 onerror="this.src='{{ asset('images/default-profile.png') }}'">
                        </a>
                        
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('admin.profile') }}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>

            <!-- Main Content -->
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
</body>
</html>
