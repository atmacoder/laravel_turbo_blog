<div>
        <input type="text" class="form-control" id="InputName"  wire:model.lazy="apiKey">
        <button wire:click="generateKey" type="submit" class="btn btn-primary mt-2">{{__('main.user_api_generate')}}</button>
</div>

