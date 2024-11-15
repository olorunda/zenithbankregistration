<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @livewireStyles
    @vite(['resources/js/app.js','public/sw.js','public/register-service-worker.js'])
    <link rel="manifest" href="{{asset('manifest.json')}}">
</head>
<body class="font-Poppins">
    @yield('content')
    @livewireScripts
</body>
</html>
