<div class="menu-container">
    @foreach ($menuItems as $item)
        @if (!$item->is_divider)
            @if ($item->type === 'category-group')
                <div class="dropdown">
                    <button
                        class="btn {{ $settings['data']['class_main_buttons'] }} dropdown-toggle @if(isset($active) && ($active == $item->slug || ($item->category && $active == $item->category->slug) || ($item->article && $active == $item->article->slug))) active @endif"
                        type="button" id="dropdownMenuButton{{ $item->id }}" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        {{ $item->name }}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $item->id }}">
                        @foreach ($item->categories as $category)
                            <a class="dropdown-item @if($category->slug == request()->path()) active @endif"
                               href="{{ url($category->slug) }}"
                               data-current-url="{{ url($category->slug) }}">{{ $category->title }}</a>
                        @endforeach
                    </div>
                </div>
            @elseif ($item->type === 'category')
                <button
                    class="btn {{ $settings['data']['class_main_buttons'] }} @if(isset($active) && $active) active @endif">
                    <a href="{{ url($item->category->slug) }}">{{ $item->name }}</a>
                </button>
            @elseif ($item->type === 'link')
                <button
                    class="btn {{ $settings['data']['class_main_buttons'] }} @if(isset($active) && $active) active @endif"
                    type="button">
                    <a href="{{ $item->url }}">{{ $item->name }}</a>
                </button>
            @elseif ($item->type === 'article-group')
                @if (count($item->articles) === 1)
                    <button
                        class="btn {{ $settings['data']['class_main_buttons'] }} @if(isset($active) && ($active == $item->slug || ($item->category && $active == $item->category->slug) || ($item->article && $active == $item->article->slug))) active @endif"
                        type="button">
                        <a href="{{ url($item->articles->first()->category->slug . '/' . $item->articles->first()->slug) }}">{{ $item->name }}</a>
                    </button>
                @else
                    <div class="dropdown">
                        <button
                            class="btn {{ $settings['data']['class_main_buttons'] }} dropdown-toggle @if(isset($active) && ($active == $item->slug || ($item->category && $active == $item->category->slug) || ($item->article && $active == $item->article->slug))) active @endif"
                            type="button" id="dropdownMenuButton{{ $item->id }}" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            {{ $item->name }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $item->id }}">
                            @foreach ($item->articles as $article)
                                <a class="dropdown-item @if($article->slug == request()->path()) active @endif"
                                   href="{{ url($article->category->slug . '/' . $article->slug) }}"
                                   data-current-url="{{ url($article->category->slug . '/' . $article->slug) }}">{{ $article->title }}</a>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif
        @endif
    @endforeach
    @auth
        <button class="btn {{ $settings['data']['class_main_buttons'] }}">
            <a href="{{ url('/dashboard') }}">
                {{ __('main.dashboard') }}
            </a>
        </button>
    @endauth
</div>
<style>
    .menu-container button.btn a {
        color: {{ $settings['data']['menu_text_color'] }};
    }

    .menu-container button.btn.{{ $settings['data']['class_main_buttons'] }}.active a {
        color: {{ $settings['data']['menu_active_text_color'] }};
    }

    .menu-header {
        margin-top: 4px;
        background: {{ $settings['data']['background_menu'] }};
    }

    .menu-container button.btn.{{ $settings['data']['class_main_buttons'] }} a:hover {
        color: {{ $settings['data']['menu_text_color_hover'] }}

    }
</style>
