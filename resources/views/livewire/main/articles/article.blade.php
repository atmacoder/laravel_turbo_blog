
<div class="col-md-6 col-lg-4 mb-5 wow fadeInUp" data-wow-delay=".2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
    <div class="blog-grid">
        <div class="blog-grid-img position-relative">
            <a href="{{$article->category->slug . '/' . $article->slug}}">
            @if($article->image)
            <img src="{{$article->image}}" alt="{{$article->title}}"/>
            @else
                <img src="/storage/blank.png"/>
            @endif
            </a>
        </div>
        <div class="blog-grid-text p-4">
            <h3 class="h5 mb-3"><a href="{{$article->category->slug . '/' . $article->slug}}">{{$article->title}}</a></h3>

           {{-- <p class="display-30">{!! $article->description !!}</p>--}}
            <div class="meta meta-style2">
                <ul>
                    <li><a href="#!"><i class="fas fa-calendar-alt"></i>  {{$article->created_at_formatted}}</li>
                    <li><a href="#!"><i class="fas fa-user"></i> {{$article->user_name}}</a></li>
                    <li><a href="#!"><i class="fas fa-comments"></i> {{$article->comments_count}}</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
