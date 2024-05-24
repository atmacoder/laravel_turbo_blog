<div>
    <form wire:submit.prevent="update">
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
            </select>
        </div>

        <div class="form-group" wire:if="type === 'category-group'">
            <label for="category_ids">Категории</label>
            <select class="form-control" id="category_ids" wire:model.defer="category_ids" multiple>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>

    <button type="button" class="btn btn-danger" wire:click="delete">Удалить</button>
</div>
