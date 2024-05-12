<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @vite('resources/css/app.css')
        <title>Notes App</title>

    </head>
    <body>
    <div id="app">
        <app></app>
    </div>
    </body>
    <script src="../js/app.js"></script>
</html>
