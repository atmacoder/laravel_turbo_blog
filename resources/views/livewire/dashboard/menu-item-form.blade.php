<div>
    <form wire:submit.prevent="update">
        <div class="form-group">
            <label for="name">Название</label>
            <input type="text" class="form-control" id="name" wire:model.defer="name">
        </div>

        <div class="form-group">
            <label for="type">Тип</label>
            <select class="form-control" id="type" wire:model.defer="type" disabled>
                <option value="link">Ссылка</option>
                <option value="divider">Разделитель</option>
                <option value="category">Категория</option>
                <option value="category-group" @if($type === 'category-group') selected @endif>Группа категорий</option>
                <option value="article-group" @if($type === 'article-group') selected @endif>Группа статей</option>
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

        <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" wire:target="update">
            Обновить
        </button>
    </form>

    <button type="button" class="btn btn-danger" wire:click="delete">Удалить</button>
</div>
