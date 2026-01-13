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
    </style>
</head>

<body>

<div class="container-fluid">
    <div class="row">

        {{-- SIDEBAR --}}
        <aside class="col-md-2 sidebar p-3">
            <h5 class="mb-4 fw-bold">
                <i class="bi bi-truck"></i> Admin
            </h5>

            <a href="{{ route('admin.camiones.index') }}">
                <i class="bi bi-truck-front"></i> Camiones
            </a>

            <a href="{{ route('admin.categorias.index') }}">
                <i class="bi bi-tags"></i> Categorías
            </a>
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
</body>
</html>
