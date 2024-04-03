<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $settings['name']}}</title>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js"
            data-turbolinks-track="reload"></script>
    <script src="https://cdn.ckeditor.com/4.20.1/full/ckeditor.js"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>
<div id="app">
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-4">
                @include('elements.header')
            </div>
            @auth
                <div class="col-md-2">
                    @include('elements.dashboard.sidebar')
                    <div wire:loading.delay>
                        @include('elements.loader')
                    </div>
                </div>
            @endauth
            <div class="col-md-10">
                @yield('content',)
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
<style>
    .card-header {
        background: {{ $settings['data']['background_card_header']}};
    }

    .header {
        background: {{$settings['data']['background_header']}};
    }
    .footer {
        background: {{$settings['data']['background_footer']}};
    }
    h1{
        color: {{$settings['data']['h1_color']}};
    }
    .admin-menu li,
    .admin-menu li menu-link,
    .admin-menu li.menu-item span,
    .admin-menu li menu-link a,
    .admin-menu li.nav-item a.menu-link
    {
        color: {{$settings['data']['menu_link_color']}};
        display: block;
        padding: var(--bs-nav-link-padding-y) var(--bs-nav-link-padding-x);
        font-size: var(--bs-nav-link-font-size);
        font-weight: var(--bs-nav-link-font-weight);
        text-decoration: none;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
    }
    .admin-menu li.nav-item a.menu-link-alone{
        color: {{$settings['data']['menu_link_color']}};
        text-decoration: none;
    }
    .admin-menu li.nav-item a.menu-link-alone:hover,
    .admin-menu li:hover,
    .admin-menu li.menu-item span:hover,
    .admin-menu li.nav-item a.menu-link:hover,
    .admin-menu li menu-link a:hover
    {
        color: {{$settings['data']['menu_hover_link_color']}};
        text-decoration: none;
    }
    a:link{
        color: {{$settings['data']['links_color']}};
    }
</style>
