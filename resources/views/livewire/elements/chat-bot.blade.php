<div>
    <div class="flex flex-col space-y-4 p-4">

        @if(!empty(($messages)))
            @foreach($messages as $message)
                @if(!empty(($message)))
                    <div class="d-flex flex-row bd-highlight mb-3 p-4 @if ($message['role'] === 'assistant') bg-light @else bg-info @endif ">
                        <div class="ml-4">
                            <div class="text-lg">
                                @if ($message['role'] === 'assistant')
                                    <a href="#" class="ml-2 text-black">{{__('main.chat_bot_bot')}}</a>
                                @else
                                    <a href="#" class="ml-2 text-black">{{__('main.chat_bot_you')}}</a>
                                @endif
                            </div>
                            <div class="mt-1">
                                <p class="text-secondary">
                                    {!! \Illuminate\Mail\Markdown::parse($message['content']) !!}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    </div>
    <label for="message" class="mb-2">{{__('main.chat_bot_questions')}}</label>
    <div wire:loading>

        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
        <span>{{ __('main.loading') }}</span>

    </div>
    <textarea class="form-control" id="message" rows="3" wire:model="message"></textarea>
    <button type="button" class="btn btn-primary mt-2" wire:click="sendMessage">{{__('main.chat_bot_send')}}</button>
    <button type="button" class="btn btn-danger mt-2" wire:click="resetMessages">{{__('main.chat_bot_reset')}}</button>
</div>

