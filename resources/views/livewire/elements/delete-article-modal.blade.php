
<div>
    <!-- Modal -->

    <div  wire:ignore.self class="modal fade" id="articleDeleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="categoryDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="categoryDeleteModalLabel">{{__('main.delete_article')}}? {{$article_name}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{__('main.delete_article_sure')}}
                    {{__('main.article')}}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">{{__('main.no')}}</button>
                    <button wire:click="deleteArticle({{$article_id}})" type="button" class="btn btn-danger">{{__('main.yes')}}</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            Livewire.on('activateModalArticleDelete', () => {
                const myModal = new bootstrap.Modal('#articleDeleteModal', {
                    keyboard: false,
                    fade:true,
                })
                myModal.show();
            })
        }

    </script>

</div>
