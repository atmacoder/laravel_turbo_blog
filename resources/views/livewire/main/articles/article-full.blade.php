<!-- Подключаем стили Highlight.js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js">
<!-- Подключаем скрипт Highlight.js -->
<script src="/storage/highlight.pack.js"></script>
@if(Count($article->media)>1)
<!-- Подключение swipebox CSS -->
<link rel="stylesheet" href="/storage/css/swipebox.min.css">
<!-- Подключение jquery JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Подключение swipebox JS -->
<script src="/storage/js/jquery.swipebox.min.js"></script>
@endif

<div class="card">
    <div class="card-header"><h1>{{ $article->title}}</h1></div>
    <div class="card-body">
        <div class="imgfull text-center">
            @if($article->image)
                @if(Count($article->media)>1)
                <a rel="gallery-1" href="{{$article->image}}" class="swipebox" title="{{$article->title}}">
                <img src="{{$article->image}}" alt="{{$article->title}}"/>
                </a>
                @else
                <img src="{{$article->image}}" alt="{{$article->title}}"/>
                @endif
            @else
                <img src="/storage/blank.png"/>

            @endif
        </div>
        {!! $article->description !!}

        @if(Count($article->media)>1)
            <div class="card">
            <div class="my-gallery">
                <div class="gallerybox">
                    @foreach($article->media as $index => $image)
                        <a rel="gallery-1" href="{{ $image->original_url }}" class="swipebox" title="{{ $image->name }}">
                            <img src="{{ $image->original_url }}" alt="{{ $image->name }}">
                        </a>
                    @endforeach
                </div>
            </div>
            </div>
        @endif

    </div>

    <div class="card-footer">
        @auth
          <div class="row justify-content-end">
             <div class="col text-right" style="text-align: right">
                <button class="btn btn-primary mt-4">
                   <a class="text-white" href="{{ url('/article-edit?article_id='.$article->id) }}">{{ __('main.edit_article') }}</a>
                </button>
             </div>
          </div>
        @endauth
        @livewire('elements.comments', ['article' => $article])
    </div>

</div>
<script>
   document.addEventListener('DOMContentLoaded', function() {
      document.querySelectorAll('pre code').forEach((block) => {
         hljs.highlightBlock(block);
      });
   });
</script>
<script type="text/javascript">
    ;( function( $ ) {

        $( '.swipebox' ).swipebox();

    } )( jQuery );
</script>
<style>
    .gallerybox {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); /* Создание гибкой сетки изображений */
        grid-gap: 10px; /* Отступ между изображениями */
    }

    .swipebox {
        width: auto; /* Установка ширины блока изображения */
        max-height: 150px; /* Установка высоты блока изображения, чтобы сделать его квадратным */
        overflow: hidden; /* Обрезать лишнее содержимое в случае необходимости */
    }

    .swipebox img {
        width: 100%; /* Сделать изображение заполнителем блока */
        height: 100%; /* Сделать изображение заполнителем блока */
        object-fit: cover; /* Обрезать изображение, чтобы оно занимало всю доступную площадь */
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
