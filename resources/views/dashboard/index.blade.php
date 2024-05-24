@extends('layouts.app', ['settings' => $settings])

@section('content')
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                         {{ __('main.welcome') }}
								<div class="form-group mt-4" wire:ignore>
                                @livewire('elements.chat-bot')
                                 </div>
                </div>
            </div>
@endsection
