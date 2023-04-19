<?php

namespace App\Http\Livewire\Dashboard\Users;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UserApiToken extends Component
{
    public $apiKey;

    public function render()
    {
        return view('livewire.dashboard.users.user-api-token');
    }

    public function generateKey(){
        $user = Auth::user();
        $user->tokens->each->delete();
        $token = $user->createToken('user_access');
        $this->apiKey = $token->plainTextToken;
    }
}
