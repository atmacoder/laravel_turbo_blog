<?php

namespace App\Http\Livewire\Elements;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DeletePermissionModal extends Component
{
    public $permission_id,$permission_name;

    public function render()
    {
        return view('livewire.elements.delete-permission-modal');
    }
    protected $listeners = ['activeModuleDeletePermission'];

    public function mount(){
        $user = Auth::user();
        if (!$user->can('delete_permissions')) {
            $this->skipRender();
            return redirect()->to('/no-permission');
        }
    }
    public function activeModuleDeletePermission($role){
        $this->permission_id = $role['id'];
        $this->permission_name = $role['name'];
    }
    public function deleteRole($id){
        Permission::find($id)->delete();
        return redirect()->to('/roles')->with('status', __('main.role').' '.$this->permission_name .' '.__('main.role_deleted'));;
    }
}
