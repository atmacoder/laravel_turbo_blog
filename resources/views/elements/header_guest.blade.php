<nav class="navbar navbar-expand-lg">
    <div class="container-fluid border p-2 rounded-3 header">
        <a class="navbar-brand ms-4" href="/" data-turbo-method="main">
            @if($settings['data']['show_img_logo'] == 1)
                <img id="logo" src="{{ asset('/storage/') . '/' . $settings['logo'] }}" class="rounded img-thumbnail mb-3" style="height: 80px;">
            @endif

            @if($settings['data']['show_logo_text'] == 1)
                <small>{{ $settings['name'] }}</small>
            @endif
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            @if(isset($categories))
            <ul class="navbar-nav">

                    @foreach($categories as $menu)

                        <li class="nav-item dropdown">
                            @if($menu->id != 1)
                            <a class="nav-link"  href="/{{$menu->slug}}" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{$menu->title}}
                            </a>
                            @else
                                <a class="nav-link"  href="/" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ __('main.main') }}
                                </a>
                        </li>
                            @endif
                    @endforeach

            </ul>
            @endif
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/" data-turbo-method="main">{{ __('main.main') }}</a>
                            <a class="dropdown-item" href="/dashboard">{{ __('main.dashboard') }}</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                        </a>
                    </li>
                @endguest
            </ul>
                @livewire('elements.search-bar')
        </div>
    </div>
</nav>
