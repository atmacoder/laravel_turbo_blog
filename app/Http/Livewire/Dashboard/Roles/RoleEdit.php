<?php

namespace App\Http\Livewire\Dashboard\Roles;

use Illuminate\Http\Request;
use Livewire\Component;
//use \App\Models\Permissions;
//use \App\Models\Roles;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleEdit extends Component
{
    public $permissions,$role,$name,$role_id;

    public $selectionPermissions=[];

    public function render()
    {
        return view('livewire.dashboard.roles.edit-role');
    }
    public function mount(Request $request){

        $this->permissions = Permission::all();
        $role = Role::with('permissions')->find($request->input('role_id'));

        $this->name = $role->name;

        $this->role_id = $role->id;

        $this->selectionPermissions = $role->permissions->toArray();
    }
    public function updateRolePermissions(){

        $this->validate([
            'selectionPermissions' => 'required',
        ]);

        $perms  = $this->selectionPermissions;

        $role = Role::find($this->role_id);

        $role->syncPermissions(
            $perms
        );

        return redirect()->to('/roles')->with('status', __('main.role') . ' ' . $role->name . ' ' . __('main.role_was_updated'));
    }
}
