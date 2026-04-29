<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Доска объявлений' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans antialiased text-gray-800 flex flex-col min-h-screen">

    <x-navigation />

    <main class="flex-1 max-w-[1000px] mx-auto px-4 py-8 w-full">
        @if(session('success'))
        <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded-lg shadow-sm mb-6">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-sm mb-6">
            {{ session('error') }}
        </div>
        @endif

        {{ $slot }}
    </main>

</body>

</html>