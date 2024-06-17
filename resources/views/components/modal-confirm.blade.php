<div class="modal fade" id="{{ isset($id) ? $id : 'modal' }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="height: 100%">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                @if(isset($slot))
                    {{ $slot }}
                @endif
            </div>
            <div class="modal-footer border-0 pt-0">
                @if(isset($footer))
                    {{ $footer }}
                @else
                    <button type="button" class="btn btn-secondary" id="close-modal">Close</button>
                    <button type="submit" id="confirm-success" class="btn btn-primary">Save changes</button>
                @endif
            </div>
        </div>
    </div>
</div>
