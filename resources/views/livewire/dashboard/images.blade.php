<div>
@foreach($images as $index => $image)
        <div class="card" style="width: 18rem;">
            <div class="card-body">
            <div class="media">
                <img src="{{public_path($image->file_name)}}" />
            </div>
                <input type="text" value="{{$image->name}}" />
            </div>
        </div>
    @endforeach
</div>
