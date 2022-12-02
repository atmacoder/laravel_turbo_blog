<?php

namespace App\Http\Livewire\Dashboard\Roles;

use Livewire\Component;

class RolesList extends Component
{
    public $roles;

    public function render()
    {
        return view('livewire.dashboard.roles.roles-list');
    }
    public function mount(){
        $this->roles = \App\Models\Roles::all();
    }
}
