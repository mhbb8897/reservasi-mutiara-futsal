<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'Mutiara Futsal' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <x-livewire-alert::styles /> --}}
    @livewireStyles
</head>

<body class='bg-slate-200 dark:bg-slate-700'>
    @livewire('partials.navbar')
    <main>
        {{ $slot }}
    </main>
    @livewire('partials.footer')
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/preline@1.8.0/dist/preline.min.js"></script>
    {{-- <x-livewire-alert::scripts /> --}}

    {{-- <livewire-alert::flash /> --}}
</body>

</html>
