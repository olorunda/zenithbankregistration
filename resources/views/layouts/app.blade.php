<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    @laravelTelInputStyles
    @livewireStyles

    <link rel="manifest" href="{{asset('manifest.json')}}">
    @vite(['resources/js/app.js'])
    <script>
        if (typeof navigator.serviceWorker !== 'undefined') {
            navigator.serviceWorker.register('{{asset('sw.js')}}')
        }
    </script>
    <style>
        .bg-pattern {
            background-image: url('https://images.unsplash.com/photo-1554469384-e58fac16e23a?q=80&w=2787&auto=format&fit=crop&ixlib=rb-4.0.3');
            background-position: left center;
            background-repeat: no-repeat;
            background-size: contain;
            opacity: 0.1;
        }
    </style>
</head>
<body class="min-h-screen bg-white relative overflow-hidden">
<!-- Background Pattern -->
<div class="bg-pattern fixed inset-0 z-0"></div>

<!-- Logo -->
<div class="absolute top-4 right-4">
    <img src="https://veritasregistrars.com/wp-content/uploads/2021/12/Veritas-Logo.png" alt="Veritas Registrars" class="h-12">
</div>

    @yield('content')

    @livewireScripts
    @laravelTelInputScripts
    <script>
        Livewire.on('hideOtherClasses', hide_or_show_masterclasses => {
            alert('A post was added with the id of: ' + hide_or_show_masterclasses);
        })
    </script>
</body>

</html>
