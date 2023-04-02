<div class="card">
        <div class="card-header">{{ __('main.menu') }}</div>

        <ul class="nav flex-column admin-menu">
            @can('view_articles')
            <li class="nav-item">
                <span class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">{{ __('main.articles') }}</span>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                    <li> <a class="nav-link" href="/add-article">{{ __('main.new_article') }}</a></li>
                    <li><a class="nav-link" href="/articles">{{ __('main.articles_list') }}</a></li>
                    <li> <a class="nav-link" href="/articles-meta">{{ __('main.metadata_list') }}</a></li>
                </ul>

            </li>
            @endcan
                @can('view_extend_article')
                    <li class="nav-item">
                        <span class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">{{ __('main.extend_articles') }}</span>
                        <ul class="dropdown-menu dropdown-menu-lg-end">
                            <li> <a class="nav-link" href="/extend-article-add">{{ __('main.extend_article_add') }}</a></li>
                            <li><a class="nav-link" href="/extend-article-list">{{ __('main.extend_article_list') }}</a></li>
                        </ul>
                    </li>
                @endcan
            @can('view_categories')
            <li class="nav-item">
                <span class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">{{ __('main.categories') }}</span>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                    <li> <a class="nav-link" href="/add-сategory">{{ __('main.new_category') }}</a></li>
                    <li> <a class="nav-link" href="/сategories">{{ __('main.categories_list') }}</a></li>
                </ul>
            </li>
            @endcan
            @can('view_roles')
            <li class="nav-item">
                <span class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">{{ __('main.roles') }}</span>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                    <li> <a class="nav-link" href="/add-role">{{ __('main.add_role') }}</a></li>
                    <li> <a class="nav-link" href="/roles">{{ __('main.roles_list') }}</a></li>
                </ul>
            </li>
            @endcan
            @can('view_permissions')
            <li class="nav-item">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">{{ __('main.permission') }}</a>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                    <li> <a class="nav-link" href="/add-permission">{{ __('main.add_permission') }}</a></li>
                    <li> <a class="nav-link" href="/permissions">{{ __('main.permissions_list') }}</a></li>
                </ul>
            </li>
            @endcan
            @can('view_users')
            <li class="nav-item">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">{{ __('main.users') }}</a>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                    <li> <a class="nav-link" href="/add-user">{{ __('main.add_user') }}</a></li>
                    <li> <a class="nav-link" href="/users">{{ __('main.users_list') }}</a></li>
                </ul>
            </li>
            @endcan
        </ul>
</div>

<style>
    .admin-menu li{
        min-width: 200px;
    }
</style>
