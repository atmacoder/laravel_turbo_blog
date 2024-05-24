<div>
    @if($comments && Count($comments)>0)
        @livewire('elements.delete-comment-modal')
        <ul class="list-group">
            <table class="table table-light table-striped table-hover table-responsive">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('main.comment_data') }}</th>
                    <th scope="col-6">{{ __('main.comment_text') }}</th>
                    <th scope="col">{{ __('main.comment_published_status') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($comments as $index => $comment)
                <tr>
                    <td class="col-1">
                        {{$comment->id}}
                    </td>
                    <td scope="col-2">
                        <b>{{$comment->name}}</b><br />
                        <b><i>{{$comment->email}}</i></b><br />
                        <a href="article-edit?article_id={{$comment->article->id}}">{{$comment->article->title}}</a>
                    </td>
                    <td>
                        <div wire:key="{{ $comment->id }}">
                            <p wire:ignore>{!! $comment->description !!}</p>
                        </div>
                    </td>
                    <td class="col-6">
                            <label class="switch">
                                @if($comments[$index]->published == 1)
                                <input type="checkbox" value="true" checked wire:click="changeStatus({{ $comment->id }})">
                                @else
                                    <input type="checkbox" value="false" wire:click="changeStatus({{ $comment->id }})">
                                @endif
                                <span class="slider"></span>
                            </label>
                    </td>
                    <td>
                        <br/>
                        <button wire:click="openModuleCommentDelete({{$comment}})" type="button" class="btn btn-danger">
                            <i class="fa-solid fa-trash" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            <div class="mt-2">
                {{ $comments->links() }}
            </div>
            @else
                <span>{{__('main.no_comments')}}</span>
                <br />
                <span><a href="/add-comment"><button class="btn btn-primary mt-2">{{__('main.comment_new')}}</button></a></span>
    @endif
</div>
<style>
    /* The switch - the box around the slider */
    .switch {
        font-size: 17px;
        position: relative;
        display: inline-block;
        width: 3.5em;
        height: 2em;
    }

    /* Hide default HTML checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        inset: 0;
        border: 2px solid #414141;
        border-radius: 50px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 1.4em;
        width: 1.4em;
        left: 0.2em;
        bottom: 0.2em;
        background-color: white;
        border-radius: inherit;
        transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
    }

    .switch input:checked + .slider {
        box-shadow: 0 0 20px rgba(9, 117, 241, 0.8);
        border: 2px solid #0974f1;
    }

    .switch input:checked + .slider:before {
        transform: translateX(1.5em);
    }
    .leading-5 svg{
        max-height: 25px;
    }
</style>
