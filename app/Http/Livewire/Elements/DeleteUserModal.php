<?php

namespace App\Http\Livewire\Elements;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use \App\Models\User;

class DeleteUserModal extends Component
{
    public $user_id,$user_name;

    public function render()
    {
        return view('livewire.elements.delete-user-modal');
    }
    public function mount(){
        $user = Auth::user();
        if (!$user->can('delete_users')) {
            $this->skipRender();
            return redirect()->to('/no-permission');
        }
    }
    protected $listeners = ['activeModuleDeleteUser'];

    public function activeModuleDeleteUser($user){
        $this->user_id = $user['id'];
        $this->user_name = $user['name'];
    }
    public function deleteUser($id){
        User::find($id)->delete();
        return redirect()->to('/users')->with('status', __('main.user').' '.$this->user_name .' '.__('main.user_deleted'));
    }
}
