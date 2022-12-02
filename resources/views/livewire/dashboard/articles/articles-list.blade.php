<div>
        @if(Count($articles)>0)
        @livewire('elements.delete-article-modal')
    <ul class="list-group">
        <table class="table table-light table-striped table-hover table-responsive">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">{{__('main.image')}}</th>
                <th scope="col">{{__('main.title')}}</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($articles as $index => $article)
                @livewire('dashboard.articles.article-item', ['article' => $article], key($index))
            @endforeach
            </tbody>
        </table>
        <div class="mt-2">
        {{ $articles->links() }}
        </div>
    @else
            <span>{{__('main.no_articles')}}</span>
        <br />
            <span><a href="/add-article"><button class="btn btn-primary mt-2">{{__('main.new_article')}}</button></a></span>
    @endif
</div>
