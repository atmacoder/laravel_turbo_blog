<?php

namespace App\Http\Livewire\Dashboard\Roles;

use Livewire\Component;
use \App\Models\Category;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionAdd extends Component
{
    public $name,$roles,$guard_name,$categories,$category_id,$permission_name;

    public function render()
    {
        return view('livewire.dashboard.roles.add-permission');
    }
    public function mount(){

        $this->roles = Role::all();
        $this->categories = Category::all();
    }
    public function createPermission(){
        $category = Category::find($this->category_id);
        //Permission::create(['guard_name' => $this->guard_name, 'name' => $this->permission_name .'_'.$category->slug]);
        Permission::create(['name' => $this->permission_name .'_'.$category->slug]);
        return redirect()->to('/roles')->with('status', 'role created');
    }
}
