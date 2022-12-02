<div>
@if (session()->has('status'))

    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<form wire:submit.prevent="createRole">
    <div wire:loading>
        @include('elements.loader')
    </div>
    <div class="form-group">

        <label for="InputName">{{__('main.name')}}</label>

        <input type="text" class="form-control" id="InputName" placeholder="{{__('main.enter_name')}}" wire:model.lazy="name">

        @error('name') <span class="text-danger">{{ $message }}</span> @enderror

    </div>

    <button type="submit" class="btn btn-primary mt-2">{{__('main.add_role')}}</button>

</form>
</div>

