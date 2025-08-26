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
    @vite(['resources/js/app.js'])
</head>

<body class="bg-[url('/assets/images/bg.jpg')] flex flex-col font-Poppins bg-repeat min-h-screen" style="background-size: 100% ;">
    <nav class="flex items-center w-full justify-end">
        <div class="py-4 px-2 lg:px-8 lg:py-8">
            <a href="{{ route('welcome') }}" class="">
                <img src="/assets/images/logo.svg" alt="" class="w-12 lg:w-24 mx-auto">
            </a>
        </div>
    </nav>

    @yield('content')

    @livewireScripts
    @laravelTelInputScripts
</body>

</html>
