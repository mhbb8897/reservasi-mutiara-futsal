<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/storage/image/image.png">
    <title>{{ $title ?? 'Mutiara Futsal' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class='min-h-screen flex flex-col bg-slate-200 dark:bg-slate-700 '>
    @livewire('partials.navbar')
    <main class="flex-grow  bg-cover bg-center py-10" style="background-image: url('{{ asset('storage/image/bg-futsal.jpg') }}')">
        {{ $slot }}
    </main>
    @livewire('partials.footer')
    @livewireScripts
</body>

</html>
