@extends('layouts.app')
@section('content')
<div class="card">
<div class="card-header">{{ __('main.dashboard.comments.comment-list') }}</div>
<div class="card-body">
@livewire('dashboard.comments.comment-list')
</div>
</div>
@endsection