<div class="card p-0 mb-2 article-card" style="min-width: 265px;">
<div class="card-body p-0">
    <a href="{{$article->category->slug . '/' . $article->slug}}">
        <div class="container">
            <div class="row align-items-center" style="min-height: 140px;">
                <div class="card-title col align-self-center"><a
                        href="{{$article->category->slug . '/' . $article->slug}}"
                        class=""><h4 class="article-title">{{$article->title}}</h4></a></div>
            </div>
            <div class="row">
                <div class="col">
					@php
						$image = $article->image;
					@endphp

					@if ($image)
						@if(filter_var($article->image, FILTER_VALIDATE_URL))
							<a href="{{$article->category->slug . '/' . $article->slug}}" class="card-body p-0">
								<div class="img-card" style="background-image: url('{{ $article->image }}');"></div>
							</a>
						@else
							<a href="{{$article->category->slug . '/' . $article->slug}}" class="card-body p-0">
								<div class="img-card" style="background-image: url('/storage/{{ $article->image }}');"></div>
							</a>
						@endif
					@else
						<a href="{{$article->category->slug . '/' . $article->slug}}" class="card-body p-0">
							<div class="img-card" style="background-image: url('/storage/blank.png');"></div>
						</a>
					@endif
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col align-self-center"><!----></div>
            </div>
        </div>
        @if($article->extendTypes)
        <br>
        <div class="p-2">

            @foreach($article->extendTypes->data as $extendArticle)
                @if($extendArticle && $extendArticle['name'] == "Краткое описание")
                    {{$extendArticle['value']}}
                @endif
            @endforeach

        </div>
        @endif
    </a>

</div>
</div>
