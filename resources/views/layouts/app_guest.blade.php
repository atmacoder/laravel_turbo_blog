<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {!! SEO::generate() !!}

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="icon" href="{{ asset('storage/favicon.ico') }}" type="image/x-icon">

{{--    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js"
            data-turbolinks-track="reload"></script>
    <script src="https://cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>--}}
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @livewireStyles

</head>
<body>
<div id="app">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4">
                @include('elements.header_guest')
            </div>
            <div class="col-md-12">
                @yield('content_guest',)
            </div>
            <div class="col-md-12 mb-4">
                @include('elements.footer')
            </div>
        </div>
        @livewireScripts
        <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js"
                data-turbolinks-eval="false" data-turbo-eval="false"></script>
    </div>
</div>
</body>
</html>
