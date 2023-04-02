<div>
    @if(Count($extendArticleTypes)>0)
        @livewire('elements.delete-extend-article-modal')
        <ul class="list-group">
            <table class="table table-light table-striped table-hover table-responsive">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">{{ __('main.extend_article_list_name') }}</th>
                    <th scope="col">{{ __('main.extend_default_value') }}</th>
                    <th scope="col">{{ __('main.extend_default_type') }}</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($extendArticleTypes as $index => $type)
                    <tr>
                        <td>
                            {{$type->id}}
                        </td>
                        <td>
                            {{$type->name}}
                        </td>
                        <td>
                            {{$type->value}}
                        </td>
                        <td>
                            {{$type->type}}
                        </td>
                        <td>
                            <button wire:click="editExtendArticle({{ $type->id }})" type="button" class="btn btn-primary"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button wire:click="openModuleDeleteExtendArticle({{$type}})" type="button" class="btn btn-danger">
                                <i class="fa-solid fa-trash" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="mt-2">
                {{ $extendArticleTypes->links() }}
            </div>
            @else
                <span>{{__('main.no_extend_article_type')}}</span>
                <br/>
                <span><a href="/extend-article-add"><button
                            class="btn btn-primary mt-2">{{__('main.extend_article_add')}}</button></a></span>
    @endif
</div>
