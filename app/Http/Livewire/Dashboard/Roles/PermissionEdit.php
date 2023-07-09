<?php

namespace App\Http\Livewire\Dashboard\Roles;

use Livewire\Component;

class PermissionEdit extends Component
{
    public function render()
    {
        return view('livewire.dashboard.roles.edit-permission');
    }
    public function mount(){

        $user = Auth::user();

        if (!$user->can('view_permissions') || !$user->can('edit_permissions')) {
            $this->skipRender();
            return redirect()->to('/no-permission');
        }
    }
}
