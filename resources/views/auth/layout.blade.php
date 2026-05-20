<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BNI CRM - {{ $title ?? 'Login' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-100">
    <div class="min-h-screen flex flex-col justify-center items-center">
        <div class="mb-8">
            <a href="/" class="text-3xl font-bold text-indigo-600">BNI CRM</a>
        </div>
        
        <div class="w-full sm:max-w-md px-6 py-8 bg-white shadow-md overflow-hidden rounded-lg">
            @yield('content')
        </div>
    </div>
</body>
</html>