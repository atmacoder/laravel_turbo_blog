@if($articles)
    <div class="container">
        <div class="row mt-n5 mb-2">
            @foreach($articles as $index => $article)
                @livewire('main.articles.article', ['article' => $article, 'article_slug' => $article->slug,
                'category_slug' => $article->category->slug, 'comments' => $article->comments], key($index))
            @endforeach
        </div>
        @auth
            <div class="card-footer mt-n5">
            <button class="btn btn-primary"><a class="text-white" href="/add-article">{{ __('main.add_article') }}</a></button>
            </div>
        @endauth
    </div>
@endif


