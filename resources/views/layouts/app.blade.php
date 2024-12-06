@php
use Illuminate\Support\Facades\Request;
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpindahan Masyarakat</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* Sidebar Style */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background: #2c3e50;
            padding-top: 20px;
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .sidebar-brand {
            padding: 15px 25px;
            color: white;
            font-size: 20px;
            font-weight: 600;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 20px;
        }

        .sidebar-menu {
            padding: 0;
            list-style: none;
        }

        .sidebar-menu li {
            margin-bottom: 5px;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 12px 25px;
            color: #ecf0f1;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .sidebar-menu a:hover {
            background: #34495e;
            color: #3498db;
        }

        .sidebar-menu a.active {
            background: #34495e;
            color: #3498db;
            border-left: 4px solid #3498db;
        }

        .sidebar-menu i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            margin-left: 250px;
            padding: 20px;
            min-height: 100vh;
            background: #f8f9fa;
            transition: all 0.3s ease;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                margin-left: -250px;
            }
            .sidebar.active {
                margin-left: 0;
            }
            .main-content {
                margin-left: 0;
            }
            .main-content.active {
                margin-left: 250px;
            }
        }

        /* Toggle Button */
        .sidebar-toggle {
            position: fixed;
            left: 10px;
            top: 10px;
            z-index: 1001;
            display: none;
        }

        @media (max-width: 768px) {
            .sidebar-toggle {
                display: block;
            }
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            transition: all 0.3s ease;
            background-color: #37474F;
            z-index: 1000;
        }

        .sidebar.collapsed {
            width: 60px;
        }

        .sidebar.collapsed .sidebar-menu span {
            display: none;
        }

        .sidebar.collapsed .sidebar-brand h4 {
            display: none;
        }

        .main-content {
            margin-left: 250px;
            transition: all 0.3s ease;
        }

        .main-content.expanded {
            margin-left: 60px;
        }

        #sidebarToggle {
            background: transparent;
            border: none;
            color: white;
        }

        #sidebarToggle:focus {
            outline: none;
        }

        .sidebar {
            transition: all 0.3s ease;
        }

        .sidebar.minimized {
            width: 60px;
        }

        .sidebar.minimized .nav-link span,
        .sidebar.minimized h4 {
            display: none;
        }

        .main-content {
            margin-left: 250px;
            transition: all 0.3s ease;
        }

        .main-content.expanded {
            margin-left: 60px;
        }

        #sidebarToggle {
            cursor: pointer;
            border: none;
            background: transparent;
            color: white;
        }

        #sidebarToggle:focus {
            outline: none;
        }
    </style>

    @stack('styles')
</head>
<body>
    <div id="app">
        @auth
            
        <div class="sidebar" id="sidebar">
            <div class="sidebar-brand d-flex justify-content-between align-items-center p-3">
                <h4 class="text-white mb-0">SIPERKAT</h4>
                <button id="sidebarToggle" class="btn btn-link text-white">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
                <ul class="sidebar-menu">
                    <li>
                        <a href="{{ route('home') }}" class="{{ Request::routeIs('home') ? 'active' : '' }}">
                            <i class="fas fa-home"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('permohonan.create') }}" class="{{ Request::routeIs('permohonan.create') ? 'active' : '' }}">
                            <i class="fas fa-file-alt"></i>
                            <span>Buat Permohonan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('permohonan.status') }}" class="{{ Request::routeIs('permohonan.status') ? 'active' : '' }}">
                            <i class="fas fa-search"></i>
                            <span>Cek Status</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('permohonan.riwayat') }}" class="{{ Request::routeIs('permohonan.riwayat') ? 'active' : '' }}">
                            <i class="fas fa-history"></i>
                            <span>Riwayat</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('profile.index') }}" class="{{ Request::routeIs('profile.index') ? 'active' : '' }}">
                            <i class="fas fa-user"></i>
                            <span>Profile</span>
                        </a>
                    </li>
                </ul>
            </div>
        @endauth

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Sidebar Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.querySelector('.main-content');
            const toggleBtn = document.getElementById('sidebarToggle');
            
            // Cek state sebelumnya dari localStorage
            const isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
            if (isCollapsed) {
                sidebar.classList.add('collapsed');
                mainContent.classList.add('expanded');
            }
            
            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
                
                // Simpan state ke localStorage
                localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
            });
        });
    </script>

    <!-- Tambahkan script ini sebelum </body> -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButton = document.querySelector('#sidebarToggle');
        const sidebar = document.querySelector('.sidebar');
        const menuTexts = document.querySelectorAll('.nav-link span, h4');
        
        // Check saved state saat halaman dimuat
        const savedState = localStorage.getItem('sidebarCollapsed');
        if (savedState === 'true') {
            sidebar.style.width = '60px';
            menuTexts.forEach(el => el.style.display = 'none');
        }
        
        toggleButton.addEventListener('click', function() {
            const isExpanded = sidebar.style.width !== '60px';
            
            if (isExpanded) {
                // Collapse sidebar
                sidebar.style.width = '60px';
                menuTexts.forEach(el => {
                    el.style.display = 'none';
                    el.style.transition = 'display 0.3s';
                });
            } else {
                // Expand sidebar
                sidebar.style.width = '250px';
                setTimeout(() => {
                    menuTexts.forEach(el => {
                        el.style.display = isExpanded ? 'none' : 'inline';
                        el.style.transition = 'display 0.3s';
                    });
                }, 150);
            }
            
            // Simpan state di localStorage
            localStorage.setItem('sidebarCollapsed', isExpanded);
        });
    });
    </script>
    @stack('scripts')
</body>
</html>
