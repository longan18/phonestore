<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="height: 100%">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $title }}</h5>
            </div>
            <div class="modal-body">
                @if(isset($slot))
                    {{ $slot }}
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="close-modal">Close</button>
                <button type="submit" id="submit-address-shipping" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
