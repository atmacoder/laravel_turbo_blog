<div>
    @if (session()->has('status'))

        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form wire:submit.prevent="createComment">

        <div wire:loading>
            @include('elements.loader')
        </div>

        <div>
            <label for="InputName">{{__('main.search_article')}}</label>
            <input type="text" class="form-control" wire:model="searchTerm">

            @if($articles)
                <ul class="list-group mt-2 mb-2">
                    @foreach($articles as $article)
                        <li  class="list-group-item">
                            <p role="button" wire:click="setArticle({{$article}})">
                                {{ $article->title }}
                            </p>
                        </li>
                    @endforeach
                </ul>
                {{ $articles->links() }}
            @endif
        </div>
        <div class="form-group">

            <label for="InputName">{{__('main.article')}}</label>
            <input class="form-control" id="disabledInput" type="text" wire:model="article.title" disabled>


        </div>
        <div class="form-group">

            <label for="InputName">{{__('main.comment_name')}}</label>
            <input type="text" class="form-control" id="InputName"  wire:model.lazy="name">

        </div>

        @error('name') <span class="text-danger">{{ $name }}</span> @enderror


        <div class="form-group">

            <label for="InputEmail">{{__('main.email')}}</label>
            <input type="text" class="form-control" id="InputEmail"  wire:model.lazy="email">

        </div>
        @error('email') <span class="text-danger">{{ $email }}</span> @enderror

        <div class="form-group" wire:ignore>

            <label for="description">{{__('main.comment_text')}}</label>

            <textarea name="description" class="form-control" id="CategoryMessage" placeholder="Enter Body" wire:model.lazy.debounce.2500ms="description">

            {!! $description !!}

        </textarea>

        </div>

        @error('description') <span class="text-danger">{{ $message }}</span> @enderror

        <button type="submit" class="btn btn-primary mt-2">{{__('main.comment_new')}}</button>

    </form>
    <script src="https://cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>
    <script>
        const editor = CKEDITOR.replace('description');
        editor.on('change', function(event){
        @this.set('description', event.editor.getData());
        })
    </script>
</div>

<style>
    .leading-5 svg{
        max-height: 25px;
    }
</style>
