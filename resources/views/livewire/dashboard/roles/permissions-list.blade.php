<div>
    @if($permissions)
        <div class="row">
            <div class="col-md-4">
                <span><a href="/add-permission"><button
                            class="btn btn-primary mt-2">{{__('main.new_role')}}</button></a></span>
            </div>
            <div class="col-md-4">
            </div>
            <div class="col-md-8" style="max-width:110px">
                <select wire:model="itemCountPerPage" class="form-select form-select-lg mb-3"
                        aria-label=".form-select-lg example">
                    <option selected value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div>
        <ul class="list-group">
            <table class="table table-light table-striped table-hover table-responsive">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">{{__('main.name')}}</th>
                    <th scope="col">{{__('main.guard_name')}}</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($permissions as $index => $permission)
                    <tr>
                        <td>{{$permission->id}}</td>
                        <td>{{$permission->name}}</td>
                        <td>{{$permission->guard_name}}</td>
                        <td>
                            <button wire:click="openModuleDeleteRole({{$permission}})" type="button"
                                    class="btn btn-danger btn-sm">
                                <i class="fa-solid fa-trash" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="mt-2">
                {{ $permissions->links() }}
            </div>
            @else
                <span>{{__('main.no_roles')}}</span>
                <br/>
                <span><a href="/add-permission"><button
                            class="btn btn-primary mt-2">{{__('main.new_role')}}</button></a></span>
    @endif
</div>
