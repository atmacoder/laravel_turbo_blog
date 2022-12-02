
<div>
    <!-- Modal -->

    <div  wire:ignore.self class="modal fade" id="categoryDeleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="categoryDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="categoryDeleteModalLabel">Delete category {{$category_title}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure want to delete {{$category_title}} category?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button wire:click="deleteCategory({{$category_id}})" type="button" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            Livewire.on('activateModalDelete', () => {
                const myModal = new bootstrap.Modal('#categoryDeleteModal', {
                    keyboard: false,
                    fade:true,
                })
                myModal.show();
            })
        }

    </script>

</div>
