@extends('layouts_guest.app')
@section('content_guest')

@livewire('main.articles.article',['article_slug' => $article_slug, 'category_slug' => $category_slug, 'categories' => $categories])


@endsection
