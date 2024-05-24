
@extends('layouts.app_guest')
@section('content_guest')
    <div class="container">
    <div class="card">
        <div class="card-header">{{ __('main.search') }}</div>
        <div class="card-body">
            <div class="row">
                <nav class="navbar navbar-expand-lg">
                    @livewire('elements.search-bar')
                </nav>
            </div>
            <div class="row mt-n5 mb-2">
            @if($articles)
                @foreach($articles as $index => $article)
                    <div class="col-md-4">
                    @livewire('main.articles.article', ['article' => $article, 'article_slug' => $article->slug,
                    'category_slug' => $article->category->slug], key($index))
                    </div>
                @endforeach
                {{ $articles->links() }}
            @else
                    {{__('main.search_article_not_founded')}}
                @endif
        </div>
        </div>
    </div>
    </div>
@endsection
