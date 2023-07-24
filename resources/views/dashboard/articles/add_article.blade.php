@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('main.add_article') }}</div>

        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
          @livewire('dashboard.articles.article-create')
        </div>
    </div>

@endsection
