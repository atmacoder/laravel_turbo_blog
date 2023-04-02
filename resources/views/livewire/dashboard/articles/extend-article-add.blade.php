<div>
    @if (session()->has('status'))

        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form wire:submit.prevent="createExtendArticle">

        <div wire:loading>
            @include('elements.loader')
        </div>

        <div class="form-group">

            <label for="InputTitle">{{__('main.name')}}</label>

            <input type="text" class="form-control" id="InputTitle" placeholder="{{__('main.enter_extend_article_name')}}" wire:model.lazy="name">

            @error('name') <span class="text-danger">{{ $message }}</span> @enderror

        </div>

        <div class="form-group">

            <label for="InputTitle">{{__('main.extend_default_value')}}</label>

            <input type="text" class="form-control" id="InputTitle" placeholder="{{__('main.enter_extend_default_value')}}" wire:model.lazy="value">

            @error('value') <span class="text-danger">{{ $message }}</span> @enderror

        </div>

        <div class="form-group mt-2">

            <label for="InputType">{{__('main.extend_type_select')}}</label>

           <select class="form-select" aria-label="Select type" id="InputType"  wire:model="type">

                <option selected>{{__('main.extend_type_selected')}}</option>

                @foreach ($types as $c)

                    <option value="{{$c['name']}}">{{$c['name']}}</option>

                @endforeach

            </select>

            @error('type') <span class="text-danger">{{ $message }}</span> @enderror

        </div>

        <button type="submit" class="btn btn-primary mt-2">{{__('main.create_extend_article')}}</button>
        
    </form>
</div>
