@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('main.new_category') }}</div>
        <div class="card-body">
           @livewire('dashboard.categories.create-category')
        </div>
    </div>
@endsection
