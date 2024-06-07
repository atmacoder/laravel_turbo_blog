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
        <h2>{{ __('main.backend') }}</h2>
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
                    <label for="colorInput1">{{ __('main.links_color') }}</label>
                </div>
                <div class="col-md-6">
                    <input id="colorInput2" data-jscolor="{}" value="{{ $designSettings['links_color'] }}" wire:model.lazy="designSettings.links_color">
                </div>
            </div>
        </div>

        <div class="form-group mt-2 mb-2" wire:ignore>
            <div class="row">
                <div class="col-md-3">
                    <label for="colorInput3">{{ __('main.h1_color') }}</label>
                </div>
                <div class="col-md-6">
                    <input id="colorInput4" data-jscolor="{}" value="{{ $designSettings['h1_color'] }}" wire:model.lazy="designSettings.h1_color">
                </div>
            </div>
        </div>

        <div class="form-group mt-2 mb-2" wire:ignore>
            <div class="row">
                <div class="col-md-3">
                    <label for="colorInput5">{{ __('main.menu_link_color') }}</label>
                </div>
                <div class="col-md-6">
                    <input id="colorInput6" data-jscolor="{}" value="{{ $designSettings['menu_link_color'] }}" wire:model.lazy="designSettings.menu_link_color">
                </div>
            </div>
        </div>

        <div class="form-group mt-2 mb-2" wire:ignore>
            <div class="row">
                <div class="col-md-3">
                    <label for="colorInput7">{{ __('main.menu_hover_link_color') }}</label>
                </div>
                <div class="col-md-6">
                    <input id="colorInput8" data-jscolor="{}" value="{{ $designSettings['menu_hover_link_color'] }}" wire:model.lazy="designSettings.menu_hover_link_color">
                </div>
            </div>
        </div>
        <h2>{{ __('main.frontend') }}</h2>

        <div class="form-group mt-2 mb-2" wire:ignore>
            <div class="row">
                <div class="col-md-3">
                    <label for="colorInput9">{{ __('main.logo_text_color') }}</label>
                </div>
                <div class="col-md-6">
                    <input id="colorInput10" data-jscolor="{}" value="{{ $designSettings['logo_text_color'] }}" wire:model.lazy="designSettings.logo_text_color">
                </div>
            </div>
            <hr />
            <div class="row mt-2">
                <div class="col-md-3">
                    <label for="colorInput11">{{ __('main.logo_text_size') }}</label>
                </div>
                <div class="col-md-6">
                    <input type="number" value="{{ $designSettings['logo_text_size'] }}" wire:model.lazy="designSettings.logo_text_size"/>
                </div>
            </div>
            <hr />
            <div class="row mt-2">
                <div class="col-md-3">
                    <label for="colorInput12">{{ __('main.info_blog_header_right') }}</label>
                </div>
                <div class="col-md-6">
                    <textarea value="{{ $designSettings['info_blog_header_right'] }}" wire:model.lazy="designSettings.info_blog_header_right"></textarea>
                </div>
            </div>
            <hr />
            <div class="row mt-2">
                <div class="col-md-3">
                    <label for="colorInput12">{{ __('main.info_blog_footer') }}</label>
                </div>
                <div class="col-md-6">
                    <textarea value="{{ $designSettings['info_blog_footer'] }}" wire:model.lazy="designSettings.info_blog_footer"></textarea>
                </div>
            </div>
            <hr />
            <div class="row mt-2">
                <div class="col-md-3">
                    <label for="colorInput22">{{ __('main.footer_text_color') }}</label>
                </div>
                <div class="col-md-6">
                    <input id="colorInput22" data-jscolor="{}" value="{{ $designSettings['footer_text_color'] }}" wire:model.lazy="designSettings.footer_text_color">
                </div>
            </div>
        </div>
        <hr />
        <div class="form-group mt-2 mb-2" wire:ignore>
            <div class="row">
                <div class="col-md-3">
                    <label>{{ __('main.background_menu') }}</label>
                </div>
                <div class="col-md-6">
                    <div id="background_menu"></div>
                </div>
            </div>
        </div>
        <hr />
        <div class="form-group mt-2 mb-2" wire:ignore>
            <div class="row mt-2">
                <div class="col-md-3">
                    <label for="colorInput13">{{ __('main.class_main_buttons') }}</label>
                    <div class="background-menu">
                    <button class="btn {{ $designSettings['class_main_buttons'] }} m-2">{{__('example')}}</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <select class="mt-4" id="colorInput17" wire:model="designSettings.class_main_buttons">
                        <option value="">Выберите класс кнопки</option>
                        <option value="btn-primary">Синяя кнопка</option>
                        <option value="btn-secondary">Серая кнопка</option>
                        <option value="btn-success">Зеленая кнопка</option>
                        <option value="btn-danger">Красная кнопка</option>
                        <option value="btn-warning">Оранжевая кнопка</option>
                        <option value="btn-info">Голубая кнопка</option>
                        <option value="btn-light">Светло-серая кнопка</option>
                        <option value="btn-dark">Темно-серая кнопка</option>
                        <option value="btn-outline-primary">Синяя кнопка с контуром</option>
                        <option value="btn-outline-secondary">Серая кнопка с контуром</option>
                        <option value="btn-outline-success">Зеленая кнопка с контуром</option>
                        <option value="btn-outline-danger">Красная кнопка с контуром</option>
                        <option value="btn-outline-warning">Оранжевая кнопка с контуром</option>
                        <option value="btn-outline-info">Голубая кнопка с контуром</option>
                        <option value="btn-outline-light">Светло-серая кнопка с контуром</option>
                        <option value="btn-outline-dark">Темно-серая кнопка с контуром</option>
                    </select>
                </div>
            </div>
            <hr />
            <div class="row mt-2">
                <div class="col-md-3">
                    <label for="colorInput14">{{ __('main.menu_text_color') }}</label>
                    <div class="background-menu">
                    <button class="btn {{ $designSettings['class_main_buttons'] }} m-2" style="color:{{ $designSettings['menu_text_color'] }}">{{__('example')}}</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <input class="mt-4" id="colorInput17" id="colorInput14" data-jscolor="{}" value="{{ $designSettings['menu_text_color'] }}" wire:model.lazy="designSettings.menu_text_color">
                </div>
            </div>
            <hr />
            <div class="row mt-2">
                <div class="col-md-3">
                    <label for="colorInput15">{{ __('main.menu_text_color_hover') }}</label>
                    <div class="background-menu">
                    <button class="btn {{ $designSettings['class_main_buttons'] }} m-2"><a href="#">{{__('example')}}</a></button>
                    </div>
                </div>
                <div class="col-md-6">
                    <input class="mt-4" id="colorInput17" id="colorInput15" data-jscolor="{}" value="{{ $designSettings['menu_text_color_hover'] }}" wire:model.lazy="designSettings.menu_text_color_hover">
                </div>
            </div>
            <hr />
            <div class="row mt-2">
                <div class="col-md-3">
                    <label for="colorInput16">{{ __('main.menu_active_text_color') }}</label>
                    <div class="background-menu">
                    <button class="btn {{ $designSettings['class_main_buttons'] }} active m-2"><a href="#"  style="color:{{ $designSettings['menu_active_text_color'] }}">{{__('example')}}</a></button>
                    </div>
                    </div>
                <div class="col-md-6">
                    <input class="mt-4" id="colorInput17" data-jscolor="{}" value="{{ $designSettings['menu_active_text_color'] }}" wire:model.lazy="designSettings.menu_active_text_color">
                </div>
            </div>
        </div>
        <hr />
        <div class="form-group mt-4 mb-2" wire:ignore>
            <div class="row">
                <div class="col-md-3">
                    <label>{{ __('main.background_card_header_frontend') }}</label>
                    <div class="p-2" style="background:{{ $designSettings['background_card_header_frontend'] }}; color:{{ $designSettings['background_card_header_frontend_color'] }}">
                        Example text
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mt-4" id="background_card_header_frontend"></div>
                </div>
            </div>
        </div>
        <hr />
        <div class="form-group mt-4 mb-2" wire:ignore>
            <div class="row">
                <div class="col-md-3">
                    <label for="colorInput18">{{ __('main.background_card_header_frontend_color') }}</label>
                    <div class="p-2" style="background:{{ $designSettings['background_card_header_frontend'] }}; color:{{ $designSettings['background_card_header_frontend_color'] }}">
                        Example text
                    </div>
                </div>
                <div class="col-md-6 mt-4">
                    <input class="mt-4" id="colorInput18" data-jscolor="{}" value="{{ $designSettings['background_card_header_frontend_color'] }}" wire:model.lazy="designSettings.background_card_header_frontend_color">
                </div>
            </div>
        </div>
        <hr />
        <div class="row mt-2">
            <div class="col-md-3">
                <label for="colorInput11">{{ __('main.category_text_size') }}</label>
            </div>
            <div class="col-md-6">
                <h3 style="font-size:{{ $designSettings['category_text_size'] }}">Example text size</h3>
                <input class="mt-4" type="number" value="{{ $designSettings['category_text_size'] }}" wire:model.lazy="designSettings.category_text_size"/>
            </div>
        </div>
        <hr />
        <div class="row mt-2">
            <div class="col-md-3">
                <label for="colorInput34">{{ __('main.category_text_color') }}</label>
                <div class="category_text_color">
                    <div class="m-2 p-2" style="color:{{ $designSettings['category_text_color'] }}; background:{{ $designSettings['background_card_header_body_frontend'] }}">{{__('example')}}</div>
                </div>
            </div>
            <div class="col-md-6">
                <input class="mt-4" id="colorInput17" id="colorInput14" data-jscolor="{}" value="{{ $designSettings['category_text_color'] }}" wire:model.lazy="designSettings.category_text_color">
            </div>
        </div>
        <hr />
        <div class="row mt-2">
            <div class="col-md-3">
                <label for="colorInput34">{{ __('main.comment_form_text') }}</label>
                <div class="category_text_color">
                    <div class="m-2 p-2" style="color:{{ $designSettings['comment_form_text'] }}; background:{{ $designSettings['background_card_header_body_frontend'] }}">{{__('example')}}</div>
                </div>
            </div>
            <div class="col-md-6">
                <input class="mt-4" id="colorInput17" id="colorInput14" data-jscolor="{}" value="{{ $designSettings['comment_form_text'] }}" wire:model.lazy="designSettings.comment_form_text">
            </div>
        </div>
        <hr />
        <div class="row mt-2">
            <div class="col-md-3">
                <label for="colorInput24">{{ __('main.article_title') }}</label>
                <div class="article_title">
                    <div class="m-2 p-2" style="color:{{ $designSettings['article_title'] }}; background:{{ $designSettings['article_body'] }}">{{__('example')}}</div>
                </div>
            </div>
            <div class="col-md-6">
                <input class="mt-4" id="colorInput17" id="colorInput14" data-jscolor="{}" value="{{ $designSettings['article_title'] }}" wire:model.lazy="designSettings.article_title">
            </div>
        </div>
        <hr />
        <div class="row mt-2">
            <div class="col-md-3">
                <label for="colorInput25">{{ __('main.article_body') }}</label>
                <div class="article_title">
                    <div class="m-2 p-2" style="color:{{ $designSettings['article_body'] }}; background:{{ $designSettings['article_body'] }}">{{__('example')}}</div>
                </div>
            </div>
            <div class="col-md-6">
                <input class="mt-4" id="colorInput27" id="colorInput14" data-jscolor="{}" value="{{ $designSettings['article_body'] }}" wire:model.lazy="designSettings.article_body">
            </div>
        </div>
        <hr />
        <div class="row mt-2">
            <div class="col-md-3">
                <label for="colorInput26">{{ __('main.breadcrumb_a') }}</label>
                <div class="article_title">
                    <div class="m-2 p-2" style="color:{{ $designSettings['breadcrumb_a'] }}; background:{{ $designSettings['background_card_header_body_frontend'] }}">{{__('example')}}</div>
                </div>
            </div>
            <div class="col-md-6">
                <input class="mt-4" id="colorInput27" id="colorInput14" data-jscolor="{}" value="{{ $designSettings['breadcrumb_a'] }}" wire:model.lazy="designSettings.breadcrumb_a">
            </div>
        </div>
        <hr />
        <div class="form-group mt-4 mb-2" wire:ignore>
            <div class="row">
                <div class="col-md-3">
                    <label for="colorInput18">{{ __('main.background_card_header_frontend_color_bb') }}</label>
                    <div class="p-2" style="background:{{ $designSettings['background_card_header_frontend'] }}; color:{{ $designSettings['background_card_header_frontend_color'] }}; border-bottom: 1px solid {{$designSettings['background_card_header_frontend_color_bb'] }}">
                        Example text
                    </div>
                    <div class="p-4" style="background:{{ $designSettings['background_card_header_body_frontend'] }}">example body</div>
                </div>
                <div class="col-md-6 mt-4">
                    <input class="mt-4" id="colorInput18" data-jscolor="{}" value="{{ $designSettings['background_card_header_frontend_color_bb'] }}" wire:model.lazy="designSettings.background_card_header_frontend_color_bb">
                </div>
            </div>
        </div>
        <hr />
        <div class="form-group mt-4 mb-2" wire:ignore>
            <div class="row">
                <div class="col-md-3">
                    <label>{{ __('main.background_card_header_body_frontend') }}</label>
                    <div class="p-2" style="background:{{ $designSettings['background_card_header_body_frontend'] }}">
                        Example text
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mt-4" id="background_card_header_body_frontend"></div>
                </div>
            </div>
        </div>
        <hr />
        <div class="form-group mt-4 mb-4">
        <div class="row">
            <div class="col-md-3">
                <label for="colorInput31">{{ __('main.scroll_top_background') }}</label>
            </div>
            <div class="col-md-6">
                <input id="colorInput31" data-jscolor="{}" value="{{ $designSettings['scroll_top_background'] }}" wire:model.lazy="designSettings.scroll_top_background">
            </div>
        </div>
        </div>
        <hr />
        <div class="form-group mt-4 mb-4">
            <input type="checkbox" id="show_category_desc" value="1" @if($designSettings['show_category_desc']) checked @endif wire:model.lazy="designSettings.show_category_desc">
            <label for="show_category_desc">Показать описание категории</label>
        </div>
        <hr />
        <div class="form-group mt-2 mb-2">
            <div class="row">
                <div class="col-md-3">
                    <label for="colorInput19">{{ __('main.background_header') }}</label>
                    @if(isset($designSettings['imageBackgroundHeader']))
                        <div class="card" style="background-image: url({{ $designSettings['imageBackgroundHeader'] }}); background-size: cover; height: 96px; width: 96px;">
                        </div>
                    @endif
                </div>
                <div class="col-md-6">
                    <input type="file" class="form-control-file" wire:model="imageBackgroundHeader" accept="image/*">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label for="colorInput20">{{ __('main.background_footer') }}</label>
                    @if(isset($designSettings['imageBackgroundFooter']))
                        <div class="card" style="background-image: url({{ $designSettings['imageBackgroundFooter'] }}); background-size: cover; height: 96px; width: 96px;">
                        </div>
                    @endif
                </div>
                <div class="col-md-6">
                    <input type="file" class="form-control-file" wire:model="imageBackgroundFooter" accept="image/*">
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label for="colorInput21">{{ __('main.background_bg') }}</label>
                    @if(isset($designSettings['imageBackgroundBg']))
                    <div class="card" style="background-image: url({{ $designSettings['imageBackgroundBg'] }}); background-size: cover; height: 96px; width: 96px;">
                    </div>
                    @endif
                </div>
                <div class="col-md-6">
                    <input type="file" class="form-control-file" wire:model="imageBackgroundBg" accept="image/*">
                </div>
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
    var background_menu = new XNColorPicker({
        color: designSettings['background_menu'],
        selector: "#background_menu",
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
            @this.setDesign('background_menu', color);
            } catch {
            }
        }
    })
    var background_menu = new XNColorPicker({
        color: designSettings['background_card_header_frontend'],
        selector: "#background_card_header_frontend",
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
            @this.setDesign('background_card_header_frontend', color);
            } catch {
            }
        }
    })
    var background_menu = new XNColorPicker({
        color: designSettings['background_card_header_body_frontend'],
        selector: "#background_card_header_body_frontend",
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
            @this.setDesign('background_card_header_body_frontend', color);
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
    button.btn.{{ $designSettings['class_main_buttons'] }} a
    {
        color:{{ $designSettings['menu_text_color'] }}
     }
     button.btn.{{ $designSettings['class_main_buttons'] }} a:hover
     {
        color:{{ $designSettings['menu_text_color_hover'] }}
     }
     .background-menu{
     background:{{ $designSettings['background_menu'] }}
     }
</style>
