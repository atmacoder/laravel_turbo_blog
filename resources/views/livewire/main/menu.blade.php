<div class="menu-container">
    @foreach ($menuItems as $item)

        @if (!$item->is_divider)
            @if ($item->categories->count() > 0)
                <div class="dropdown">
                    <button
                        class="btn {{ $settings['data']['class_main_buttons'] }} dropdown-toggle @if(isset($active) && $active) active @endif"
                        type="button" id="dropdownMenuButton{{ $item->id }}" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        {{ $item->name }}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $item->id }}">
                        @foreach ($item->categories as $category)
                            <a class="dropdown-item @if($category->slug == request()->path()) active @endif"
                               href="{{ (string) url($category->slug) }}"
                               data-current-url="{{ (string) url($category->slug) }}">{{ $category->title }}</a>
                        @endforeach
                    </div>
                </div>
            @elseif ($item->type === 'category')
                <button
                    class="btn {{ $settings['data']['class_main_buttons'] }} @if(isset($active) && $active) active @endif">
                    <a href="{{ url($item->category->slug) }}">{{ $item->name }}</a>
                </button>
            @else
                <button
                    class="menu-button bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded @if(isset($active) && $active) active @endif"
                    type="button">
                    {{ $item->name }}
                </button>
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
