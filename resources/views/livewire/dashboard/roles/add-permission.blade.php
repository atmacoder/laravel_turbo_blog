<div>
    @if (session()->has('status'))

        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form wire:submit.prevent="createPermission">
        <div wire:loading>
            @include('elements.loader')
        </div>
{{--        <div class="form-group mt-2">

            <label for="InputCategories">{{__('main.guard_name')}}</label>
            <select class="form-select" aria-label="Default select example" id="InputCategories"  wire:model="guard_name">
                <option selected>{{__('main.guard_name')}}</option>
                @foreach ($roles as $r)
                    <option value="{{$r->id}}">{{$r->name}}</option>
                @endforeach
            </select>
            @error('guard_name') <span class="text-danger">{{ $message }}</span> @enderror

        </div>--}}
        <div class="form-group mt-2">

            <label for="InputCategories">{{__('main.category')}}</label>
            <select class="form-select" aria-label="Default select example" id="InputCategories"  wire:model="category_id">
                <option selected>{{__('main.select_category')}}</option>
                @foreach ($categories as $c)
                    <option value="{{$c->id}}">{{$c->title}}</option>
                @endforeach
            </select>
            @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror

        </div>
        <div class="form-group mt-2">

            <label for="InputCategories">{{__('main.permission_name')}}</label>
            <select class="form-select" aria-label="Default select example" id="InputCategories"  wire:model="permission_name">
                <option selected>{{__('main.select_permission_name')}}</option>
                <option value="view">{{__('main.view')}}</option>
                <option value="create">{{__('main.create')}}</option>
                <option value="edit">{{__('main.edit')}}</option>
                <option value="delete">{{__('main.delete')}}</option>
            </select>
            @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror

        </div>
        <button type="submit" wire:click="createPermission" class="btn btn-primary mt-2">{{__('main.create_permission')}}</button>

    </form>
</div>

