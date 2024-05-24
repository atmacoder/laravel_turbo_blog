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
<div id="app" style="width: 100%;">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 p-0">
                @include('elements.header_guest')
            </div>
        </div>
    </div>

        <div class="row menu-header mb-4">
            <div class="menu-container">
                <nav class="navbar navbar-expand-lg mx-auto">
                    <div class="container-fluid">
                        <a class="navbar-brand d-md-none" href="/">Антиквариат меню</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            @livewire('main.menu')
                        </div>
                    </div>
                </nav>

            </div>
			</div>

    <div class="container-fluid">
                @yield('content_guest')
    </div>

    <div class="container-fluid footer-main p-0 mt-4">

                @include('elements.footer_guest')

    </div>

    @livewireScripts
</div>
</body>
</html>
