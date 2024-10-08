<div>
    @if (session()->has('status'))

        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form wire:submit.prevent="createArticle">

        <div wire:loading.delay>
            @include('elements.loader')
        </div>

        <div class="form-group">

            <label for="InputTitle">{{__('main.title')}}</label>

            <input type="text" class="form-control" id="InputTitle" placeholder="{{__('main.enter_title')}}" wire:model.lazy="title">

            @error('title') <span class="text-danger">{{ $message }}</span> @enderror

        </div>

        <div class="form-group mt-2">

            <label for="InputSlug">{{__('main.alias')}}</label>

            <input type="text" class="form-control" id="InputSlug"  wire:model="slug">

            @error('slug') <span class="text-danger">{{ $message }}</span> @enderror

        </div>
        <div class="form-group mt-2">

            <label for="InputCategories">{{__('main.category')}}</label>
            <select class="form-select" aria-label="Default select example" id="InputCategories"  wire:model="category_id">
                <option selected>{{__('main.select_category')}}</option>
                @foreach ($categories as $c)
                    <option value="{{$c->id}}">{{$c->title}}</option>
                @endforeach
            </select>
            @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror

        </div>

        <div class="form-group mt-4" wire:ignore>
            @livewire('elements.chat-bot')
        </div>
        <div class="form-group mt-4" wire:ignore >

            <label for="description">{{__('main.description')}}</label>

            <textarea class="form-control" name="description" id="ArticleMessage" placeholder="Enter Body" wire:model.defer="description"></textarea>

        </div>

        @foreach($extendedTypes as $i => $ext)

            <div class="form-group mt-4">



                <label class="mr-2">{{$ext->name}}</label>

                @if($ext->type == "text")
                    <input type="{{$ext->type}}" class="form-control" value=""  wire:model="extendedTypes.{{$i}}.value" />
                @endif

                @if($ext->type == "number")
                    <input type="{{$ext->type}}" class="form-control" value=""  wire:model="extendedTypes.{{$i}}.value" />
                @endif

                @if($ext->type == "boolean")
                    <input class="ml-2 form-check-input" type="checkbox" value="false"  wire:model="extendedTypes.{{$i}}.value" />
                @endif

                @if($ext->type == "textarea")
                    <div wire:ignore>
                        <div id="extendedTypes-{{$ext->id}}" type="textarea" class="form-control" value=""  wire:model.defer="extendedTypes.{{$i}}.value" />
                    </div>
                @endif


            </div>

        @endforeach
        <div> @error('extendedTypes') <span class="text-danger">{{ $message }}</span> @enderror</div>
        <div> @error('description') <span class="text-danger">{{ $message }}</span> @enderror</div>
        <div class="form-group mt-2">

            <label for="InputMetaDesc">{{__('main.meta_desc')}}</label>
            <input type="text" class="form-control mt-2" id="InputMetaDesc"  wire:model.lazy="metadesc">

        </div>
        <div class="form-group mt-2">

            <label for="InputMetaKeys">{{__('main.meta_keys')}}</label>
            <input type="text" class="form-control" id="InputMetaKeys"  wire:model.lazy="metakeys">

        </div>
        <div class="form-group mt-2" wire:ignore>
            <label for="document">{{__('main.images')}}</label>
            <div class="needsclick dropzone" id="document-dropzone">
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-2">{{__('main.create_article')}}</button>
    </form>
</div>
    <script>
        CKEDITOR.plugins.addExternal( 'codesnippet', '/storage/codesnippet/', 'plugin.js' );
        CKEDITOR.plugins.addExternal('image2', '/storage/image2/', 'plugin.js');
        CKEDITOR.plugins.addExternal( 'justify', '/storage/justify/', 'plugin.js' );
        const editor = CKEDITOR.replace('description',{
            extraPlugins:'codesnippet',
            extraPlugins: 'image2',
            extraPlugins:'justify',
            codeSnippetTheme:'monokia_sublime',
            config: {
                versionCheck: false
            }
        });

        editor.on('change', function(event){
        @this.set('description', event.editor.getData());
        });

        var editors = @js($extendedTypes);

        for (let key in  editors) {
            if (editors[key]['type']== "textarea") {
                const neweditor = CKEDITOR.replace(document.querySelector('#extendedTypes-' + editors[key]['id']),{
                    extraPlugins:'codesnippet',
                    extraPlugins: 'image2',
                    extraPlugins:'justify',
                    codeSnippetTheme:'monokia_sublime',
                    config: {
                        versionCheck: false
                    }
                });
                neweditor.setData(editors[key]['value']);
                neweditor.on('change', function(event){
                @this.set('extendedTypes.'+key+'.value', event.editor.getData());
                });
            }
        }
        var uploadedDocumentMap = {}
        Dropzone.options.documentDropzone = {
            url: '{{ route('dashboard_images') }}',
            maxFilesize: 2, // MB
            addRemoveLinks: true,
            dictDefaultMessage: "{{__('main.upload_image_here')}}",
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function (file, response) {
                // $('form').append('<input type="hidden" wire:model.lazy="images" name="images[]" value="' + response.name + '">')
            @this.setImages(response.name);
                uploadedDocumentMap[file.name] = response.name
            },
            removedfile: function (file) {
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedDocumentMap[file.name]
                }
                $('form').find('input[name="document[]"][value="' + name + '"]').remove()
            },
            init: function () {
                @if(isset($project) && $project->document)
                var files =
                    {!! json_encode($project->document) !!}
                    for (var i in files) {
                    var file = files[i]
                    this.options.addedfile.call(this, file)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" wire:model.lazy="images" name="images[]" value="' + file.file_name + '">')
                }
                @endif
            }
        }
    </script>
</div>
