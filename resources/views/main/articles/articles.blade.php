@extends('layouts.app_guest')
@section('content_guest')
    <div class="card">
        <div class="card-header">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Главная</a></li>
                    <li class="breadcrumb-item"><a href="{{url($category->slug)}}">{{ $category->title}}</a></li>
                </ol>
            </nav>
        </div>
        <div class="card-body">
            @livewire('main.articles.articles', ['articles' => $articles, 'categories' => $categories, 'category' =>
            $category])
        </div>
    </div>
@endsection
