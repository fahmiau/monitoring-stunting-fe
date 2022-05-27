<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <script src="{!! mix('js/app.js') !!}"></script>

        <title>Laravel</title>
        <link rel="shortcut icon" href="{{ asset('img/icons/cegah_stunting_logo.png') }}" type="image/x-icon">
        {{-- <link rel="icon" href="{{ asset('img/icons/cegah_stunting_logo.png') }}" type="image/x-icon"> --}}

        <!-- Fonts -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">

        <!-- Styles -->
        <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet"> <!--Totally optional :) -->
        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js" integrity="sha256-xKeoJ50pzbUGkpQxDYHD7o7hxe0LaOGeguUidbq6vis=" crossorigin="anonymous"></script> --}}
        
    </head>
    <body  class="bg-secondary font-sans leading-normal tracking-normal mt-12">
        
    @include('partials.nav')
    <div class="main-content flex-1 bg-primary mt-12 md:mt-2 pb-24 md:pb-5">
        @yield('container')
    </div>
    </body>
</html>