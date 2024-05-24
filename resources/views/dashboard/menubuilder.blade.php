@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">{{ __('main.dashboard.elements.menu_builder') }}</div>
        <div class="card-body">
            @livewire('dashboard.menubuilder')
        </div>
    </div>
@endsection
