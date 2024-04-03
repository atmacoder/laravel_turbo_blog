
@extends('layouts.app_guest')
@section('content_guest')

    <div class="card">
        <div class="card-header">{{ __('main.search') }}</div>
        <div class="card-body">
            <div class="row mt-n5 mb-2">
            @if($articles)
                @foreach($articles as $index => $article)
                    @livewire('main.articles.article', ['article' => $article, 'article_slug' => $article->slug,
                    'category_slug' => $article->category->slug], key($index))
                @endforeach

                {{ $articles->links() }}
            @endif
        </div>
        </div>
    </div>
@endsection
