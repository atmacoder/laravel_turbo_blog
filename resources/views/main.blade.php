@extends('layouts.app_guest')
@section('content_guest')
<div class="card">
<div class="card-header">{{ __('main.welcome') }}</div>
<div class="card-body">
@livewire('main.index', ['articles' => $articles])
</div>
</div>
@endsection
