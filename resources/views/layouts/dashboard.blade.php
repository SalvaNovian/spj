<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Spj Arsip</title>

    <script>
    (() => {
        const theme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-bs-theme', theme);

        if (localStorage.getItem('sidebar') === 'collapsed') {
            document.documentElement.classList.add('preload-collapsed');
        }
    })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Fix: Chart.js dimuat di head agar sudah tersedia sebelum script di @yield('content') dijalankan --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body id="body">

{{-- Page Loader --}}
<div id="pageLoader" class="page-loader">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
<script>
    // Langsung hilangkan loader secepat mungkin saat render tanpa menunggu external assets
    document.getElementById('pageLoader').classList.add('fade-out');
</script>

<div class="d-flex">

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    {{-- Content --}}
    <div class="flex-grow-1 main-content">

        {{-- Navbar --}}
        @include('layouts.navbar')

        <main class="container-fluid p-4">

            @yield('content')

        </main>

    </div>

</div>

@include('layouts.footer')

</body>
</html>