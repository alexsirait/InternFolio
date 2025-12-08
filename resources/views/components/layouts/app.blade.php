<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'InternFolio' }}</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50 text-gray-900">

    <x-navbar />

    <main>
        {{ $slot }}
    </main>

    <x-footer />

</body>

</html>
