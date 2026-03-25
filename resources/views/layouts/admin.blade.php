<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','Admin Panel')</title>

    {{-- Bootstrap & Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #6366f1; /* Indigo */
            --primary-hover: #4f46e5;
            --accent: #ec4899; /* Pink */
            --bg: #f8fafc;
            --sidebar-bg: #ffffff;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border: rgba(99, 102, 241, 0.1);
            --gradient: linear-gradient(135deg, #6366f1, #a855f7, #ec4899);
            --gradient-subtle: linear-gradient(135deg, rgba(99, 102, 241, 0.05), rgba(236, 72, 153, 0.05));
            --shadow-sm: 0 4px 15px rgba(0,0,0,0.03);
            --shadow-md: 0 10px 30px rgba(99, 102, 241, 0.08);
            --radius: 20px;
            --radius-sm: 12px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            color: var(--text-main);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        /* Top Navbar */
        .admin-navbar {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
            z-index: 1030;
        }
        .navbar-brand {
            font-weight: 800;
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -0.5px;
        }
        
        /* Sidebar */
        .sidebar {
            background: var(--sidebar-bg);
            border-right: 1px solid var(--border);
            height: calc(100vh - 72px);
            position: sticky;
            top: 72px;
            overflow-y: auto;
        }
        .sidebar-header {
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            font-size: 0.75rem;
            color: var(--text-muted);
            padding: 1.5rem 1.8rem 0.5rem;
        }
        
        .list-group-item {
            border: none;
            padding: 0.85rem 1.8rem;
            margin: 0.2rem 1rem;
            border-radius: var(--radius-sm);
            color: var(--text-main);
            font-weight: 500;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 0.95rem;
        }
        .list-group-item i {
            color: var(--text-muted);
            font-size: 1.2rem;
            transition: all 0.3s;
        }
        .list-group-item:hover {
            background-color: rgba(99, 102, 241, 0.05);
            color: var(--primary);
            transform: translateX(5px);
        }
        .list-group-item:hover i {
            color: var(--primary);
        }
        
        .list-group-item.active {
            background: var(--gradient);
            color: white;
            box-shadow: 0 8px 20px rgba(99, 102, 241, 0.3);
            font-weight: 600;
        }
        .list-group-item.active i {
            color: white;
        }

        /* Main Content Area */
        .main-content {
            padding: 2.5rem;
            min-height: calc(100vh - 72px);
        }
        
        /* Card defaults inside admin */
        .card {
            border: none;
            border-radius: var(--radius);
            box-shadow: var(--shadow-md);
            background: white;
            overflow: hidden;
        }
        
        /* Table Styling */
        .table-premium {
            margin-bottom: 0;
        }
        .table-premium thead th {
            background-color: #fcfcfd;
            border-bottom: 1px solid var(--border);
            color: var(--text-muted);
            text-transform: uppercase;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            padding: 1.2rem 1.5rem;
        }
        .table-premium tbody td {
            padding: 1.2rem 1.5rem;
            border-bottom: 1px solid rgba(0,0,0,0.02);
            color: var(--text-main);
            font-size: 0.95rem;
        }
        .table-premium tbody tr:last-child td {
            border-bottom: none;
        }
        .table-premium tbody tr:hover {
            background-color: rgba(99, 102, 241, 0.01);
        }

        /* Buttons & Badges */
        .btn-premium-primary {
            background: var(--gradient);
            border: none;
            color: white;
            padding: 0.6rem 1.5rem;
            border-radius: var(--radius-sm);
            font-weight: 600;
            transition: all 0.3s;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.2);
        }
        .btn-premium-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(99, 102, 241, 0.3);
            color: white;
        }
        
        .badge-premium {
            padding: 0.5em 1em;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.8rem;
        }

        /* Form Controls */
        .form-control-premium {
            border: 1px solid #e2e8f0;
            border-radius: var(--radius-sm);
            padding: 0.75rem 1rem;
            transition: all 0.2s;
            background-color: #fcfcfd;
        }
        .form-control-premium:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
            background-color: white;
        }
    </style>
</head>
<body>

{{-- Top Navbar --}}
<nav class="navbar navbar-expand-lg admin-navbar sticky-top py-3">
    <div class="container-fluid px-4">
        <a class="navbar-brand d-flex align-items-center gap-2" href="#">
            <div class="rounded-circle d-flex align-items-center justify-content-center" 
                 style="width: 32px; height: 32px; background: var(--gradient); color: white;">
                <i class="bi bi-hexagon-fill fs-6"></i>
            </div>
            <span>AdminHub</span>
        </a>
        
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#adminNav">
            <i class="bi bi-list fs-2 text-dark"></i>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="adminNav">
            <ul class="navbar-nav align-items-center gap-3">
                <li class="nav-item">
                    <a class="nav-link btn btn-sm rounded-pill" href="{{ url('/') }}" target="_blank" 
                       style="background: rgba(99,102,241,0.1); color: var(--primary); font-weight: 600; padding: 0.4rem 1rem;">
                        <i class="bi bi-box-arrow-up-right me-1"></i> View Site
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-2 text-dark fw-semibold" href="#" role="button" data-bs-toggle="dropdown">
                        <img src="https://ui-avatars.com/api/?name=Admin&background=6366f1&color=fff" class="rounded-circle shadow-sm" width="36" height="36" alt="Admin">
                        Admin User
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow rounded-4 mt-2">
                        <li><a class="dropdown-item py-2" href="#"><i class="bi bi-person me-2 text-muted"></i> Profile</a></li>
                        <li><a class="dropdown-item py-2" href="#"><i class="bi bi-gear me-2 text-muted"></i> Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item py-2 text-danger" href="{{ url('/logout') }}"><i class="bi bi-box-arrow-right me-2"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        {{-- Sidebar --}}
        <aside class="col-md-3 col-lg-2 sidebar p-0 d-none d-md-block">
            <div class="sidebar-header mt-2">Management</div>
            
            <div class="list-group list-group-flush mt-2 pb-4">
                <a href="{{ route('category.list') }}" class="list-group-item list-group-item-action {{ request()->routeIs('category.*') ? 'active' : '' }}">
                    <i class="bi bi-tags"></i> Categories
                </a>
                <a href="{{ url('/productList') }}" class="list-group-item list-group-item-action {{ request()->is('product*') ? 'active' : '' }}">
                    <i class="bi bi-box-seam"></i> Products
                </a>
                
                <div class="sidebar-header mt-3">Design</div>
                <a href="{{ route('banner.list') }}" class="list-group-item list-group-item-action {{ request()->routeIs('banner.*') ? 'active' : '' }}">
                    <i class="bi bi-images"></i> Banners
                </a>
                <a href="{{ route('slider.list') }}" class="list-group-item list-group-item-action {{ request()->routeIs('slider.*') ? 'active' : '' }}">
                    <i class="bi bi-view-carousel"></i> Sliders
                </a>
                <a href="{{ route('footer.list') }}" class="list-group-item list-group-item-action {{ request()->routeIs('footer.*') ? 'active' : '' }}">
                    <i class="bi bi-layout-text-window-reverse"></i> Footer Settings
                </a>
            </div>
        </aside>

        {{-- Main Content --}}
        <main class="col-md-9 col-lg-10 main-content bg-light">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <div>
                    <h2 class="fw-bold mb-1 text-dark" style="letter-spacing: -0.5px;">@yield('title', 'Dashboard')</h2>
                    <div class="text-muted" style="font-size: 0.95rem;">@yield('subtitle', 'Manage your store efficiently')</div>
                </div>
                <div>
                    @yield('actions')
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger shadow-sm mb-4">
                    <div class="d-flex align-items-center gap-2 fw-bold mb-2">
                        <i class="bi bi-exclamation-triangle-fill"></i> Validation Error
                    </div>
                    <ul class="mb-0 small ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success shadow-sm mb-4 d-flex align-items-center gap-2">
                    <i class="bi bi-check-circle-fill fs-5"></i>
                    <div>
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                </div>
            @endif

            <div class="card p-0 border-0 shadow-sm rounded-4 overflow-hidden">
                @yield('content')
            </div>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>