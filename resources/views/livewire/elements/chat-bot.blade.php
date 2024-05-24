<div>
    <div class="row">
        <div class="col-md-6">
            <select wire:model="gptModel">
                <option value="ChatGPT">ChatGPT</option>
                <option value="Gemini">Gemini</option>
            </select>
        </div>
    </div>
    <div>
        <ul>
            @if($conversations)
                @foreach ($conversations as $conversation)
                    <li class="text-dark mt-1">
                        {{ $conversation->name }}
                        <button class="btn btn-secondary btn-sm"
                                wire:click="restoreConversation({{ $conversation->id }})">Восстановить
                        </button>
                        <button class="btn btn-secondary btn-sm"
                                wire:click="removeConversationn({{ $conversation->id }})">Удалить
                        </button>
                    </li>
                @endforeach
            @endif
        </ul>
        @if($conversations)
            {{ $conversations->links() }}
        @endif
    </div>
    <div class="row">
        <div class="flex-col space-y-4 p-4 w-full border-r border-gray-200"> @forelse($messages as $message)
                @if(!empty($message))
                    <div
                        class="flex flex-row bd-highlight mb-3 p-4 @if ($message['role'] === 'assistant') bg-light @else bg-muted @endif">
                        <div class="ml-4 text-secondary">
                            <div class="text-lg"><a href="#"
                                                    class="ml-2 text-black">{{ $message['role'] === 'assistant' ? __('main.chat_bot_bot') : __('main.chat_bot_you') }}</a>
                            </div>
                            <div class="mt-1">
                                <pre style="white-space: nowrap;" class="code-block">
								<code class="bot-code">
                                        {!! \Illuminate\Mail\Markdown::parse($message['content']) !!}
                                    </code></pre>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <button class="btn btn-secondary btn-sm float-end"
                                        x-clipboard.raw="{{ $message['content'] }}" style="max-width:35px">
                                    <i class="fa-solid fa-copy"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            @empty
                Нет сообщений
            @endforelse </div>
    </div>
    <label for="message" class="mb-2">{{__('main.chat_bot_questions')}}</label>
    <div wire:loading>

        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
        <span>{{ __('main.loading') }}</span>

    </div>
    <textarea class="form-control" id="message" rows="3" wire:model="message"></textarea>
    <div class="form-group">
        <button type="button" class="btn btn-primary mt-2"
                wire:click="sendMessage">{{__('main.chat_bot_send')}}</button>
        <button type="button" class="btn btn-danger mt-2"
                wire:click="resetMessages">{{__('main.chat_bot_reset')}}</button>

        <label for="image">Изображение</label>
        <input type="file" class="form-control-file" wire:model="image" accept="image/*">
    </div>

</div>

<script>
    var codeBlock = document.querySelector('.code-block');

    if (codeBlock) {
        var codeText = codeBlock.textContent;
        var lines = codeText.split('\n');
        var newCodeBlock = document.createElement('pre');
        for (var i = 0; i < lines.length; i++) {
            newCodeBlock.appendChild(document.createTextNode(lines[i]));
            newCodeBlock.appendChild(document.createElement('br'));
        }
        codeBlock.parentNode.replaceChild(newCodeBlock, codeBlock);
    }

</script>
