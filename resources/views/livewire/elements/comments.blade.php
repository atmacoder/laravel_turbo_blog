@if($success == false )
    <div class="card-body">
    <h3 class="mt-2">{{__('main.comment_new')}}</h3>
<form wire:submit.prevent="store" class="form-inline">

    <div class=" mt-2 form-group">
        <label class="block uppercase tracking-wide text-grey-darker text-gray-600 text-lg font-bold mb-2"

               for="name">

            {{__('main.comment_name')}}

        </label>

        <input type="text"

               name="name"

               wire:model.debounce.365ms="name"

               placeholder="{{__('main.comment_name_type')}}"

               class="border p-3 rounded form-input focus:outline-none w-full shadow-md focus:shadow-lg transition duration-150 ease-in-out form-control"

               value="{{old('name')}}">

        @error('name')

        <p class="text-red-700 font-semibold mt-2">

            {{$message}}

        </p>

        @enderror

        <label class="block uppercase tracking-wide text-grey-darker text-gray-600 text-lg font-bold mb-2 mt-2"

               for="email">

            {{__('main.comment_email')}}

        </label>

        <input type="text"

               name="email"

               wire:model.debounce.365ms="email"

               placeholder="{{__('main.comment_email_type')}}"

               class="border p-3 rounded form-input focus:outline-none w-full shadow-md focus:shadow-lg transition duration-150 ease-in-out form-control"

               value="{{old('email')}}">

        @error('email')

        <p class="text-red-700 font-semibold mt-2">

            {{$message}}

        </p>

        @enderror

    </div>



    <div class=" mt-3">

        <label class="block uppercase tracking-wide text-grey-darker text-gray-600 text-lg font-bold mb-2">

            {{__('main.comment_body')}}

        </label>

        <textarea name="body"

                  cols="10"

                  rows="6"

                  wire:model.debounce.365ms="body"

                  id="comment_text"

                  placeholder="{{__('main.comment_body_type')}}"

                  class="form-control border p-2 mt-3 w-full form-textarea shadow-md focus:outline-none focus:shadown-lg transition duration-150 ease-in-out rounded-sm">{{old('body')}}</textarea>

        @error('body')

        <p class="text-red-700 font-semibold mt-2">

            {{$message}}

        </p>

        @enderror

    </div>



    <button type="submit"

            data-sitekey="{{$CAPTCHA_SITE_KEY}}"

            data-callback='handle'

            data-action='submit'

            class="g-recaptcha btn btn-primary mt-4">

        {{__('main.comment_submit')}}

    </button>

</form>
    </div>
@else
    <div class="alert alert-success" role="alert">
        <i class="fa fa-check-circle"></i> {{__('main.comment_succes')}}
    </div>
@endif
@if($article->comments && Count($article->comments)>0)
<h3>Комментарии</h3>
<div class="comments-list">
    @foreach ($article->comments as $comment)
        <div class="card mb-3">
            <div class="card-body d-flex align-items-start">
                <div class="text-center">
                    <img src="https://www.gravatar.com/avatar/{{ md5($comment->email) }}?d=identicon&s=80" class="rounded-circle text-center" alt="Avatar">
                    <h5 class="card-title mt-2 text-center">{{ $comment->name }}</h5>
                </div>
                <div class="mx-2 px-4">
                    <p class="card-text mt-4">{{ $comment->description }}</p>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endif
<script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
<script>
    var captchaSiteKey = "{{$CAPTCHA_SITE_KEY }}";
</script>
<script src="https://www.google.com/recaptcha/api.js?render=" + captchaSiteKey async defer></script>

<script>

    function handle(e) {

        grecaptcha.ready(function () {

            grecaptcha.execute('{{env('CAPTCHA_SITE_KEY')}}', {action: 'submit'})

                .then(function (token) {

                @this.set('captcha', token);

                });

        })

    }

</script>
<script>
    const editor = CKEDITOR.replace('comment_text', {
        toolbar: [
            { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike'] },
            { name: 'paragraph', items: ['NumberedList', 'BulletedList'] },
        ],
        // Другие опции конфигурации, если необходимо
    });

    editor.on('change', function(event) {
    @this.set('body', event.editor.getData());
    });
</script>
<script>
    function validateForm() {
        const name = document.querySelector('[wire:model="name"]').value;
        const email = document.querySelector('[wire:model="email"]').value;
        const body = document.querySelector('[wire:model="body"]').value;

        if (!name || !email || !body) {
            alert('Please fill in all fields');
            return false;
        }
    }
</script>
