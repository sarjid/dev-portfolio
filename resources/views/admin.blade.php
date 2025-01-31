<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel Admin') }}</title>
    <!-- Google Font Plus Jakarta Sans - Outfit -->

    <!-- Scripts -->
    @routes
    @vite(['resources/js/admin/admin.js', 'resources/css/admin.css', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead

    <!-- Placeholder for the dynamic favicon -->
    <link id="dynamic-favicon" rel="icon" href="{{ asset('images/logo-inverse.png') }}" />
</head>

<body class="font-sans antialiased">
    @inertia
</body>

</html>
