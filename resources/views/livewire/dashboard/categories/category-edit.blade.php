<div>
    @if (session()->has('status'))

        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form wire:submit.prevent="updateCategory">
        <div wire:loading>
            @include('livewire.elements.loader')
        </div>
        <div class="form-group">

            <label for="InputName">{{__('main.category_title')}}</label>

            <input type="text" class="form-control" id="InputName" placeholder="{{__('main.enter_name')}}" wire:model.lazy="title">

            @error('name') <span class="text-danger">{{ $message }}</span> @enderror

        </div>

        <div class="form-group">

            <label for="InputSlug">{{__('main.alias')}}</label>

            <input type="text" class="form-control" id="InputSlug"  wire:model="slug">

            @error('slug') <span class="text-danger">{{ $message }}</span> @enderror

        </div>
        <div class="form-group mt-2">

            <label for="InputCategories">{{__('main.subcategory')}}</label>
            <select class="form-select" aria-label="Default select example" id="InputCategories"  wire:model="category_id">
                <option selected>{{__('main.select_subcategory')}}</option>
                @foreach ($categories as $c)
                    <option value="{{$c->id}}">{{$c->title}}</option>
                @endforeach
            </select>
            @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror

        </div>
        <div class="form-group" wire:ignore>

            <label for="description">{{__('main.description')}}</label>

            <textarea name="description" class="form-control" id="CategoryMessage" placeholder="Enter Body" wire:model.lazy="description">
            {!! $description !!}
        </textarea>

            @error('description') <span class="text-danger">{{ $message }}</span> @enderror

        </div>

        <div class="form-group">

            <label for="InputMetaDesc">{{__('main.meta_desc')}}</label>
            <input type="text" class="form-control" id="InputMetaDesc"  wire:model.lazy="metadesc">

        </div>

        <div class="form-group">

            <label for="InputMetaKeys">{{__('main.meta_keys')}}</label>
            <input type="text" class="form-control" id="InputMetaKeys"  wire:model.lazy="metakeys">

        </div>

        <button type="submit" class="btn btn-primary mt-2">{{__('main.update_category')}}</button>

    </form>
    <script src="https://cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>
    <script>
        const editor = CKEDITOR.replace('description');
        editor.on('change', function(event){
            console.log(event.editor.getData())
        @this.set('description', event.editor.getData());
        })
    </script>
</div>

