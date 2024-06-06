<!DOCTYPE html>
<html lang="{{ LaravelLocalization::getCurrentLocale() }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
    {!! SEO::generate() !!}
    @if(app()->hasDebugModeEnabled())
        <meta name="robots" content="noindex">
    @endif
    @if(file_exists(resource_path('views/favicons.blade.php')))
        @include('favicons')
    @endif

    @if(!App::hasDebugModeEnabled())
        <x-head-css/>
    @else
        @vite(['webfonts.css','resources/css/app.css'])
    @endif
</head>
<body class="font-sans antialiased">
@yield('content')
@vite'(['resources/js/app.js'])
</body>
</html>