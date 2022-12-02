<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="UTF-8">
    <title>{{ __('auth.title-register') }}</title>
    @section('meta')
        <meta name="description" content="{{ config('other.meta_description') }}">
        <meta name="keywords" content="{{ config('other.meta_keywords') }}">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property="og:title" content="{{ __('auth.login') }}">
        <meta property="og:site_name" content="{{ config('other.title') }}">
        <meta property="og:type" content="website">
        <meta property="og:image" content="{{ url('/img/og.png') }}">
        <meta property="og:description" content="{{ config('other.meta_description') }}">
        <meta property="og:url" content="{{ url('/') }}">
        <meta property="og:locale" content="{{ config('app.locale') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @show
    <link rel="shortcut icon" href="{{ url('/favicon.png') }}" type="image/x-icon">
    <link rel="icon" href="{{ url('/favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ mix('css/main/login.css') }}" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ mix('css/snowfall/font-awesome.css') }}" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ mix('css/snowfall/jqueryscripttop.css') }}" crossorigin="anonymous">
    <script src="{{ mix('js/jquery-1.12.4.js') }}" crossorigin="anonymous"></script>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-Q8PXB7XS8X"></script>
    <script src="{{ mix('js/google.js') }}" crossorigin="anonymous"></script>
    <!-- Google tag (gtag.js) -->
    <script type="text/javascript" async="" src="https://adserver.adman.si/add/adman.js"></script>
</head>

@php $bg = rand(1, 4); $bgchange = $bg.".jpg" @endphp
<body style="background: url('/img/login/december/{{ $bgchange }}');background-position-x: 50%;background-position-y: center;background-size: cover;background-attachment: fixed;">

<!-- December -->
<div id="snowfall-wrapper" />
<!-- December -->

@if ($errors->any())
    <div id="ERROR_COPY" style="display: none;">
        @foreach ($errors->all() as $error)
            {{ $error }}<br>
        @endforeach
    </div>
@endif
<div class="wrapper fadeInDown">
    <div id="formContent">
        <a href="{{ route('login') }}">
            <h2 class="inactive underlineHover">{{ __('auth.login') }} </h2>
        </a>
            |
        <a href="{{ route('registrationForm', ['code' => $code]) }}">
            <h2 class="active"> {{ __('auth.signup') }}</h2>
        </a>

        <div class="fideIn first">
            <img src="{{ url('/logo.png') }}" id="icon" alt="SLOshare"/>
        </div>

        <form role="form" method="POST" action="{{ route('register', ['code' => $code]) }}">
            @csrf
            <label for="username"></label><input type="text" id="username" class="fadeIn second" name="username"
                                                 placeholder="{{ __('auth.username') }}" required autofocus>
            <label for="email"></label><input type="email" id="email" class="fadeIn third" name="email"
                                              placeholder="{{ __('auth.email') }}" required>
            <label for="password"></label><input type="password" id="password" class="fadeIn third" name="password"
                                                 placeholder="{{ __('auth.password') }}" required>
            @if (config('captcha.enabled') == true)
                @hiddencaptcha
            @endif
            <button type="submit" class="fadeIn fourth">{{ __('auth.signup') }}</button>
        </form>

        <div id="formFooter">
            <a href="{{ route('password.request') }}">
                <h2 class="inactive underlineHover">{{ __('auth.lost-password') }} </h2>
            </a>
            <a href="{{ route('username.request') }}">
                <h2 class="inactive underlineHover">{{ __('auth.lost-username') }} </h2>
            </a>
            @if (config('email-white-blacklist.enabled') == 'block')
                <br>
                <a href="{{ route('public.email') }}">
                    <h2 class="inactive underlineHover">{{ __('common.email-blacklist') }} </h2>
                </a>
            @elseif (config('email-white-blacklist.enabled') == 'allow')
                <br>
                <a href="{{ route('public.email') }}">
                    <h2 class="inactive underlineHover">{{ __('common.email-whitelist') }} </h2>
                </a>
            @endif
        </div>
    </div>
    <div style="width: 468px; height: 60px;" data-admanids="f57b6946_8ea1e878"></div>
</div>

<script src="{{ mix('js/app.js') }}" crossorigin="anonymous"></script>
@foreach (['warning', 'success', 'info'] as $key)
    @if (Session::has($key))
        <script nonce="{{ SLOYakuza\SecureHeaders\SecureHeaders::nonce('script') }}">
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
          })

          Toast.fire({
            icon: '{{ $key }}',
            title: '{{ Session::get($key) }}'
          })

        </script>
    @endif
@endforeach

@if (Session::has('errors'))
    <script nonce="{{ SLOYakuza\SecureHeaders\SecureHeaders::nonce('script') }}">
      Swal.fire({
        title: '<strong style=" color: rgb(17,17,17);">NAPAKA</strong>',
        icon: 'error',
        html: jQuery('#ERROR_COPY').html(),
        showCloseButton: true,
      })

    </script>
@endif

<script src="{{ mix('js/ad.js') }}" crossorigin="anonymous"></script>
<script src="{{ mix('js/jquery.snowfall.js') }}" crossorigin="anonymous"></script>
<script src="{{ mix('js/snowfall.js') }}" crossorigin="anonymous"></script>
</body>

</html>
