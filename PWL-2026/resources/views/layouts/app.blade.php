<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Manajemen Produk & Supplier') - PWL 2026</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        :root {
            --bs-font-sans-serif: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
            --maroon-primary: #9f1d35;
            --maroon-dark: #7a1428;
            --maroon-light: #fdf2f4;
            --maroon-border: #f0c0c9;
            --primary-gradient: linear-gradient(135deg, #9f1d35 0%, #7a1428 100%);
        }

        body {
            font-family: var(--bs-font-sans-serif);
            background-color: #f8fafc;
            color: #1e293b;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Sidebar Styling */
        .app-shell {
            display: flex;
            flex: 1;
            min-height: 100vh;
        }

        .sidebar {
            --bs-offcanvas-width: 260px;
            background-color: #ffffff;
            border-right: 1px solid #e2e8f0;
            box-shadow: 1px 0 3px rgba(0, 0, 0, 0.03);
        }

        @media (min-width: 992px) {
            .sidebar {
                position: sticky;
                top: 0;
                height: 100vh;
                width: 260px;
                flex: 0 0 260px;
            }
        }

        .sidebar-brand-wrap {
            padding: 1.1rem 1.25rem;
            border-bottom: 1px solid #f1f5f9;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.2rem;
            color: #0f172a !important;
            letter-spacing: -0.02em;
            margin: 0;
            padding: 0;
        }

        .navbar-brand-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: var(--primary-gradient);
            color: #ffffff;
            margin-right: 0.6rem;
            font-size: 1.05rem;
            box-shadow: 0 3px 8px rgba(159, 29, 53, 0.25);
        }

        .sidebar-menu {
            list-style: none;
            margin: 0;
            padding: 1rem 0.9rem;
            display: flex;
            flex-direction: column;
            gap: 0.3rem;
        }

        .sidebar-label {
            font-size: 0.72rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #94a3b8;
            padding: 0 0.75rem;
            margin: 0.5rem 0 0.25rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.65rem;
            font-weight: 500;
            color: #64748b;
            padding: 0.65rem 0.85rem !important;
            border-radius: 8px;
            border: 1px solid transparent;
            transition: all 0.2s ease;
        }

        .nav-link i {
            font-size: 1.05rem;
        }

        .nav-link:hover {
            color: var(--maroon-primary);
            background-color: var(--maroon-light);
        }

        .nav-link.active {
            color: var(--maroon-dark) !important;
            background-color: var(--maroon-light);
            border: 1px solid var(--maroon-border);
            font-weight: 600;
        }

        .mobile-topbar {
            background: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 0.6rem 0;
        }

        .content-area {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        .main-content {
            flex: 1;
            padding: 2rem 0;
        }

        /* Card Custom */
        .card-custom {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.04);
            background: #ffffff;
        }

        .card-header-custom {
            background: #ffffff;
            border-bottom: 1px solid #f1f5f9;
            border-left: 4px solid var(--maroon-primary);
            padding: 1.1rem 1.35rem;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        .page-header {
            margin-bottom: 1.75rem;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 0.25rem;
            letter-spacing: -0.02em;
        }

        .page-subtitle {
            color: #64748b;
            font-size: 0.92rem;
            margin-bottom: 0;
        }

        /* Teal Buttons */
        .btn-maroon {
            background: var(--primary-gradient);
            color: #ffffff !important;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            padding: 0.55rem 1.15rem;
            display: inline-flex;
            align-items: center;
            gap: 0.45rem;
            box-shadow: 0 2px 6px rgba(159, 29, 53, 0.25);
            transition: all 0.2s ease;
        }

        .btn-maroon:hover {
            background: linear-gradient(135deg, #7a1428 0%, #5c0e1d 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 10px rgba(159, 29, 53, 0.35);
        }

        .btn-outline-maroon {
            color: var(--maroon-primary);
            border: 1px solid var(--maroon-primary);
            background: transparent;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .btn-outline-maroon:hover {
            background-color: var(--maroon-primary);
            color: #ffffff;
        }

        .text-maroon {
            color: var(--maroon-primary) !important;
        }

        /* Table Styling */
        .table-custom {
            border-collapse: separate;
            border-spacing: 0;
        }

        .table-custom thead th {
            background-color: #f1f5f9;
            color: #334155;
            font-weight: 600;
            font-size: 0.82rem;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            padding: 0.85rem 1.15rem;
            border-top: none;
            border-bottom: 1px solid #e2e8f0;
        }

        .table-custom tbody td {
            padding: 0.95rem 1.15rem;
            vertical-align: middle;
            color: #334155;
            border-bottom: 1px solid #f1f5f9;
        }

        .table-custom tbody tr:hover td {
            background-color: #f8fafc;
        }

        /* Badges */
        .badge-barcode {
            font-family: ui-monospace, SFMono-Regular, monospace;
            background-color: #f8fafc;
            color: #7a1428;
            padding: 0.35rem 0.65rem;
            border-radius: 6px;
            font-size: 0.85rem;
            font-weight: 600;
            border: 1px solid var(--maroon-border);
        }

        .badge-supplier {
            background-color: var(--maroon-light);
            color: var(--maroon-dark);
            border: 1px solid var(--maroon-border);
            padding: 0.3rem 0.65rem;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.85rem;
        }

        /* Form Controls */
        .form-label {
            font-weight: 600;
            color: #334155;
            font-size: 0.88rem;
            margin-bottom: 0.4rem;
        }

        .form-control, .form-select {
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            padding: 0.65rem 0.9rem;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--maroon-primary);
            box-shadow: 0 0 0 3px rgba(159, 29, 53, 0.15);
        }

        .input-group-text {
            border-radius: 8px 0 0 8px;
            background-color: #f8fafc;
            border-color: #cbd5e1;
            color: #64748b;
        }

        .input-group .form-control {
            border-radius: 0 8px 8px 0;
        }

        footer {
            background-color: #ffffff;
            border-top: 1px solid #e2e8f0;
            padding: 1.25rem 0;
            font-size: 0.85rem;
            color: #64748b;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="app-shell">
        <!-- Sidebar -->
        <aside class="sidebar offcanvas-lg offcanvas-start" tabindex="-1" id="sidebarMenu" aria-label="Menu navigasi">
            <div class="sidebar-brand-wrap d-flex align-items-center justify-content-between">
                <a class="navbar-brand d-flex align-items-center text-decoration-none" href="{{ route('product.index') }}">
                    <span class="navbar-brand-icon">
                        <i class="bi bi-grid-fill"></i>
                    </span>
                    <span>PWL Inventaris</span>
                </a>
                <button type="button" class="btn-close d-lg-none" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Tutup"></button>
            </div>
            <ul class="sidebar-menu">
                <li class="sidebar-label">Menu</li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('product.*') ? 'active' : '' }}" href="{{ route('product.index') }}">
                        <i class="bi bi-box-seam"></i> Data Produk
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('supplier.*') ? 'active' : '' }}" href="{{ route('supplier.index') }}">
                        <i class="bi bi-truck"></i> Data Supplier
                    </a>
                </li>
            </ul>
        </aside>

        <div class="content-area">
            <!-- Mobile top bar (hanya tampil di layar kecil) -->
            <div class="mobile-topbar d-lg-none">
                <div class="container-xl d-flex align-items-center gap-2">
                    <button class="btn border-0 shadow-none p-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-label="Buka menu">
                        <i class="bi bi-list fs-2 text-dark"></i>
                    </button>
                    <span class="fw-bold">PWL Inventaris</span>
                </div>
            </div>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container-xl">
            <!-- Flash Message Alerts -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center shadow-sm rounded-3 border-0 mb-4" role="alert">
                    <i class="bi bi-check-circle-fill fs-5 text-success me-2"></i>
                    <div>{{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center shadow-sm rounded-3 border-0 mb-4" role="alert">
                    <i class="bi bi-exclamation-triangle-fill fs-5 text-danger me-2"></i>
                    <div>{{ session('error') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show shadow-sm rounded-3 border-0 mb-4" role="alert">
                    <div class="d-flex align-items-center mb-1">
                        <i class="bi bi-exclamation-circle-fill fs-5 me-2"></i>
                        <strong>Terdapat beberapa kesalahan input:</strong>
                    </div>
                    <ul class="mb-0 ps-4 small">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container-xl text-center">
            <span>&copy; {{ date('Y') }} PWL Inventaris • Praktikum Pemrograman Web Lanjut</span>
        </div>
    </footer>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    @stack('scripts')
</body>
</html>