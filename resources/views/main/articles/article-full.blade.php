@extends('layouts.app_guest')
@section('content_guest')
    <div class="container">
        <div class="container">
    @livewire('main.articles.article-full',['article_slug' => $article_slug, 'category_slug' => $category_slug, 'categories' => $categories])
        </div>
    </div>
@endsection
