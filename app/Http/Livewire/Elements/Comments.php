<?php

namespace App\Http\Livewire\Elements;

use Livewire\Component;
use \App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
class Comments extends Component
{
    public $email;
    public $body;
    public $name;
    public $article;
    public $success = false;
    public $CAPTCHA_SITE_KEY;

    public function render()
    {
        $this->CAPTCHA_SITE_KEY = env('CAPTCHA_SITE_KEY');

        if (Auth::check()) {
            $user = Auth::user();
            $this->name = $user->name;
            $this->email = $user->email;
        }
        return view('livewire.elements.comments');
    }
    public $captcha = 0;


    public function updatedCaptcha($token)
    {
        $response = Http::post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('CAPTCHA_SECRET_KEY'),
            'response' => $token
        ]);

        $this->captcha = $response->json()['score'];

        if ($this->captcha > 0.3) {
            $this->store();
        } else {
            session()->flash('success', trans('main.recaptcha_bot_detection'));
        }
    }

    public function store()

    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
            'body' => 'required',
        ]);

     $comment = new Comment;
     $comment->article_id = $this->article->id;
     $comment->description = $this->body;
     $comment->email = $this->email;
     $comment->name = $this->name;
     $comment->save();

     if($comment){
         $this->success = true;
     }
    }
}
