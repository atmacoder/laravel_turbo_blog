<div class="card">
    <div class="card-header">{{ __('main.menu') }}</div>

    <ul class="nav flex-column admin-menu">
        @can('view_articles')
            <li class="nav-item">
                <span class="menu-link dropdown-toggle" data-bs-toggle="dropdown" href="#">{{ __('main.articles') }}</span>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                    <li> <a class="menu-link" href="/add-article">{{ __('main.new_article') }}</a></li>
                    <li><a class="menu-link" href="/articles">{{ __('main.articles_list') }}</a></li>
                    <li> <a class="menu-link" href="/articles-meta">{{ __('main.metadata_list') }}</a></li>
                </ul>

            </li>
        @endcan
        @can('view_extend_article')
            <li class="nav-item">
                <span class="menu-link dropdown-toggle" data-bs-toggle="dropdown" href="#">{{ __('main.extend_articles') }}</span>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                    <li> <a class="menu-link" href="/extend-article-add">{{ __('main.extend_article_add') }}</a></li>
                    <li><a class="menu-link" href="/extend-article-list">{{ __('main.extend_article_list') }}</a></li>
                </ul>
            </li>
        @endcan
        @can('view_categories')
            <li class="nav-item">
                <span class="menu-link dropdown-toggle" data-bs-toggle="dropdown" href="#">{{ __('main.categories') }}</span>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                    <li> <a class="menu-link" href="/add-сategory">{{ __('main.new_category') }}</a></li>
                    <li> <a class="menu-link" href="/сategories">{{ __('main.categories_list') }}</a></li>
                </ul>
            </li>
        @endcan
        @can('view_roles')
            <li class="nav-item">
                <span class="menu-link dropdown-toggle" data-bs-toggle="dropdown" href="#">{{ __('main.roles') }}</span>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                    <li> <a class="menu-link" href="/add-role">{{ __('main.add_role') }}</a></li>
                    <li> <a class="menu-link" href="/roles">{{ __('main.roles_list') }}</a></li>
                </ul>
            </li>
        @endcan
        @can('view_permissions')
            <li class="nav-item">
                <span class="menu-link dropdown-toggle" data-bs-toggle="dropdown" href="#">{{ __('main.permissions') }}</span>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                    <li> <a class="menu-link" href="/add-permission">{{ __('main.add_permission') }}</a></li>
                    <li> <a class="menu-link" href="/permissions">{{ __('main.permissions_list') }}</a></li>
                </ul>
            </li>
        @endcan
        @can('view_users')
            <li class="nav-item">
                <span class="menu-link dropdown-toggle" data-bs-toggle="dropdown" href="#">{{ __('main.users') }}</span>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                    <li> <a class="menu-link" href="/add-user">{{ __('main.add_user') }}</a></li>
                    <li> <a class="menu-link" href="/users">{{ __('main.users_list') }}</a></li>
                    <li> <a class="menu-link" href="/user-api">{{ __('main.user_api') }}</a></li>
                </ul>
            </li>
        @endcan
        @can('view_comments')
            <li class="nav-item">
                <span class="menu-link dropdown-toggle" data-bs-toggle="dropdown" href="#">{{ __('main.comments') }}</span>
                <ul class="dropdown-menu dropdown-menu-lg-end">
                    <li> <a class="menu-link" href="/add-comment">{{ __('main.comment_new') }}</a></li>
                    <li> <a class="menu-link" href="/comments">{{ __('main.comments') }}</a></li>
                </ul>
            </li>
        @endcan
        <li class="nav-item">
            <a class="menu-link-alone" href="/settings">{{ __('main.site_settings') }}</a>
        </li>
    </ul>
</div>

<style>
    .admin-menu li{
        min-width: 200px;
    }
</style>
