<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel Coalation Technologies') }}</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <style>
        body {
            background: var(--bs-gray-200)
        }
    </style>
</head>

<body>
    @yield('main')
</body>

</html>
