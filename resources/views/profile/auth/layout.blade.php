<!DOCTYPE html>
<html lang="{{ GoDesk::locale() }}" class="h-full font-sans antialiased">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{!! $title !!}</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,800,800i,900,900i" rel="stylesheet">

    <link rel="stylesheet" href="{{ mix('app.css', 'vendor/nova') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}">

    @include('godesk::partials.meta')
</head>
<body class="auth text-black h-full {{$class ?? null}}" style="background: #384757;">
<div class="h-full">
    <div class="px-view py-view mx-auto">
        @yield('content')
    </div>
</div>
</body>
</html>
