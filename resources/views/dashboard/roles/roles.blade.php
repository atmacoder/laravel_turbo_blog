@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('main.roles_list') }}</div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            @livewire('dashboard.roles.roles-list')
        </div>
    </div>
@endsection
