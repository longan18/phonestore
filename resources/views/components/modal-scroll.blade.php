<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="height: 100%">
    <div class="modal-dialog modal-dialog-scrollable" style="max-width: 1280px">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ $title }}</h5>
            </div>
            <div class="modal-body">
                @if(isset($slot))
                    {{ $slot }}
                @endif
            </div>
        </div>
    </div>
</div>
