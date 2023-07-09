<?php

namespace App\Http\Livewire\Elements;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DeleteRoleModal extends Component
{
    public $role_id,$role_name;

    public function render()
    {
        return view('livewire.elements.delete-role-modal');
    }


    protected $listeners = ['activeModuleDeleteRole'];

    public function mount(){
        $user = Auth::user();
        if (!$user->can('delete_roles')) {
            $this->skipRender();
            return redirect()->to('/no-permission');
        }
    }
    public function activeModuleDeleteRole($role){
        $this->role_id = $role['id'];
        $this->role_name = $role['name'];
    }
    public function deleteRole($id){
        Role::find($id)->delete();
        return redirect()->to('/roles')->with('status', __('main.role').' '.$this->role_name .' '.__('main.role_deleted'));;
    }
}
