<?php

namespace App\Http\Livewire\Dashboard\Users;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use \App\Models\User;
use Livewire\WithPagination;

class UsersList extends Component
{
    use AuthorizesRequests;
    use WithPagination;

    public function render()
    {
        return view('livewire.dashboard.users.users-list', [
            'users' => User::paginate(10),
        ]);
    }
    public function editUser($id){
        return redirect()->route('edit_user', ['user_id'=> $id]);
    }
    public function mount(){
        $user = Auth::user();
        if (!$user->can('view_users')) {
            $this->skipRender();
            return redirect()->to('/no-permission');
        }
    }
}
