<?php

namespace App\Http\Livewire\Dashboard\Users;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use \App\Models\User;
use Spatie\Permission\Models\Role;

class UserEdit extends Component
{
    public $user_id,$name,$email,$password,$password2,$roles;
    public $rolesSelected = [];

    public function render()
    {
        return view('livewire.dashboard.users.user-edit');
    }
    public function mount(Request $request){

        $user1 = Auth::user();

        if (!$user1->can('view_users') || !$user1->can('edit_users')) {
            $this->skipRender();
            return redirect()->to('/no-permission');
        }

        $user = User::findOrFail($request->input('user_id'));
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;

        if($user->roles->first()){
            $this->rolesSelected = $user->roles[0]->id;
        }

        $this->roles = Role::all();
    }
    public function updateUser(){
        $user = User::findOrFail($this->user_id);
        $user->name = $this->name;
        if($this->password && $this->password2 && $this->password = $this->password2){
            $user->password = bcrypt($this->password);
        }
        $user->password = bcrypt($this->password);
        if($this->rolesSelected){
            $role = Role::find($this->rolesSelected);
            $user->assignRole($role->name);
        }

        $user->update();

        return redirect()->to('/users')->with('status', __('main.user') . ' ' . $user->name . ' ' . __('main.user_was_updated'));
    }
}
