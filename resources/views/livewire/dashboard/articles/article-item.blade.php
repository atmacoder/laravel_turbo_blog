<tr>
    <td class="col-1">
        {{$article->id}}
    </td>
    <td class="col-1">
        @if($article->image)
            <div class="card media">
                <div class="card-body">
                    <img src="{{$article->image}}" style="max-height: 60px"/>
                </div>
            </div>
        @endif
    </td>
    </td>
    <td class="col-6">
        {{$article->title}}
    </td>
    <td class="col-3">
        <button wire:click="editArticle({{ $article->id }})" type="button" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></button>
        <button wire:click="openModuleDeleteArticle({{$article}})" type="button" class="btn btn-danger">
            <i class="fa-solid fa-trash" aria-hidden="true"></i>
        </button>
    </td>
</tr>
