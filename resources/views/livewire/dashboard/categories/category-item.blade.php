<tr>
    <td class="col-1">{{$category->id}}</td>
    <td class="col-6">
        <ul class="bullet_list" style="padding:0px;list-style-type: disc !important;">
            <li><span>{{$category->title}}</span></li>
        </ul>
        @if(Count($category->subCategories)>0)
            <ul style="padding:0px">
                @foreach($category->subCategories as $subCategory)
                    <ul style="position: relative;left: 8px;">
                    <li>
                        {{$subCategory->title}}
                        <i wire:click="editCategory({{ $subCategory->id }})" class="fa-solid fa-pen-to-square"></i>
                        <i wire:click="openModuleDeleteCategory({{$subCategory}})" class="fa-solid fa-trash" aria-hidden="true"></i>
                        @if(Count($subCategory->categories)>0)
                            <ul>
                                @foreach($subCategory->categories as $cat)
                                    <li>
                                        {{$cat->title}}
                                        <i wire:click="editCategory({{ $cat->id }})"
                                           class="fa-solid fa-pen-to-square"></i>
                                        <i wire:click="openModuleDeleteCategory({{$cat}})" class="fa-solid fa-trash"
                                           aria-hidden="true"></i>

                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                    </ul>
                @endforeach
            </ul>
        @endif
    </td>
    <td class="col-3">
        <button wire:click="editCategory({{ $category->id }})" type="button" class="btn btn-primary"><i
                class="fa-solid fa-pen-to-square"></i></button>
        <button wire:click="openModuleDeleteCategory({{$category}})" type="button" class="btn btn-danger">
            <i class="fa-solid fa-trash" aria-hidden="true"></i>
        </button>
    </td>
</tr>
