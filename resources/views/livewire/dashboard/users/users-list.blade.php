<div>
    @if($users)
        @livewire('elements.delete-user-modal')
        <ul class="list-group">
            <table class="table table-light table-striped table-hover table-responsive">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">{{__('main.name')}}</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $index => $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>
                            {{$user->name}}
                                @foreach($user->roles as $perm)
                                    &nbsp;<span class="badge bg-success">{{$perm->name}}</span></span>
                                @endforeach
                        </td>
                        <td>
                            <button wire:click="editUser({{$user->id}})" type="button" class="btn btn-primary btn-sm">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button wire:click="openModuleDeleteUser({{$user}})" type="button" class="btn btn-danger btn-sm">
                                <i class="fa-solid fa-trash" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="mt-2">
                {{ $users->links() }}
            </div>
            @else
                <span>{{__('main.no_roles')}}</span>
                <br />
                <span><a href="/add-user"><button class="btn btn-primary mt-2">{{__('main.new_user')}}</button></a></span>
    @endif
</div>
