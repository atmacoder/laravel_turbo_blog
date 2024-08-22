<div>
    <div>
        <script>
            var uploadedDocumentMap = {}
            Dropzone.options.documentDropzone = {
                url: '{{ route('dashboard_images') }}',
                maxFilesize: 15, // MB
                addRemoveLinks: true,
                dictDefaultMessage: "{{__('main.upload_image_here')}}",
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                success: function (file, response) {
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
                        $('form').append('<input type="hidden" wire:model.lazy="new_images" name="new_images[]" value="' + file.file_name + '">')
                      }
                    @endif
                }
            }
        </script>
        @livewire('elements.delete-article-modal')
       

            <div wire:loading.delay>
                @include('elements.loader')
            </div>

            <div class="form-group">

                <label for="InputTitle">{{__('main.article_title')}}</label>

                <input type="text" class="form-control" id="InputTitle" placeholder="Enter title" wire:model.lazy="title">

                @error('title') <span class="text-danger">{{ $message }}</span> @enderror

            </div>
            @if($image)
                <div class="form-group">

                    <label for="InputTitle">{{__('main.article_image')}}</label>

                    <div class="card">
                        <div class="card-body">
                            @if($image)
                                @if(Count($article->media)==1)
                                    <a class="article-gallery" data-gall="gallery" href="{{ strpos($article->image, 'storage') !== false ? $article->image : '/storage'.$article->image }}" title="{{$article->title}}">
                                        <img style="max-height: 200px" id="slide-img" src="{{ strpos($article->image, 'storage') !== false ? $article->image : '/storage'.$article->image }}" alt="{{$article->title}}"/>
                                    </a>
                                @else
                                    <img style="max-height: 200px" id="slide-img" src="{{ strpos($article->image, 'storage') !== false ? $article->image : '/storage'.$article->image }}" alt="{{$article->title}}"/>
                                @endif
                            @else
                                <img id="slide-img" src="/storage/blank.png"/>

                            @endif
                        </div>
                    </div>

                </div>
            @endif
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

            <div class="row mt-4">
                <div class="col-md-12">
                    <small class="switch-label">Опубликованно</small>
                    <br />
                    <label class="switch">
                        @if($article->published == 1)
                            <input type="checkbox" value="true" checked wire:click="changeStatusPublished({{ $article->id }})">
                        @else
                            <input type="checkbox" value="false" wire:click="changeStatusPublished({{ $article->id }})">
                        @endif
                        <span class="slider"></span>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <small class="switch-label">Архив</small>
                    <br />
                    <label class="switch">
                        @if($article->arhive == 1)
                            <input type="checkbox" value="true" checked wire:click="changeStatusArhive({{ $article->id }})">
                        @else
                            <input type="checkbox" value="false" wire:click="changeStatusArhive({{ $article->id }})">
                        @endif
                        <span class="slider"></span>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label for="created_at">Дата создания</label>
                    <input type="date" class="form-control" wire:model="created_at">
                </div>
            </div>
            <div class="form-group mt-4" wire:ignore>
                @livewire('elements.chat-bot')
            </div>
            <div class="form-group mt-4" wire:ignore >

                <label for="description">{{__('main.description')}}</label>

                <textarea class="form-control" name="description" id="ArticleMessage" placeholder="Enter Body" wire:model.lazy="description"></textarea>

            </div>
            <div> @error('description') <span class="text-danger">{{ $message }}</span> @enderror</div>

            @isset($extendTypes)


                @foreach($extendTypes as $i => $ext)

                    <div class="form-group mt-4" wire:ignore>



                        <label class="mr-2">{{$ext->name}}</label>

                        @if($ext->type == "text")
                            <input type="{{$ext->type}}" class="form-control" value=""  wire:model="extendTypes.{{$i}}.value" />
                        @endif

                        @if($ext->type == "number")
                            <input type="{{$ext->type}}" class="form-control" value=""  wire:model="extendTypes.{{$i}}.value" />
                        @endif

                        @if($ext->type == "boolean")
                            <input class="ml-2 form-check-input" type="checkbox" value="false"  wire:model="extendTypes.{{$i}}.value" />
                        @endif

                        @if($ext->type == "textarea")
                            <div wire:ignore>
                                <div id="extendedTypes-{{$ext->id}}" type="textarea" class="form-control"  wire:model.lazy="extendTypes.{{$i}}.value" />
                            </div>
                        @endif


                    </div>

                @endforeach
                <div> @error('extendTypes') <span class="text-danger">{{ $message }}</span> @enderror</div>
            @endisset
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
            <button wire:click="openModuleDeleteArticle({{$article}})" type="button" class="btn btn-danger mt-2">
                <i class="fa-solid fa-trash" aria-hidden="true"></i>
            </button>
            <button type="submit" class="btn btn-primary mt-2">{{__('main.update_article')}}</button>
        
        <div class="row">
            @if($images)
                <h5 class="mt-2" for="images">{{__('main.images')}}</h5>
                <div class="row card  mt-2" style="min-height: 220px;margin: 0px 0px 0px 0px;padding: 4px 0px 18px 0px;">
                    <div id="images">
                        @foreach($images as $index => $img)
                            <div class="card" style="float:left;margin-top:10px;margin-right: 10px;"  wire:key="{{$images[$index]['id']}}">
                                <img src="{{$images[$index]['original_url']}}" style="max-height: 140px" class="card-img-top" />
                                <div class="card-footer">
                                    <div class="form-group mt-2">
                                        <input type="text" name="item-{{$index}}-name" id="item.{{$index}}.name" wire:model="images.{{$index}}.name" />
                                    </div>
                                    <div class="form-group mt-2 mb-2">
                                        <input type="text" disabled="true" value="{{$images[$index]['original_url']}}" />
                                    </div>
                                    <button class="btn btn-primary" wire:click="setArticleMainImg({{$index}})">
                                        @if($images[$index]['original_url'] == $image)
                                            <i class="fa fa-star" style="color:gold" aria-hidden="true"></i>
                                        @else
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                        @endif
                                    </button>
                                    <button class="btn btn-danger" wire:click="deleteImage({{$index}})">
                                        <i class="fa-solid fa-trash" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
        </div>
        <br />
        @endif
        <script>
            CKEDITOR.plugins.addExternal( 'codesnippet', '/storage/codesnippet/', 'plugin.js' );
            CKEDITOR.plugins.addExternal('image2', '/storage/image2/', 'plugin.js');
            CKEDITOR.plugins.addExternal( 'justify', '/storage/justify/', 'plugin.js' );
            const editor = CKEDITOR.replace('description',{
                extraPlugins:'codesnippet',
                extraPlugins: 'image2',
                extraPlugins:'justify',
                codeSnippetTheme:'monokia_sublime'
            });
            if(editor) {
                editor.on('change', function (event) {
                    @this.
                    set('description', event.editor.getData());
                });
            }
            var editors = @js($extendTypes);

            for (let key in  editors) {
                if (editors[key]['type']== "textarea") {
                    const neweditor = CKEDITOR.replace(document.querySelector('#extendedTypes-' + editors[key]['id']));
                    neweditor.setData(editors[key]['value']);
                    if(neweditor) {
                        neweditor.on('change', function (event) {
                            @this.
                            set('extendTypes.' + key + '.value', event.editor.getData());
                        });
                    }
                }
            }
        </script>
    </div>

</div>
<script>
    $(function() {
        $('#created_at').datepicker({
            format: 'yyyy-mm-dd'
        });
    });
</script>
<style>
    /* The switch - the box around the slider */
    .switch {
        font-size: 17px;
        position: relative;
        display: inline-block;
        width: 3.5em;
        height: 2em;
    }

    /* Hide default HTML checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        inset: 0;
        border: 2px solid #414141;
        border-radius: 50px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 1.4em;
        width: 1.4em;
        left: 0.2em;
        bottom: 0.2em;
        background-color: #b48d56;
        border-radius: inherit;
        transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
    }

    .switch input:checked + .slider {
        box-shadow: 0 0 10px rgba(180, 141, 86, 0.8);
        border: 2px solid #b48d56;
    }

    .switch input:checked + .slider:before {
        transform: translateX(1.5em);
    }
    .leading-5 svg{
        max-height: 25px;
    }
</style>
