<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Spj Arsip</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Fix: Chart.js dimuat di head agar sudah tersedia sebelum script di @yield('content') dijalankan --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>