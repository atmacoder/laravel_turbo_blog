<?php

namespace App\Http\Livewire\Dashboard\Roles;

use Livewire\Component;
use App\Models\Roles;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use mysql_xdevapi\Exception;
use Nette\Schema\ValidationException;

class AddRole extends Component
{
    use AuthorizesRequests;

    public $name,$roles;


    public function render()
    {
        return view('livewire.dashboard.roles.add-role');
    }

    public function mount()
    {
        $this->roles = Roles::all();
    }

    public function createRole()
    {
        //validation

        $this->validate([
            'name' => 'required',
        ]);

        $new_role = new Roles;
        $new_role->name = $this->name;
        $new_role->save();

        return redirect()->to('/roles')->with('status', __('main.role') . ' ' . $new_role->name . ' ' . __('main.role_was_created'));
    }
}
