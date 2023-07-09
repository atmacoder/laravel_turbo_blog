<div>
    @if($roles)
        @livewire('elements.delete-role-modal')
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
                @foreach($roles as $index => $role)
                    <tr>
                    <td>{{$role->id}}</td>
                    <td>
                        {{$role->name}}
                        <div class="card">
                            <ul style="list-style-type: disc !important;">
                            @foreach($role->permissions as $perm)
                                <li>
                            <span>{{$perm->name}}</span>
                                </li>
                            @endforeach
                            </ul>

                        </div>
                    </td>
                    <td>
                        <button wire:click="editRole({{$role->id}})" type="button" class="btn btn-primary btn-sm">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                        <button wire:click="openModuleDeleteRole({{$role}})" type="button" class="btn btn-danger btn-sm">
                            <i class="fa-solid fa-trash" aria-hidden="true"></i>
                        </button>
                    </td>
                    </tr>
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
