@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('main.add_permission') }}</div>
        <div class="card-body">
           @livewire('dashboard.roles.add-permission')
        </div>
    </div>
@endsection
