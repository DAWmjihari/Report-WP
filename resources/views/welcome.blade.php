<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/bg.css') }}">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
    <link rel="stylesheet" href="{{ asset('css/loader.css') }}">
</head>

<body>
    <video autoplay muted loop id="bgVideo">
        <source src="{{ asset('video/bg.mp4') }}" type="video/mp4">
    </video>
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
        <div class="top-right links">
            @auth
            <div><a href="{{ url('/home') }}">{{ __('auth.home') }}</a></div>
            @else
            <div class="animate__animated animate__tada animate__repeat-3"><a
                    href="{{ route('login') }}">{{ __('auth.login') }}</a></div>

            @if (Route::has('register'))
            <a href="{{ route('register') }}">{{ __('auth.register') }}</a>
            @endif
            @endauth
        </div>
        @endif

        <div class="content">
            <div class="title m-b-md animate__animated animate__jackInTheBox">
                {{ __('welcome.message') }} {{ config('app.name', 'Laravel') }}
            </div>
            <p class="animate__animated animate__fadeIn">{{ __('welcome.locale') }}</p>
            <div class="links">
                <div class="animate__animated animate__backInLeft animate__delay-1s"><a
                        href="{{route('localization', 'ca')}}">{{ __('lang.catalan') }}</a></div>
                <div class="animate__animated animate__backInRight animate__delay-2s"><a
                        href="{{route('localization', 'es')}}">{{ __('lang.spanish') }}</a></div>
                <div class="animate__animated animate__backInUp animate__delay-3s"><a
                        href="{{route('localization', 'en')}}">{{ __('lang.english') }}</a></div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script src="{{ asset("js/pace.min.js") }}"></script>
</body>

</html>
