<?php

namespace App\Http\Livewire\Elements;

use Livewire\Component;
use OpenAI\Laravel\Facades\OpenAI;

class ChatBot extends Component
{
    public $message;
    public $messages = [];

    public function render()
    {
        return view('livewire.elements.chat-bot');
    }
    public function sendMessage(){

        //$this->messages[] = ['role' => 'system', 'content' => 'You are LaravelGPT - A ChatGPT clone. Answer as concisely as possible.'];
        array_push( $this->messages,['role' => 'user', 'content' => $this->message]);

        $response = OpenAI::chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => $this->messages
        ]);

        array_push( $this->messages,['role' => 'assistant', 'content' => $response->choices[0]->message->content]);
    }
    public function resetMessages(){

        $this->messages[] = [];
    }
}
