
<div>
    <!-- Modal -->

    <div  wire:ignore.self class="modal fade" id="permissionDeleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="permissionDeleteModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="permissionDeleteModalLabel"> {{ __('main.delete_permission') }}  {{$permission_name}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{ __('main.sure_delete') }} {{$permission_name}} ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">{{__('main.no')}}</button>
                    <button wire:click="deletepermission({{$permission_id}})" type="button" class="btn btn-danger">{{__('main.yes')}}</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            Livewire.on('activeModuleDeletePermission', () => {
                const myModal = new bootstrap.Modal('#permissionDeleteModal', {
                    keyboard: false,
                    fade:true,
                })
                myModal.show();
            })
        }

    </script>

</div>
