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
                @endif
            </div>
        </div>
    </div>
</div>
