<form class="d-flex ml-2" role="search" wire:submit.prevent="search">
    <input wire:model="query" class="form-control px-4" type="search" placeholder="{{__('main.search')}}" aria-label="{{__('main.search')}}">
    <button class="btn btn-outline-success mx-1" type="submit">{{__('main.search')}}</button>
</form>
