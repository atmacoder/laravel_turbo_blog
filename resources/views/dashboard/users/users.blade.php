@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('main.users') }}</div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
                @can('view_users')
            @livewire('dashboard.users.users-list')
                @endcan
        </div>
    </div>
@endsection
