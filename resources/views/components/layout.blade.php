<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css'])

    <title>{{ $title }}</title>

    <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

    {{-- FAVICON --}}
    <link rel="icon" sizes="32x32" href="http://simweb5.tftgrup.com/assets/img/logo.png" type="image/png">
</head>

</head>

<body class="h-full">
    <div class="min-h-full">
        <x-navbar></x-navbar>

        <x-header :subtitle="$subtitle"></x-header>

        <main>
            <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>
    </div>
    @stack('scripts')
</body>

<script src="https://kit.fontawesome.com/c2752fde40.js" crossorigin="anonymous"></script>

</html>
