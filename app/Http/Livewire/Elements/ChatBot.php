<?php

namespace App\Http\Livewire\Elements;

use Livewire\Component;
use OpenAI\Laravel\Facades\OpenAI;
use Gemini\Laravel\Facades\Gemini;
use Gemini\Data\Content;
use Gemini\Enums\Role;
use Illuminate\Support\Collection;
use App\Models\Conversation;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Gemini\Enums;
use Gemini\Enums\MimeType;
use Gemini\Data\Blob;

class ChatBot extends Component
{
	use WithPagination;
	use WithFileUploads;
	protected $paginationTheme = 'bootstrap';
    public $message;
    public $conversation_id;
    protected $conversations;
    public $gptModel = "Gemini";
	public $image;
    public $messages = [];
    public $history = [];
    public $messagesGemini = [];

    public function mount()
    {
        //$this->conversations;
        $this->messages = [];
        $this->history = [];
        $this->messagesGemini = [];
    }

    public function render()
    {
    $this->conversations = \App\Models\Conversation::latest()->paginate(10);
	 return view('livewire.elements.chat-bot', [
            'conversations' => $this->conversations
        ]);
    }

    public function sendMessage()
    {
		
		if (!$this->conversation_id) {
			$name_conversation = substr($this->message, 0, 100);
			$name_conversation = preg_replace('/[^A-Za-z0-9А-Яа-я ]/ui', '', $name_conversation);

			// Проверяем, что имя беседы не пустое перед созданием
				if (!empty(trim($name_conversation))) {
				$conversation = \App\Models\Conversation::create([
					'name' => $name_conversation
				]);

				
			} else {
				// Если имя беседы пустое, выполните необходимые действия
				
				$conversation = \App\Models\Conversation::create([
					'name' => uniqid()
				]);
			}
			
			$this->conversation_id = $conversation->id;
		}
		

        //$this->conversations = \App\Models\Conversation::all();

        if ($this->gptModel == "ChatGPT") {

            try {
                $response = OpenAI::chat()->create([
                    'model' => 'gpt-3.5-turbo',
                    'messages' => $this->messages->toArray()
                ]);


                if ($response->choices[0]->message->content) {

                    $this->messages->push(['role' => 'assistant', 'content' => $response->choices[0]->message->content]);

                    \App\Models\Message::create([
                        'user_type' => 'bot',
                        'conversation_id' => $this->conversation_id,
                        'gpt_version' => $this->gptModel,
                        'text' => $response->choices[0]->message->content,
                    ]);
                }


            } catch (\Exception $e) {
                // Обработка исключений API OpenAI
            }

        } else {

            if ($this->messages && count($this->messages) > 0) {

                $chat = Gemini::chat()
                    ->startChat(history: array_map(function ($message) {
                        if($message['role'] == 'user'){
                            return Content::parse(part: $message['content'], role: Role::MODEL);
                        }
                        else{
                            return Content::parse(part: $message['content']);
                        }


                    }, $this->messages));

                $response = $chat->sendMessage($this->message);

                array_push($this->messages, ['role' => 'assistant', 'content' => $response->text()]);


                    \App\Models\Message::create([
                            'user_type' => 'bot',
                            'conversation_id' => $this->conversation_id,
                            'gpt_version' => $this->gptModel,
                            'text' => $response->text(),
                        ]);





            } else {

                //$this->messages->push(['role' => 'user', 'content' => $this->message]);
				if(!$this->image){
					try {

						$result = Gemini::geminiPro()->generateContent($this->message);

							array_push($this->messages, ['role' => 'assistant', 'content' => $result->text()]);

							\App\Models\Message::create([
								'user_type' => 'bot',
								'conversation_id' => $this->conversation_id,
								'gpt_version' => $this->gptModel,
								'text' => $result->text(),
							]);



					} catch (\Exception $e) {
						// Обработка исключений API Gemini
					}
				}
				else{
        $imageContent = base64_encode(file_get_contents($this->image->getRealPath()));


		$result = Gemini::geminiProVision()
            ->generateContent([
                $this->message,
                new Blob(
                    mimeType: MimeType::IMAGE_JPEG, // Use the fully qualified class name
                    data: $imageContent
                )
            ]);

			array_push($this->messages, ['role' => 'assistant', 'content' => $result->text()]);
				}
            }

        }

        array_push($this->messages, ['role' => 'user', 'content' => $this->message]);

        \App\Models\Message::create([
            'user_type' => 'user',
            'conversation_id' => $this->conversation_id,
            'gpt_version' => $this->gptModel,
            'text' => $this->message,
        ]);
    }

    public function resetMessages()
    {

        $this->messages = [];
    }

    public function restoreConversation($conversation_id)
    {
        $this->messages = [];

        $Conversation = \App\Models\Conversation::find($conversation_id);

        foreach ($Conversation->messages as $message) {

            if ($message->user_type == 'bot') {
                array_push($this->messages, ['role' => 'assistant', 'content' => $message->text]);

            } else {
                array_push($this->messages, ['role' => 'user', 'content' => $message->text]);
            }

        }

        $this->conversation_id = $Conversation->id;
    }

    public function removeConversationn($conversation_id)
    {
        \App\Models\Message::where('conversation_id',$conversation_id)->delete();
        \App\Models\Conversation::findOrFail($conversation_id)->delete();
		$this->conversations = \App\Models\Conversation::all();
    }
}
