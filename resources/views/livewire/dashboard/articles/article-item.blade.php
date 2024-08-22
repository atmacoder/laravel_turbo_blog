<tr>
    <td class="col-1">
        {{ $article->id }}
    </td>
    <td class="col-1">
        @if($article->image)
			<div class="card" style="background-image: url('{{ strpos($article->image, 'storage') !== false ? $article->image : '/storage'.$article->image }}');  background-size: contain; height: 96px;background-repeat: no-repeat;background-position: center;">
		</div>
        @endif
    </td>
    <td class="col-6">
        <h5>{{ $article->title }}</h5>
        <small>{{$article->category->title}}</small>
    </td>
    <td class="col-3">
        <div>
            <button wire:click="editArticle({{ $article->id }})" type="button" class="btn btn-primary"><i
                    class="fa-solid fa-pen-to-square"></i></button>
            <button wire:click="openModuleDeleteArticle({{$article}})" type="button" class="btn btn-danger">
                <i class="fa-solid fa-trash" aria-hidden="true"></i>
            </button>
        </div>
        <div class="row">
            <div class="col-md-6">
                <small class="switch-label">Опубликованно</small>

                <label class="switch">
                    @if($article->published == 1)
                        <input type="checkbox" value="true" checked wire:click="changeStatusPublished({{ $article->id }})">
                    @else
                        <input type="checkbox" value="false" wire:click="changeStatusPublished({{ $article->id }})">
                    @endif
                    <span class="slider"></span>
                </label>
            </div>
            <div class="col-md-6">
                <small class="switch-label">Архив</small>

                <label class="switch">
                    @if($article->arhive == 1)
                        <input type="checkbox" value="true" checked wire:click="changeStatusArhive({{ $article->id }})">
                    @else
                        <input type="checkbox" value="false" wire:click="changeStatusArhive({{ $article->id }})">
                    @endif
                    <span class="slider"></span>
                </label>
            </div>
        </div>
    </td>
</tr>
<style>
    img {
        max-width: 100%;
        max-height: 60px;
    }
    .btn-group-vertical > .btn,
    .btn-group > .btn {
        width: 100%;
    }
  .switch-label{
      min-width: 120px;
      display: block;
  }
</style>
