@extends('layouts.app_guest')
@section('content_guest')
    <div class="card">
        <div class="card-header">{{ __('main.welcome') }}</div>
        <div class="card-body">
            @if($isHomePag)
                @if($categories)
                    <div class="row text-center">
                        @foreach($categories as $category)
                            <div class="col-md-3" class="category-list-item">
                                <a href="/{{$category->slug}}" title="{{$category->title}}">
                                    <h3 class="category-title">{{$category->title}}</h3>

                                        <div class="mx-auto" style="background-image: url({{ strpos($category->image_url, 'storage') !== false ? $category->image_url : '/storage'.$category->image_url }}); background-size: cover; height: 240px; width: 240px;">

                                        </div>
                                        <div class="category-description mt-2"> {!!$category->description!!}</div>
                                </p>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
            @else
                @livewire('main.index', ['articles' => $articles])
            @endif
        </div>
    </div>
@endsection
