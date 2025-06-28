<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

     <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
    {{-- Bootstrap via CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="font-sans antialiased text-gray-900">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="bg-white p-3 font-sans antialiased" style="width: 250px; min-height: 100vh;">
            <h4 class="font-sans">ADMIN MENU</h4>
            <ul class="nav flex-column mt-4">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link font-sans text-black" style="transition: background 0.2s;" onmouseover="this.style.background='#f1f1f1'" onmouseout="this.style.background='transparent'">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('product.index') }}" class="nav-link font-sans text-black" style="transition: background 0.2s;" onmouseover="this.style.background='#f1f1f1'" onmouseout="this.style.background='transparent'">Kelola Produk</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('kategori.index') }}" class="nav-link font-sans text-black" style="transition: background 0.2s;" onmouseover="this.style.background='#f1f1f1'" onmouseout="this.style.background='transparent'">Kategori</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.orders.index') }}" class="nav-link font-sans text-black" style="transition: background 0.2s;" onmouseover="this.style.background='#f1f1f1'" onmouseout="this.style.background='transparent'">Data Pemesan</a>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="flex-fill p-4 bg-light" style="min-height: 100vh;">
            @yield('content')
        </main>
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
