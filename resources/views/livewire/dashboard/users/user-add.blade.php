<div>
    @if (session()->has('status'))

        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form wire:submit.prevent="addUser">
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
{{--        <div class="form-group">

            <div class="form-check">
                @foreach($permissions as $perm)
                    <div wire:key="{{ $perm->id }}">
                        <input wire:model.defer="rows.{{ $perm->id }}" type="checkbox" />
                        <label>{{$perm->name}}</label>
                    </div>
                @endforeach
            </div>


        </div>

        @error('permissions') <span class="text-danger">{{ $message }}</span> @enderror--}}


        <button type="submit" class="btn btn-primary mt-2">{{__('main.add_user')}}</button>

    </form>
</div>

