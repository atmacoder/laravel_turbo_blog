@extends('layouts.app')
@section('content')
<div class="card">
<div class="card-header">{{ __('main.dashboard.site-settings') }}</div>
<div class="card-body">
@livewire('dashboard.site-settings')
</div>
</div>
@endsection
