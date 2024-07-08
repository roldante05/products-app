<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite('resources/css/app.css')
</head>

<body class=" bg-gray-100">

    <div class="flex">
        <!-- Sidebar -->
        @if (session('user'))
            <x-products.sidebar />
        @endif

        <!-- Main Content -->

        <div class="font-sans text-gray-900 antialiased flex-1">
            @yield('content')
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    @vite('resources/js/app.js')
    @yield('scripts')
</body>

</html>
