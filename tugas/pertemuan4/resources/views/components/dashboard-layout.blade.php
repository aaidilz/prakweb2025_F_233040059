<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- Tambahkan slot baru dengan nama $title --}}
    <title>{{ $title ?? config('app.name', 'Dashboard') }}</title>

    @if (file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://cdn.jsdelivr.net/npm/flowbite@4.0.1/dist/flowbite.min.js"></script>
    @endif
</head>
<body class="bg-gray-50 text-gray-900">
    <header class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between">
            <h1 class="text-lg font-semibold">{{ $title ?? 'Dashboard' }}</h1>
            <nav class="text-sm text-gray-600">
                <a href="/" class="hover:text-gray-900">Home</a>
            </nav>
        </div>
    </header>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{ $slot }}
    </main>
</body>
</html>
