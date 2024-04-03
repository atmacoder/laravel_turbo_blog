@extends('layouts.app')
@section('content')
<div class="card">
<div class="card-header">{{ __('main.dashboard.elements.SearchBar') }}</div>
<div class="card-body">
@livewire('dashboard.elements.SearchBar')
</div>
</div>
@endsection