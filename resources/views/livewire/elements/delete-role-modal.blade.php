
<div>
    <!-- Modal -->

    <div  wire:ignore.self class="modal fade" id="roleDeleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="roleDeleteModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="roleDeleteModalLabel">Delete role {{$role_name}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure want to delete {{$role_name}} role?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button wire:click="deleteRole({{$role_id}})" type="button" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            Livewire.on('activateModalDelete', () => {
                const myModal = new bootstrap.Modal('#roleDeleteModal', {
                    keyboard: false,
                    fade:true,
                })
                myModal.show();
            })
        }

    </script>

</div>
