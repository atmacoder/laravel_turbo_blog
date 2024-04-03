@extends('layouts.app_guest')
@section('content_guest')
<div class="card">
<div class="card-header">{{$category->title}}</div>
<div class="card-body">
@livewire('main.articles.articles', ['articles' => $articles, 'categories' => $categories, 'category' => $category])
</div>
</div>
@endsection
