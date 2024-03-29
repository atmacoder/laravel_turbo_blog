<?php

namespace App\Http\Livewire\Dashboard\Users;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use \App\Models\User;

class UserAdd extends Component
{
    public $name, $email, $password, $password2, $role;

    public function render()
    {
        return view('livewire.dashboard.users.user-add');
    }

    public function mount()
    {
        $user = Auth::user();
        if (!$user->can('view_users') || !$user->can('create_users')) {
            $this->skipRender();
            return redirect()->to('/no-permission');
        }
    }

    public function addUser()
    {
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password)
        ]);

        return redirect()->to('/users')->with('status', __('main.user') . ' ' . $user->name . ' ' . __('main.user_was_created'));
    }
}
