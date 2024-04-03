<div>
    @if (session()->has('status'))

        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form wire:submit.prevent="saveSettings">

        <div wire:loading>
            @include('elements.loader')
        </div>

        <div class="form-group">
            <label for="InputTitle">{{ __('main.name') }}</label>
            <input type="text" class="form-control" id="InputTitle" placeholder="{{ __('main.enter_extend_article_name') }}" wire:model.lazy="name">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mt-4">
            <label for="logo" class="mr-4">{{ __('main.logo') }}</label>
            <div class="picture-container">
                <img id="logo" src="{{ asset('/storage/') . '/' . $settings->logo }}" class="rounded-circle mb-3" style="width: 150px;" alt="Avatar" />
                <div class="upload-button">
                    <i class="fas fa-cloud-upload-alt"></i>
                </div>
            </div>
        </div>

        <div class="form-group mt-2 mb-2">
            <input type="checkbox" id="show_img_logo" value="1" @if($designSettings['show_img_logo']) checked @endif wire:model.lazy="designSettings.show_img_logo">
            <label for="show_img_logo">Показать изображение логотипа</label>
        </div>

        <div class="form-group mt-2 mb-2">
            <input type="checkbox" id="show_logo_text" value="1" @if($designSettings['show_logo_text']) checked @endif wire:model.lazy="designSettings.show_logo_text">
            <label for="show_logo_text">Показать название сайта</label>
        </div>

        <div class="form-group mt-2 mb-2" wire:ignore>
            <div class="row">
                <div class="col-md-3">
                    <label>{{ __('main.background_header') }}</label>
                </div>
                <div class="col-md-6">
                    <div id="background_header"></div>
                </div>
            </div>
        </div>
        <div class="form-group mt-2 mb-2" wire:ignore>
            <div class="row">
                <div class="col-md-3">
                    <label>{{ __('main.background_footer') }}</label>
                </div>
                <div class="col-md-6">
                    <div id="background_footer"></div>
                </div>
            </div>
        </div>

        <div class="form-group mt-2 mb-2" wire:ignore>
            <div class="row">
                <div class="col-md-3">
                    <label>{{ __('main.background_card_header') }}</label>
                </div>
                <div class="col-md-6">
                    <div id="background_card_header"></div>
                </div>
            </div>
        </div>

        <div class="form-group mt-2 mb-2" wire:ignore>
            <div class="row">
                <div class="col-md-3">
                    <label for="colorInput4">{{ __('main.links_color') }}</label>
                </div>
                <div class="col-md-6">
                    <input id="colorInput4" data-jscolor="{}" value="{{ $designSettings['links_color'] }}" wire:model.lazy="designSettings.links_color">
                </div>
            </div>
        </div>

        <div class="form-group mt-2 mb-2" wire:ignore>
            <div class="row">
                <div class="col-md-3">
                    <label for="colorInput4">{{ __('main.h1_color') }}</label>
                </div>
                <div class="col-md-6">
                    <input id="colorInput4" data-jscolor="{}" value="{{ $designSettings['h1_color'] }}" wire:model.lazy="designSettings.h1_color">
                </div>
            </div>
        </div>

        <div class="form-group mt-2 mb-2" wire:ignore>
            <div class="row">
                <div class="col-md-3">
                    <label for="colorInput4">{{ __('main.menu_link_color') }}</label>
                </div>
                <div class="col-md-6">
                    <input id="colorInput4" data-jscolor="{}" value="{{ $designSettings['menu_link_color'] }}" wire:model.lazy="designSettings.menu_link_color">
                </div>
            </div>
        </div>

        <div class="form-group mt-2 mb-2" wire:ignore>
            <div class="row">
                <div class="col-md-3">
                    <label for="colorInput4">{{ __('main.menu_hover_link_color') }}</label>
                </div>
                <div class="col-md-6">
                    <input id="colorInput4" data-jscolor="{}" value="{{ $designSettings['menu_hover_link_color'] }}" wire:model.lazy="designSettings.menu_hover_link_color">
                </div>
            </div>
        </div>

        <div class="form-group mt-2 mb-2" wire:ignore>
            <label for="document">{{ __('main.site_logo') }}</label>
            <div class="needsclick dropzone" id="document-dropzone">
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-2">{{ __('main.site_settings_save') }}</button>

</form>
</div>
<script>

    document.querySelector('.picture-container').addEventListener('click', function () {
        document.querySelector('#document-dropzone').click();
    });

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jscolor/2.5.1/jscolor.min.js"></script>
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
                    for(
            var i
        in
            files
        )
            {
                var file = files[i]
                this.options.addedfile.call(this, file)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" wire:model.lazy="images" name="images[]" value="' + file.file_name + '">')
            }
            @endif
        }
    }
</script>
<script src="{{ asset('js/xncolorpicker.min.js') }}"></script>
<script>
    let designSettings = @js($designSettings);

    var background_header = new XNColorPicker({
        color: designSettings['background_header'],
        selector: "#background_header",
        showprecolor: true,
        prevcolors: null,
        showhistorycolor: true,
        historycolornum: 16,
        format: 'hsla',
        showPalette: true,
        show: false,
        lang: 'en',
        colorTypeOption: 'single,linear-gradient,radial-gradient',
        canMove: false,
        alwaysShow: false,
        autoConfirm: true,
        onError: function (e) {

        },
        onCancel: function (color) {
        },
        onChange: function (color) {
        },
        onConfirm: function (color) {
            try {
            @this.setDesign('background_header', color);
            } catch {
            }
        }
    });
    var background_footer = new XNColorPicker({
        color: designSettings['background_footer'],
        selector: "#background_footer",
        showprecolor: true,
        prevcolors: null,
        showhistorycolor: true,
        historycolornum: 16,
        format: 'hsla',
        showPalette: true,
        show: false,
        lang: 'en',
        colorTypeOption: 'single,linear-gradient,radial-gradient',//
        onError: function (e) {

        },
        onCancel: function (color) {
            //console.log("cancel",color)
        },
        onChange: function (color) {
            //console.log("change",color)
        },
        onConfirm: function (color) {
            try {
            @this.setDesign('background_footer', color);
            } catch {
            }
        }
    })
    var background_card_header = new XNColorPicker({
        color: designSettings['background_card_header'],
        selector: "#background_card_header",
        showprecolor: true,
        prevcolors: null,
        showhistorycolor: true,
        historycolornum: 16,
        format: 'hsla',
        showPalette: true,
        show: false,
        lang: 'en',
        colorTypeOption: 'single,linear-gradient,radial-gradient',//
        onError: function (e) {

        },
        onCancel: function (color) {
            //console.log("cancel",color)
        },
        onChange: function (color) {
            //console.log("change",color)
        },
        onConfirm: function (color) {
            try {
            @this.setDesign('background_card_header', color);
            } catch {
            }
        }
    })
</script>
<style>
    .picture-container {
        position: relative; /* Устанавливаем относительное позиционирование для контейнера */
        display: inline-block;
    }

    .picture-container .upload-button {
        position: absolute; /* Устанавливаем абсолютное позиционирование для кнопки */
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #f1f1f1;
        padding: 10px;
        border-radius: 50%;
        display: none; /* Изначально скрываем кнопку */
        cursor: pointer;
    }

    .picture-container:hover .upload-button {
        display: block; /* При наведении на контейнер показываем кнопку */
    }

    form div.form-group.mt-2.mb-2 label {
        min-width: 176px;
    }
</style>
<style>
    .fcolorpicker-curbox {
        width: 100%;
    }

    @font-face {
        font-family: "iconfontcolorpicker";
        src: url('//at.alicdn.com/t/font_2330183_hjqs7adohe.eot?t=1611198440225'); /* IE9 */
        src: url('//at.alicdn.com/t/font_2330183_hjqs7adohe.eot?t=1611198440225#iefix') format('embedded-opentype'), /* IE6-IE8 */ url('data:application/x-font-woff2;charset=utf-8;base64,d09GMgABAAAAAAOAAAsAAAAACCgAAAM0AAEAAAAAAAAAAAAAAAAAAAAAAAAAAAAAHEIGVgCDQAqCLIIBATYCJAMYCw4ABCAFhXEHSxsmB8iuwG3owcQgTIgy2hi0bXqFKGQd8AdC8fC43+u5SV4+UVvZERqFighl7dTmxIycZwlkWW3+9/fe+2ElMrG9HwGOaekvsYN9Z2kJbHJUhOLO4t9v7s0fsccI9UkOCPXtmqPiSzM2GpwgZ8ZG1Wz36wZdIAPZOLGAEtggCSxOx5ZBucEKn4BhKgfHTFdlAz4bzimyqQKzAEcJPJCo/BB5f5BvUflh7IKWuJ1A1yI9uG3snUGfwuwXiJthFfRlnIrC/G2hVkwt4gVgtdOzjlcAngfvHz9gDQJJk5lD915ej2DpM3jnzqUKyHgIYE2nB5tFxmZAIR5Wem7rFIyK1l29yxagqy1Jn/FmP913TDUgwSnb1Ieuhez/yyNrFEkQFaTrg528DZ/h0Mh8VmaVyKBcgaIFaSS+MPuRpHXCLh3sAE4zKau9yRCyLGZoWGsZU9B3MufneYefz+Yc99Dly93oc8742A70nxYmZ8ux6OLs/LGHgYcv3yR17d0x2T6Wt9Y/nFc7yHkQ/dxNfReOD8v/5+ndSejldVrG/Knrd/M4JfhPYXzrp8Y6AgZBSEobLxBkfGJ5JYr8fwDfzFKC8Ydjr/A87Y+dD/yvdbPRWTsWqn8T6KbcSh3IH8s6gLwRFQGQ/qHGv+Vj/OS7z9P9f7VXwIc+9oGj/sPISwDerUhn1k9gdSwpGsdU1aJkdiYKVMuhQTJqunj51qnXqaTzd+QLM9wEkpb1kM2YkAUbgEbPIahmCtC1ydjsnpl1aFE62GgLQFjrCZJhBGRrg44sWAc0FiLNr1XYEeg6HAvI3hK/bXWTEorw6h69zjNja2Qg/EY6T3IuvI6JT8heJ4ors+V5F1hWetgMW0Zzg3+TMuLlRpQ3ti1i0HCe4gYgUDIbC84Daak7kWKmYapVvVJd5ykM2IoRRZAIKrmHmrRcxnjVxUCBkYlM5FhR/ZeIEXaCWNcSCncvQAfhhWcsedgeyMLIPAy5KcyijEdcdcwNq22cMFANy6VQHIFUkiCRUd0pIJqoawxwFWaYrEq1rsL6NsTpf2qBLvMFa6TIUaKJGi3N01CJ6ptwlcXKt7rLTjrusFigBQA=') format('woff2'),
        url('//at.alicdn.com/t/font_2330183_hjqs7adohe.woff?t=1611198440225') format('woff'),
        url('//at.alicdn.com/t/font_2330183_hjqs7adohe.ttf?t=1611198440225') format('truetype'), /* chrome, firefox, opera, Safari, Android, iOS 4.2+ */ url('//at.alicdn.com/t/font_2330183_hjqs7adohe.svg?t=1611198440225#iconfontcolorpicker') format('svg'); /* iOS 4.1- */
    }

    .iconfontcolorpicker {
        font-family: "iconfontcolorpicker" !important;
        font-size: 16px;
        font-style: normal;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    .iconcolorpickerxiala:before {
        content: "\e704";
    }

    .iconcolorpickerzhankai1:before {
        content: "\e66d";
    }

    .iconcolorpickercheck:before {
        content: "\e600";
    }

    .iconcolorpicker11:before {
        content: "\e625";
    }

    .iconcolorpicker1:before {
        content: "\e624";
    }

</style>
