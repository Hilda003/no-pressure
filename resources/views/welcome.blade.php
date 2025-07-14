<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        
        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>📝</text></svg>">
        
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <title>My Notes - Organize Your Thoughts</title>
        
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div id="app">
            <app></app>
        </div>
        
        <!-- Loading Spinner -->
        <div id="loading" class="fixed inset-0 bg-white z-50 flex items-center justify-center">
            <div class="text-center">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto mb-4"></div>
                <p class="text-gray-600">Loading your notes...</p>
            </div>
        </div>
        
        <script>
            // Hide loading spinner when app is ready
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(() => {
                    const loading = document.getElementById('loading');
                    if (loading) {
                        loading.style.display = 'none';
                    }
                }, 1000);
            });
        </script>
    </body>
</html>