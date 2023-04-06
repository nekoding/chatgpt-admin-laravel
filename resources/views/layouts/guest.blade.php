<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >
    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link
        href="https://fonts.bunny.net"
        rel="preconnect"
    >
    <link
        href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
        rel="stylesheet"
    />

    <link
        href="https://unpkg.com/@coreui/icons/css/all.min.css"
        rel="stylesheet"
    >

    {{-- Meta --}}
    <link
        href="{{ asset('/coreui/assets/favicon/apple-icon-57x57.png') }}"
        rel="apple-touch-icon"
        sizes="57x57"
    >
    <link
        href="{{ asset('/coreui/assets/favicon/apple-icon-60x60.png') }}"
        rel="apple-touch-icon"
        sizes="60x60"
    >
    <link
        href="{{ asset('/coreui/assets/favicon/apple-icon-72x72.png') }}"
        rel="apple-touch-icon"
        sizes="72x72"
    >
    <link
        href="{{ asset('/coreui/assets/favicon/apple-icon-76x76.png') }}"
        rel="apple-touch-icon"
        sizes="76x76"
    >
    <link
        href="{{ asset('/coreui/assets/favicon/apple-icon-114x114.png') }}"
        rel="apple-touch-icon"
        sizes="114x114"
    >
    <link
        href="{{ asset('/coreui/assets/favicon/apple-icon-120x120.png') }}"
        rel="apple-touch-icon"
        sizes="120x120"
    >
    <link
        href="{{ asset('/coreui/assets/favicon/apple-icon-144x144.png') }}"
        rel="apple-touch-icon"
        sizes="144x144"
    >
    <link
        href="{{ asset('/coreui/assets/favicon/apple-icon-152x152.png') }}"
        rel="apple-touch-icon"
        sizes="152x152"
    >
    <link
        href="{{ asset('/coreui/assets/favicon/apple-icon-180x180.png') }}"
        rel="apple-touch-icon"
        sizes="180x180"
    >
    <link
        type="image/png"
        href="{{ asset('/coreui/assets/favicon/android-icon-192x192.png') }}"
        rel="icon"
        sizes="192x192"
    >
    <link
        type="image/png"
        href="{{ asset('/coreui/assets/favicon/favicon-32x32.png') }}"
        rel="icon"
        sizes="32x32"
    >
    <link
        type="image/png"
        href="{{ asset('/coreui/assets/favicon/favicon-96x96.png') }}"
        rel="icon"
        sizes="96x96"
    >
    <link
        type="image/png"
        href="{{ asset('/coreui/assets/favicon/favicon-16x16.png') }}"
        rel="icon"
        sizes="16x16"
    >
    <link
        href="{{ asset('/coreui/assets/favicon/manifest.json') }}"
        rel="manifest"
    >
    <meta
        name="msapplication-TileColor"
        content="#ffffff"
    >
    <meta
        name="msapplication-TileImage"
        content="{{ asset('/coreui/assets/favicon/ms-icon-144x144.png') }}"
    >
    <meta
        name="theme-color"
        content="#ffffff"
    >

    {{-- Style --}}
    <link
        href="{{ asset('/coreui/vendors/simplebar/css/simplebar.css') }}"
        rel="stylesheet"
    >

    <link
        href="{{ asset('/coreui/css/vendors/simplebar.css') }}"
        rel="stylesheet"
    >

    <link
        href="{{ asset('/coreui/css/style.min.css') }}"
        rel="stylesheet"
    >

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="bg-light min-vh-100 d-flex flex-row align-items-center">
        <div class="container">
            {{ $slot }}
        </div>
    </div>

    <script src="{{ asset('/coreui/vendors/@coreui/coreui/js/coreui.bundle.min.js') }}"></script>
    <script src="{{ asset('/coreui/vendors/simplebar/js/simplebar.min.js') }}"></script>
</body>

</html>
