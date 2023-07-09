<?php

namespace App\Http\Livewire\Dashboard\Roles;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Livewire\WithPagination;

class RolesList extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public $permissions;

    public function render()
    {

        return view('livewire.dashboard.roles.roles-list', [

            'roles' => Role::paginate(10),

        ]);
    }
    public function mount(){

        $user = Auth::user();
        if (!$user->can('view_roles')) {
            $this->skipRender();
            return redirect()->to('/no-permission');
        }

        $this->permissions = Permission::all();
    }
    public function openModuleDeleteRole($role){
        $this->emit('activeModuleDeleteRole', $role);
    }

    public function editRole($id){
        return redirect()->route('role_edit', ['role_id'=> $id]);
    }

}
