@extends('layouts.app')
@section('content')
<div class="card">
<div class="card-header">{{ __('main.no_permission') }}</div>
<div class="card-body">
    {{ __('main.dashboard.permissions.no_permission') }}
</div>
</div>
@endsection
