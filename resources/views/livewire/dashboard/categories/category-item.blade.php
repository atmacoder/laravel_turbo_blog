<tr>
    <td class="col-1">{{$category->id}}</td>
    <td class="col-2">
        <span>{{$category->title}}</span>
            @if(Count($category->subCategories)>0)
                <div class="card">
            <ul class="list-group list-group-flush">
                @foreach($category->subCategories as $subCategory)
                    <li class="list-group-item">
                        {{$subCategory->title}}
                        <button wire:click="editCategory({{ $subCategory->id }})"type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button wire:click="openModuleDeleteCategory({{$subCategory}})" type="button" class="btn btn-danger btn-sm">
                            <i class="fa-solid fa-trash" aria-hidden="true"></i>
                        </button>
                            @if(Count($subCategory->categories)>0)
                            <span style="float: left;padding: 0px 10px; margin-top:4px"><i class="fa fa-arrow-down" aria-hidden="true"></i></span>
                                <ul class="mt-2">
                            @foreach($subCategory->categories as $cat)
                                        <li class="list-group-item">
                                            {{$cat->title}}
                                            <br />
                                            <button wire:click="editCategory({{ $cat->id }})"type="button" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></button>
                                            <button wire:click="openModuleDeleteCategory({{$cat}})" type="button" class="btn btn-danger btn-sm">
                                                <i class="fa-solid fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </li>
                            @endforeach
                                </ul>
                            @endif
                    </li>
                @endforeach
                </ul>
                </div>
            @endif
    </td>
    <td class="col-3">
        <button wire:click="editCategory({{ $category->id }})"type="button" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></button>
        <button wire:click="openModuleDeleteCategory({{$category}})" type="button" class="btn btn-danger">
            <i class="fa-solid fa-trash" aria-hidden="true"></i>
        </button>
    </td>
</tr>

