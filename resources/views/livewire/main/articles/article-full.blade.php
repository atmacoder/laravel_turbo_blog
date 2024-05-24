
@if(isset($article) && Count($article->media)>1)
<!-- Подключение swipebox CSS -->
<link rel="stylesheet" href="/storage/css/venobox.min.css">
<script src="/storage/js/venobox.min.js"></script>
@endif
{{--@auth
@livewire('elements.delete-article-modal')
@endauth--}}
<div class="card">
    @if(isset($article))
    <div class="card-header">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Главная</a></li>
                <li class="breadcrumb-item"><a href="{{url($article->category->slug)}}">{{ $article->category->title}}</a></li>
                <li class="breadcrumb-item" aria-current="page">{{$article->title}}</li>
            </ol>
        </nav>

    </div>
    <div class="card-body article-body">
        <h1 class="text-center article-title">{{ $article->title}}</h1>
        <div class="imgfull text-center">
            @if($article->image)
                @if(Count($article->media)==1)
                    <a class="article-gallery" data-gall="gallery" href="{{ strpos($article->image, 'storage') !== false ? $article->image : '/storage'.$article->image }}" title="{{$article->title}}">
                        <img id="slide-img" src="{{ strpos($article->image, 'storage') !== false ? $article->image : '/storage'.$article->image }}" alt="{{$article->title}}"/>
                    </a>
                @else
                    <img id="slide-img" src="{{ strpos($article->image, 'storage') !== false ? $article->image : '/storage'.$article->image }}" alt="{{$article->title}}"/>
                @endif
            @else
                <img id="slide-img" src="/storage/blank.png"/>

            @endif
                @if(Count($article->media)>1)
                    <div class="mt-4 mb-4">
                        <div class="my-gallery">
                            <div class="gallerybox">
                                @foreach($article->media as $index => $image)
                                    <a class="article-gallery" data-gall="gallery"  href="{{ $image->original_url }}" title="{{ $image->name }}" data-fitview="true">
                                        <img id="slide-img-gallery" data-title="{{ $image->name }}" src="{{ $image->original_url }}" alt="{{ $image->name }}" data-maxwidth="100%">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
				@if($article->arhive == 1 || $article->category->title == "Архив")
					<p>«Нет в наличии»</p>
				@endif
        </div>
        {!! $article->description !!}

    </div>

    <div class="card-footer">
        @auth
          <div class="row justify-content-end">
             <div class="col text-right" style="text-align: right">
{{--                 <button wire:click="openModuleDeleteArticle({{ $article->id }})" type="button" class="btn btn-danger">
                     <i class="fa-solid fa-trash" aria-hidden="true"></i>
                 </button>--}}
                 <button class="btn btn-primary mt-4">
                   <a class="text-white" href="{{ url('/article-edit?article_id='.$article->id) }}">{{ __('main.edit_article') }}</a>
                </button>
             </div>
          </div>
        @endauth
        @livewire('elements.comments', ['article' => $article])
    </div>
    @endif
</div>

<script>
   document.addEventListener('DOMContentLoaded', function() {
      document.querySelectorAll('pre code').forEach((block) => {
         hljs.highlightBlock(block);
      });
   });
</script>
@if(isset($article) && Count($article->media)>1)
<script type="text/javascript">
    new VenoBox({
        selector: ".article-gallery",
        numeration: true,
        infinigall: true,
        share: true,
        spinner: 'rotating-plane'
    });
</script>
@endif
<style>
    #slide-img-gallery {
        box-shadow: 0 .5rem 1rem rgba(0,0,0,.15) !important;
        max-height: 140px;
        padding: 10px;
    }
    .gallerybox {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); /* Создание гибкой сетки изображений */
        grid-gap: 10px; /* Отступ между изображениями */
    }
    .imgfull {
        max-width: 100%; /* Сделать изображение шириной по максимальной доступной ширине */
    }

    .imgfull img {
        width: 100%; /* Сделать изображение заполнителем блока */
        max-height: 400px; /* Ограничить высоту изображения до 400px */
        object-fit: contain; /* Сохранить соотношение сторон, заполняя контейнер */
    }
</style>

