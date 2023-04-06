<div>
    <div>
        <script>
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
                        $('form').append('<input type="hidden" wire:model.lazy="new_images" name="new_images[]" value="' + file.file_name + '">')
                    }
                    @endif
                }
            }
        </script>
        <form wire:submit.prevent="updateArticle">

            <div wire:loading>
                @include('livewire.elements.loader')
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
                            <img src="{{$image}}" style="max-height: 200px"/>
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
            <button type="submit" class="btn btn-primary mt-2">{{__('main.update_article')}}</button>
        </form>
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

        <script src="https://cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>
        <script>

            const editor = CKEDITOR.replace('description');

            editor.on('change', function(event){
            @this.set('description', event.editor.getData());
            });

            var editors = @js($extendTypes);

            for (let key in  editors) {
                if (editors[key]['type']== "textarea") {
                    const neweditor = CKEDITOR.replace(document.querySelector('#extendedTypes-' + editors[key]['id']));
                    neweditor.setData(editors[key]['value']);
                    neweditor.on('change', function(event){
                        console.log(event.editor.getData())
                    @this.set('extendTypes.'+key+'.value', event.editor.getData());
                    });



                }
            }
        </script>
    </div>

</div>
