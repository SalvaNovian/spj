<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SPJ Arsip') }} - Login</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body {
                background-color: #f4f6f9;
            }
            .login-container {
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .login-card {
                width: 100%;
                max-width: 400px;
                padding: 2rem;
                border-radius: 0.5rem;
                box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                background: white;
            }
            .login-logo {
                text-align: center;
                margin-bottom: 2rem;
            }
            .login-logo h4 {
                margin: 0;
                font-weight: normal;
            }
            .login-logo b {
                font-weight: bold;
                color: #0d6efd;
            }
        </style>
    </head>
    <body>
        <div class="login-container">
            <div class="login-card">
                <div class="login-logo">
                    <h4><b>SPJ</b> Arsip</h4>
                </div>
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
