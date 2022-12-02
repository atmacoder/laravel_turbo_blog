@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('main.add_role') }}</div>
        <div class="card-body">
           @livewire('dashboard.roles.add-role')
        </div>
    </div>
@endsection
