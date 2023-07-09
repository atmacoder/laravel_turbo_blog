<div>
    <!-- Modal -->
    <div  wire:ignore.self class="modal fade" id="commentDeleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="commentDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="commentDeleteModalLabel">{{ __('main.comment_delete') }} {{$comment_name}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ __('main.sure_delete') }} {{$comment_name}} {{ __('main.comment') }}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">{{ __('main.no') }}</button>
                    <button wire:click="deleteComment({{$comment_id}})" type="button" class="btn btn-danger">{{ __('main.yes') }}</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            Livewire.on('activateModalCommentDelete', () => {
                const myModal = new bootstrap.Modal('#commentDeleteModal', {
                    keyboard: false,
                    fade:true,
                })
                myModal.show();
            })
        }

    </script>

</div>
