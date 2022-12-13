<?php

namespace App\Http\Livewire\Dashboard\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RoleAdd extends Component
{
    use AuthorizesRequests;

    public $name,$permissions;

    public $selectionPermissions=[];


    public function render()
    {
        return view('livewire.dashboard.roles.add-role');
    }

    public function mount()
    {
        $this->permissions = Permission::all();
        $this->selectionPermissions = Permission::all()->pluck('id')->toArray();
    }

    public function createRole()
    {
        //validation

        $this->validate([
            'name' => 'required|unique:roles',
        ]);

        $new_role = new Role;
        $new_role->name = $this->name;
        $new_role->save();

        $perms  = Permission::whereIn('id',$this->selectionPermissions)->get();

        $new_role->syncPermissions(
            $perms
        );


        return redirect()->to('/roles')->with('status', __('main.role') . ' ' . $new_role->name . ' ' . __('main.role_was_created'));
    }
}
