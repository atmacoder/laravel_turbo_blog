<?php

namespace App\Http\Livewire\Dashboard\Roles;

use Livewire\Component;
use \App\Models\Category;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class PermissionAdd extends Component
{
    use AuthorizesRequests;

    public $name,$roles,$guard_name,$categories,$category_id,$permission_name;

    public function render()
    {
        return view('livewire.dashboard.roles.add-permission');
    }
    public function mount(){

        $user = Auth::user();

        if (!$user->can('view_permissions') || !$user->can('create_permissions')) {
            $this->skipRender();
            return redirect()->to('/no-permission');
        }

        $this->roles = Role::all();
        $this->categories = Category::all();
    }
    public function createPermission(){
        $category = Category::find($this->category_id);
        //Permission::create(['guard_name' => $this->guard_name, 'name' => $this->permission_name .'_'.$category->slug]);
        Permission::create(['name' => $this->permission_name .'_'.$category->slug]);
        return redirect()->to('/permissions')->with('status', __('main.permission') . ' ' .  __('main.created'));
    }
}
