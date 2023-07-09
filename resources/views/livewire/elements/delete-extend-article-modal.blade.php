
<div>
    <!-- Modal -->

    <div  wire:ignore.self class="modal fade" id="extendArticleDeleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="extendArticleDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="extendArticleDeleteModalLabel">{{__('main.delete_extend_article')}} {{$extend_article_name}} ?</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{__('main.delete_extend_article_sure')}}
                    {{__('main.extend_article')}}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">{{__('main.no')}}</button>
                    <button wire:click="deleteExtendArticle({{$extend_article_id}})" type="button" class="btn btn-danger">{{__('main.yes')}}</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            Livewire.on('activateModalExtendArticleDelete', () => {
                const myModal = new bootstrap.Modal('#extendArticleDeleteModal', {
                    keyboard: false,
                    fade:true,
                })
                myModal.show();
            })
        }

    </script>

</div>
