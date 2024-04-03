
<div>
    <!-- Modal -->

    <div  wire:ignore.self class="modal fade" id="userDeleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="userDeleteModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="userDeleteModalLabel">{{__('main.deleting_user')}} {{$user_name}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{__('main.delete_user_sure')}} {{$user_name}} {{__('main.user')}}?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">{{__('main.no')}}</button>
                    <button wire:click="deleteUser({{$user_id}})" type="button" class="btn btn-danger">{{__('main.yes')}}</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            Livewire.on('activeModuleDeleteUser', () => {
                const myModal = new bootstrap.Modal('#userDeleteModal', {
                    keyboard: false,
                    fade:true,
                })
                myModal.show();
            })
        }

    </script>

</div>
