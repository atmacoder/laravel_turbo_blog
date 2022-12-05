<?php

namespace App\Http\Livewire\Dashboard\Roles;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use App\Models\Roles;
use Livewire\WithPagination;

class RolesList extends Component
{
    use AuthorizesRequests;
    use WithPagination;


    public function render()
    {

        return view('livewire.dashboard.roles.roles-list', [

            'roles' => Roles::paginate(10),

        ]);
    }
    public function openModuleDeleteRole($role){
        $this->emit('activateModalDelete', $role);
    }
}
