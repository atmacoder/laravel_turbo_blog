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

    public $name,$guard_name;


    public function render()
    {
        return view('livewire.dashboard.roles.add-role');
    }

    public function mount()
    {
        //$this->roles = Roles::all()->paginate(10);
    }

    public function createRole()
    {
        //validation

        $this->validate([
            'name' => 'required',
            'guard_name' => 'required',
        ]);

        $new_role = new Roles;
        $new_role->name = $this->name;
        $new_role->guard_name = $this->guard_name;
        $new_role->save();

        return redirect()->to('/roles')->with('status', __('main.role') . ' ' . $new_role->name . ' ' . __('main.role_was_created'));
    }
}
