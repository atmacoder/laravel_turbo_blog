@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('main.comment_new') }}</div>
        <div class="card-body">
            @livewire('dashboard.comments.create-comment')
        </div>
    </div>
@endsection
