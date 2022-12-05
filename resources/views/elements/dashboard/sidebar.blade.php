<div class="card">
        <div class="card-header">{{ __('main.menu') }}</div>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="/articles">{{ __('main.articles') }}</a>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                    <li> <a class="nav-link" href="/add-article">{{ __('main.new_article') }}</a></li>
                    <li><a class="nav-link" href="/articles">{{ __('main.articles_list') }}</a></li>

                </ul>

            </li>
            <li class="nav-item">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="/сategories">{{ __('main.categories') }}</a>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                    <li> <a class="nav-link" href="/add-сategory">{{ __('main.new_category') }}</a></li>
                    <li> <a class="nav-link" href="/сategories">{{ __('main.categories_list') }}</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="/images">{{ __('main.roles') }}</a>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                    <li> <a class="nav-link" href="/add-role">Создать</a></li>
                    <li> <a class="nav-link" href="/roles">Список ролей</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="/images">{{ __('main.permission') }}</a>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                    <li> <a class="nav-link" href="/add-permission">Создать</a></li>
                    <li> <a class="nav-link" href="/permissions">Список прав</a></li>
                </ul>
            </li>
        </ul>
</div>

