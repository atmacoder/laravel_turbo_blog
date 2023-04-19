<div>
    <div class="row">
        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" wire:model="category">
            <option selected>Выберите категорию</option>
            @foreach($categories as $i => $category)
                <option value="{{$category->id}}">{{$category->title}}</option>
            @endforeach

        </select>
    </div>
    <div class="row mb-2">
        <a href="/add-article" target="_self" style="text-align: right"> <button class="btn btn-primary">Создать материал</button></a>
    </div>
    <div wire:loading>
        @include('elements.loader')
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
                {{ $articles->links() }}
            </div>
            @else
                <span>{{__('main.no_articles')}}</span>
                <br />
                <span><a href="/add-article"><button class="btn btn-primary mt-2">{{__('main.new_article')}}</button></a></span>
    @endif
</div>
