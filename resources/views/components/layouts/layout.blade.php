<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-primary-50 dark:bg-primary-950">
    
    {{ $slot }}

    @livewireScripts
</body>


</html>
