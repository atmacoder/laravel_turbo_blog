<?php

namespace App\Http\Livewire\Dashboard\Permission;

use Livewire\Component;
use App\Models\Permission;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use mysql_xdevapi\Exception;
use Nette\Schema\ValidationException;

class AddPermission extends Component
{
    use AuthorizesRequests;

    public $name,$permissions;


    public function render()
    {
        return view('livewire.dashboard.roles.add-permission');
    }

    public function mount()
    {
        $this->permissions = Permission::all();
    }

    public function createPermission()
    {
        //validation

        $this->validate([
            'name' => 'required',
        ]);

        $new_role = new Permission;
        $new_role->name = $this->name;
        $new_role->save();

        return redirect()->to('/roles')->with('status', __('main.permission') . ' ' . $new_role->name . ' ' . __('main.permission_was_created'));
    }
}
