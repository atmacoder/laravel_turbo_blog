<?php

namespace App\Http\Livewire\Dashboard\Roles;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


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

        $user = Auth::user();
        if (!$user->can('view_roles') || !$user->can('edit_roles')) {
            $this->skipRender();
            return redirect()->to('/no-permission');
        }
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

        $role->syncPermissions($perms);

        return redirect()->to('/roles')->with('status', __('main.role') . ' ' . $role->name . ' ' . __('main.role_was_updated'));
    }
}
