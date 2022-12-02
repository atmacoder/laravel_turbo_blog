<div>
    @if(Count($roles)>0)
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
                @foreach($roles as $index => $role)
                    @livewire('dashboard.roles.role-item', ['role' => $role], key($index))
                @endforeach
                </tbody>
            </table>
            <div class="mt-2">
                {{ $roles->links() }}
            </div>
            @else
                <span>{{__('main.no_roles')}}</span>
                <br />
                <span><a href="/add-role"><button class="btn btn-primary mt-2">{{__('main.new_role')}}</button></a></span>
    @endif
</div>
