<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <div class="logo-image">
                    <a href="/" title="Антиквариант Фрунзенская набережная">
                        @if($settings['data']['show_img_logo'] == 1)

                            <img class="logo-img" src="{{ asset('/storage/') . '/' . $settings['logo'] }}"
                                 alt="{{$settings['name']}}">
                        @endif
                    </a>
                    @if($settings['data']['show_logo_text'] == 1)
                    <small class="site-slogan">{{$settings['name']}}</small>
                    @endif
                </div>
            </div>
            <div class="col-sm-4">
                <nav class="navbar navbar-expand-lg">
                    @livewire('elements.search-bar')
                </nav>
            </div>
            <div class="col-sm-4">
                <div class="custom">
                    {!!  $settings['data']['info_blog_header_right'] !!}
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .header {
        background-image: url('{{$settings['data']['imageBackgroundHeader']}}');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center 0px;
        display: flex;
    }
    .header {
        background-image: url('{{$settings['data']['imageBackgroundHeader']}}');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center 0px;
        display: flex;
    }
    .site-slogan{
        text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        color:{{$settings['data']['logo_text_color']}};
        font-size:{{$settings['data']['logo_text_size']}}px;
    }
    body {
        background-image: url('{{$settings['data']['imageBackgroundBg']}}');
        background-repeat: repeat scroll 0 0 transparent;
        background-position: center 1px;
    }
    div.card div.card-header{
        background: {{$settings['data']['background_card_header_frontend']}};
        color:{{$settings['data']['background_card_header_frontend_color']}};
        border-bottom:1px solid {{$settings['data']['background_card_header_frontend_color_bb']}};
    }
    div.card{
        background: {{$settings['data']['background_card_header_body_frontend']}};
    }
    .category-title{
        color: {{$settings['data']['category_text_color']}};
        text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
    }
    .article-title{
        color: {{$settings['data']['article_title']}};
        text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
    }
    .article-body{
        color: {{$settings['data']['article_body']}};
    }
    div.card div.card-body .category-list-item a{
        font-size:{{$settings['data']['category_text_size']}}px;
    }
    @if($settings['data']['show_category_desc'])
    .category-description{
        display:block
    }
    @else
       .category-description{
        display:none;
    }
    @endif
    div.card-header nav ol.breadcrumb li.breadcrumb-item a{
        color: {{$settings['data']['breadcrumb_a']}};
    }
    .comment-form{
        color: {{$settings['data']['comment_form_text']}};
    }
</style>
