<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Admin')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
    body {
    background: #f5f7fb;
}

.sidebar {
    background: #1f2933; /* gris carbón */
    min-height: 100vh;
    color: #e5e7eb;
}

.sidebar h5 {
    color: #ffffff;
}

.sidebar-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: .75rem;
}

.mobile-menu-toggle {
    display: none;
    align-items: center;
    justify-content: center;
    min-width: 44px;
    min-height: 44px;
    border: 1px solid rgba(255,255,255,.16);
    border-radius: .6rem;
    color: #ffffff;
    background: #374151;
}

.admin-nav.collapse {
    display: block;
}

.sidebar a {
    color: #cbd5e1;
    text-decoration: none;
    padding: .6rem 1rem;
    border-radius: .6rem;
    display: block;
    margin-bottom: .3rem;
}

.sidebar a:hover,
.sidebar a.active {
    background: #374151; /* gris más claro */
    color: #ffffff;
}

.card {
    border: none;
    border-radius: 1rem;
    box-shadow: 0 10px 25px rgba(0,0,0,.06);
}

.btn {
    border-radius: .6rem;
}

.admin-shell {
    min-height: 100vh;
}

.card > .card-body.p-0 {
    overflow-x: auto;
}

.table {
    min-width: 760px;
}

@media (max-width: 767.98px) {
    .admin-shell {
        min-height: auto;
    }

    .sidebar {
        min-height: auto;
        position: sticky;
        top: 0;
        z-index: 1020;
        padding: .85rem 1rem !important;
        border-bottom: 1px solid rgba(255,255,255,.08);
    }

    .sidebar h5 {
        margin-bottom: 0 !important;
    }

    .mobile-menu-toggle {
        display: inline-flex;
    }

    .admin-nav.collapse {
        display: none;
    }

    .admin-nav.collapse.show {
        display: block;
    }

    .admin-nav {
        padding-top: .85rem;
    }

    .sidebar a {
        display: flex;
        align-items: center;
        gap: .65rem;
        width: 100%;
        min-height: 46px;
        margin: 0 0 .45rem 0;
        padding: .7rem .8rem;
        font-size: 1rem;
    }

    main {
        padding: 1rem !important;
    }

    .d-flex.justify-content-between.align-items-center.mb-4 {
        align-items: flex-start !important;
        flex-direction: column;
        gap: .75rem;
    }

    .d-flex.justify-content-between.align-items-center.mb-4 .btn {
        width: 100%;
    }

    .btn,
    .form-control,
    .form-select {
        min-height: 44px;
    }

    .card {
        border-radius: .75rem;
    }

    .table {
        min-width: 680px;
    }
}
    </style>
</head>

<body>

<div class="container-fluid admin-shell">
    <div class="row">

        {{-- SIDEBAR --}}
        <aside class="col-md-2 sidebar p-3">
            <div class="sidebar-header">
                <h5 class="mb-4 fw-bold">
                    <i class="bi bi-truck"></i> Admin
                </h5>

                <button class="mobile-menu-toggle"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#admin-menu"
                        aria-controls="admin-menu"
                        aria-expanded="false"
                        aria-label="Abrir menu">
                    <i class="bi bi-list fs-4"></i>
                </button>
            </div>

            <nav id="admin-menu" class="admin-nav collapse">

            <a href="{{ route('admin.camiones.index') }}" class="{{ request()->routeIs('admin.camiones.*') ? 'active' : '' }}">
                <i class="bi bi-truck-front"></i> Camiones
            </a>

            <a href="{{ route('admin.marcas.index') }}" class="{{ request()->routeIs('admin.marcas.*') ? 'active' : '' }}">
                <i class="bi bi-bookmark"></i> Marcas
            </a>

            <a href="{{ route('admin.modelos.index') }}" class="{{ request()->routeIs('admin.modelos.*') ? 'active' : '' }}">
                <i class="bi bi-layers"></i> Modelos
            </a>

            <a href="{{ route('admin.categorias.index') }}" class="{{ request()->routeIs('admin.categorias.*') ? 'active' : '' }}">
                <i class="bi bi-tags"></i> Categorías
            </a>

            <a href="{{ route('admin.referencias.index') }}" class="{{ request()->routeIs('admin.referencias.*') ? 'active' : '' }}">
                <i class="bi bi-images"></i> Referencia
            </a>
            </nav>
        </aside>

        {{-- CONTENT --}}
        <main class="col-md-10 p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </main>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
