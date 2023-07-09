<?php

namespace App\Http\Livewire\Dashboard\Roles;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class PermissionsList extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $itemCountPerPage = 10;

    public function render()
    {

        return view('livewire.dashboard.roles.permissions-list', [

            'permissions' => Permission::paginate($this->itemCountPerPage),

        ]);
    }
    public function mount(){

        $user = Auth::user();

        if (!$user->can('view_permissions')) {
            $this->skipRender();
            return redirect()->to('/no-permission');
        }
    }

    public function createPermission()
    {
  /*      //validation

        $this->validate([
            'name' => 'required',
            'guard_name' => 'required',
        ]);

        $new_role = new Roles;
        $new_role->name = $this->name;
        $new_role->guard_name = $this->guard_name;
        $new_role->save();

        return redirect()->to('/roles')->with('status', __('main.role') . ' ' . $new_role->name . ' ' . __('main.role_was_created'));*/
    }

    public function openModuleDeletePermission($role){
        $this->emit('activeModuleDeletePermission', $role);
    }
}
