<div>
    @if(Count($categories)>0)
    @livewire('elements.delete-category-modal')
    <ul class="list-group">
        <table class="table table-light table-striped table-hover table-responsive">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">name</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
    @foreach($categories as $index => $category)
        @livewire('dashboard.categories.category-item', ['category' => $category], key($index))
    @endforeach
        </tbody>
    </table>
        <div class="mt-2">
    {{ $categories->links() }}
        </div>
        @else
            <span>{{__('main.no_category')}}</span>
            <br />
            <span><a href="/add-сategory"><button class="btn btn-primary mt-2">{{__('main.new_category')}}</button></a></span>
    @endif
</div>
