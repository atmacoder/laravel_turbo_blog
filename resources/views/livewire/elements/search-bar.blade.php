<form class="d-flex" role="search" wire:submit.prevent="search">
    <input wire:model="query" class="form-control me-2" type="search" placeholder="{{__('main.search')}}" aria-label="{{__('main.search')}}">
    <button class="btn btn-outline-success" type="submit">{{__('main.search')}}</button>
</form>
