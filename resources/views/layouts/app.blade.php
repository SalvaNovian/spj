<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SPJ Arsip</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>

<body>

@include('layouts.sidebar')

<div class="main-content">

    @include('layouts.navbar')

    <div class="container-fluid p-4">

        @yield('content')

    </div>

    @include('layouts.footer')

</div>

</body>

</html>