<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="{!! mix('js/app.js') !!}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            const api_url = "http://127.0.0.1:1000/api/";
            const local_url = "http://127.0.0.1:8001"
        </script>
        <title>Cegah Stunting - @yield('title')</title>
        <link rel="shortcut icon" href="{{ asset('img/icons/logo_kecil.png') }}" type="image/x-icon">
        {{-- <link rel="icon" href="{{ asset('img/icons/cegah_stunting_logo.png') }}" type="image/x-icon"> --}}

        <!-- Fonts -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">

        <!-- Styles -->
        <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet"> <!--Totally optional :) -->
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js" integrity="sha256-xKeoJ50pzbUGkpQxDYHD7o7hxe0LaOGeguUidbq6vis=" crossorigin="anonymous"></script> --}}
        
    </head>
    <body
        @if (Session::has('notification'))
            data-notification-type="{{ Session::get('notification')['type'] }}"
            data-notification-message="{{ Session::get('notification')['message'] }}"
        @endif
        class="bg-secondary font-sans leading-normal tracking-normal mt-12">
        
    @include('partials.nav')
    <div class="main-content flex-1 bg-primary mt-12 md:mt-2 pb-24 md:pb-5">
        @yield('container')
    </div>
    </body>
    <script defer>
        var notification = document.body.dataset;
        if (document.body.dataset.notificationType) {
            Swal.fire(notification.notificationMessage,'',notification.notificationType)
        }
    </script>
</html>