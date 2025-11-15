<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="gustavo Motors - vitrine digital para compra e venda de veículos.">
    <title>@yield('title', 'gustavo Motors')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="font-sans antialiased bg-slate-100 text-slate-900">
@yield('body')
@stack('scripts')
</body>
</html>
