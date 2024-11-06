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

</head>

<body class="bg-[url('/assets/images/bg.png')] flex flex-col font-Poppins bg-no-repeat min-h-screen" style="background-size: 100% 100%">

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
    <script>
        Livewire.on('hideOtherClasses', hide_or_show_masterclasses => {
            alert('A post was added with the id of: ' + hide_or_show_masterclasses);
        })
    </script>
</body>

</html>
