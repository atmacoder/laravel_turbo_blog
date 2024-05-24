<div>
    <div class="row">
        <div class="col-md-6">
        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" wire:model="category">
            <option selected>Выберите категорию</option>
            @foreach($categories as $i => $category)
                <option value="{{$category->id}}">{{$category->title}}</option>
            @endforeach

        </select>
    </div>
        <div class="col-md-4">
            <a href="/add-article" target="_self" style="text-align: right"> <button class="btn btn-primary">Создать материал</button></a>
        </div>
        <div class="col-md-2">
            <label for="page-limit">Количество:</label>
            <select class="form-select"  id="page-limit" wire:model="selectedLimit">
                @foreach ($limits as $limit)
                    <option value="{{ $limit }}">{{ $limit }}</option>
                @endforeach
            </select>
    </div>
    </div>
    <div wire:loading>
        @include('elements.loader')
    </div>
    <div class="row">
        <div class="mt-2 mb-2">
            @if($articles && $articles->links())
                {{ $articles->links() }}
            @endif
        </div>
    </div>
    @if($articles)
        @livewire('elements.delete-article-modal')
        <ul class="list-group">
            <table class="table table-light table-striped table-hover table-responsive">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">{{__('main.image')}}</th>
                    <th scope="col">{{__('main.title')}}</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($articles as $index => $article)
                    @livewire('dashboard.articles.article-item', ['article' => $article], key($index))
                @endforeach
                </tbody>
            </table>
            <div class="mt-2">
                @if($articles && $articles->links())
                    {{ $articles->links() }}
                @endif
            </div>
            @else
                <span>{{__('main.no_articles')}}</span>
                <br />
                <span><a href="/add-article"><button class="btn btn-primary mt-2">{{__('main.new_article')}}</button></a></span>
    @endif
            <div class="row mb-2">
                <a href="/add-article" target="_self" style="text-align: right"> <button class="btn btn-primary">Создать материал</button></a>
            </div>
</div>
<style>
    @media (max-width: 575px) {
        .pagination {
            display: flex;
            justify-content: flex-start;
            width: fit-content;
        }
    }
    .pagination-left {
        display: flex;
        justify-content: flex-start;
        width: fit-content;
    }
  ul.list-group{
      overflow:scroll;
  }
    /* The switch - the box around the slider */
    .switch {
        font-size: 17px;
        position: relative;
        display: inline-block;
        width: 3.5em;
        height: 2em;
    }

    /* Hide default HTML checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        inset: 0;
        border: 2px solid #414141;
        border-radius: 50px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 1.4em;
        width: 1.4em;
        left: 0.2em;
        bottom: 0.2em;
        background-color: #b48d56;
        border-radius: inherit;
        transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
    }

    .switch input:checked + .slider {
        box-shadow: 0 0 10px rgba(180, 141, 86, 0.8);
        border: 2px solid #b48d56;
    }

    .switch input:checked + .slider:before {
        transform: translateX(1.5em);
    }
    .leading-5 svg{
        max-height: 25px;
    }
</style>
