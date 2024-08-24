<div>
    @if (!$editing)
        <div class="mb-4">
            <h4 class="mb-2">Создать пункт меню</h4>
            <form wire:submit.prevent="save">
                <div class="form-group">
                    <label for="name">Название</label>
                    <input type="text" class="form-control" id="name" wire:model.defer="name">
                </div>
                <div class="form-group">
                    <label for="type">Тип</label>
                    <select class="form-control" id="type" wire:model.defer="type">
                        <option value="link">Ссылка</option>
                        <option value="divider">Разделитель</option>
                        <option value="category">Категория</option>
                        <option value="category-group">Группа категорий</option>
                        <option value="article-group">Группа статей</option>
                    </select>
                </div>
                <div class="form-group" wire:if="type === 'category-group'">
                    <label for="category_ids">Категории</label>
                    <select class="form-control" id="category_ids" wire:model.defer="category_ids" multiple>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @if (in_array($category->id, $category_ids)) selected @endif>{{ $category->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" wire:if="type === 'article-group'">
                    <label for="article_ids">Статьи</label>
                    <select class="form-control" id="article_ids" wire:model.defer="article_ids" multiple>
                        @foreach ($articles as $article)
                            <option value="{{ $article->id }}" @if (in_array($article->id, $article_ids)) selected @endif>{{ $article->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group" wire:if="type === 'link'">
                    <label for="url">URL</label>
                    <input type="text" class="form-control" id="url" wire:model.defer="url">
                </div>
                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="save">
                    Создать
                </button>
            </form>
        </div>
    @endif

    <div class="mt-4">
        <h4 class="mb-2">Созданные пункты меню</h4>
        <ul class="list-group">
            @foreach ($menuItems as $menuItem)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $menuItem->name }}
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary btn-sm" wire:click="edit({{ $menuItem->id }})">Редактировать</button>
                        <button type="button" class="btn btn-danger btn-sm" wire:click="delete({{ $menuItem->id }})">Удалить</button>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    @if ($editing)
        <div class="mt-4">
            <h4 class="mb-2">Редактирование пункта меню</h4>
            <livewire:dashboard.menu-item-form :menuItem="$menuItem" :categories="$categories" :articles="$articles" :menuItems="$menuItems" wire:key="menuItem-form" />
        </div>
    @endif
</div>
