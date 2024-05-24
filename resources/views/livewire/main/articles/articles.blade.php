@if($articles)
    <div class="container-fluid">
        <div class="card-deck" style="text-align: center; margin: 0px auto;">
        <div class="row mt-n5 mb-2">
            <div class="col-md-10">
                @if($articles && $articles->links())
                    {{ $articles->links() }}
                @endif

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
        <div class="row mt-n5 mb-2">
            @foreach($articles as $index => $article)
                @livewire('main.articles.article', ['article' => $article, 'article_slug' => $article->slug,
                'category_slug' => $article->category->slug, 'comments' => $article->comments], key($index))
            @endforeach
        </div>
        <div class="card-footer mt-n5">
            <div class="row mt-n5 mb-2">
                <div class="col-md-10">
                    @if($articles && $articles->links())
                        {{ $articles->links() }}
                    @endif
                    @auth

                        <button class="btn btn-primary mt-2"><a class="text-white" href="/add-article">{{ __('main.add_article') }}</a></button>

                    @endauth
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
    </div>
    </div>
@endif