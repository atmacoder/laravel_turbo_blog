<div>
    <div wire:loading>
        @include('elements.loader')
    </div>
    @if($articles)
        @foreach($articles as $i => $article)
                <div class="card p-4 mt-4">
            <div class="row">
                <h4 class="mt-4">{{$article->title}}</h4>
                <hr />
                <div class="col">
                    <label>{{strlen($article->meta_description)}} / 190</label>
                    <input type="text" class="form-control" value="{{$article->meta_description}}" wire:model.debounce.2s="newArticles.{{$i}}.meta_description">
                </div>
                <div class="col">
                    <label>{{count(explode(",", $article->meta_keywords))}} / 5</label>
                    <input type="text" class="form-control" value="{{$article->meta_keywords}}" wire:model.debounce.2s="newArticles.{{$i}}.meta_keywords" >
                </div>
            </div>
                </div>
        @endforeach
        <div class="mt-2">
            {{ $articles->links() }}
        </div>
    @endif
</div>
