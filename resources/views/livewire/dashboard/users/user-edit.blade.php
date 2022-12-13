<div>
    @if (session()->has('status'))

        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form wire:submit.prevent="updateUser">
        <div wire:loading>
            @include('elements.loader')
        </div>
        <div class="form-group">

            <label for="InputName">{{__('main.user_name')}}</label>

            <input type="text" class="form-control" id="InputName" placeholder="{{__('main.enter_user_name')}}" wire:model.lazy="name">

            @error('name') <span class="text-danger">{{ $message }}</span> @enderror

        </div>

        <div class="form-group">

            <label for="InputEmail">{{__('main.email')}}</label>

            <input type="text" class="form-control" id="InputEmail" placeholder="{{__('main.enter_email')}}" wire:model.lazy="email">

            @error('email') <span class="text-danger">{{ $message }}</span> @enderror

        </div>
        <div class="form-group">

            <label for="InputPassword">{{__('main.password')}}</label>

            <input type="password" class="form-control" id="InputPassword" placeholder="{{__('main.password')}}" wire:model.lazy="password">

            @error('password') <span class="text-danger">{{ $message }}</span> @enderror

        </div>
        <div class="form-group">

            <label for="InputPassword2">{{__('main.password2')}}</label>

            <input type="password" class="form-control" id="InputPassword2" placeholder="{{__('main.password2')}}" wire:model.lazy="password2">

            @error('password2') <span class="text-danger">{{ $message }}</span> @enderror

        </div>
        <div class="form-group">
            <label for="InputRole">{{__('main.role')}}</label>
            <select class="form-select"  wire:model="rolesSelected" id="InputRole">
                @if(!$rolesSelected)
                    <option selected>{{__('main.choose_role')}}</option>
                    @endif
                @foreach($roles as $role)
                <option value="{{$role->id}}">{{$role->name}} </option>
                @endforeach
            </select>

            @error('rolesSelected') <span class="text-danger">{{ $message }}</span> @enderror

        </div>

        <button type="submit" class="btn btn-primary mt-2">{{__('main.update_user')}}</button>

    </form>
</div>

