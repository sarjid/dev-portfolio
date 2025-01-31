<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>
    <!-- Google Font Plus Jakarta Sans - Outfit -->
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet" />
    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', 'resources/css/web.css', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead

    <!-- Placeholder for the dynamic favicon -->
    <link id="dynamic-favicon" rel="icon" href="{{ asset('images/logo-inverse.png') }}" />
</head>

<body class="font-sans antialiased overflow-hidden">
    @inertia
</body>

</html>
