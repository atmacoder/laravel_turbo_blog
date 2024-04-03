@extends('layouts_guest.app')
@section('content_guest')
<div class="card">
<div class="card-header">{{ __('main.main.articles.article') }}</div>
<div class="card-body">
@livewire('main.articles.article',['article_slug' => $article_slug, 'category_slug' => $category_slug, 'categories' => $categories])

</div>
</div>
@endsection
