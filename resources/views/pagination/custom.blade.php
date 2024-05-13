<div class="row justify-content-between">
    <div class="col-sm-12 col-md-5">
        <div class="dataTables_info" id="sampleTable_info" role="status" aria-live="polite">
            {{ __('Hiển thị:') . ' ' . $paginator->count().'/'.$paginator->total(). ' ' . __('kết quả') }}
        </div>
    </div>
{{--    @dd($paginator, PAGE_RECORD,'Showing 1 to 10 of 57 entries')--}}
    <div class="col-sm-12 col-md-7">
        <div class="dataTables_paginate paging_simple_numbers d-flex justify-content-end">
            @if ($paginator->hasPages())
                <ul class="pagination">
                    @if ($paginator->onFirstPage())
                        <li class="paginate_button page-item previous disabled">
                            <a href="#" aria-controls="sampleTable" data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                        </li>
                    @else
                        <li class="paginate_button page-item previous">
                            <a href="{{ $paginator->previousPageUrl() }}" aria-controls="sampleTable"  data-dt-idx="0" tabindex="0" class="page-link">Previous</a>
                        </li>
                    @endif
                    @foreach ($elements as $element)
                        @if (is_string($element))
                            <li class="paginate_button page-item disabled">
                                <a href="#" aria-controls="sampleTable" data-dt-idx="1" tabindex="0" class="page-link">{{ $element }}</a>
                            </li>
                        @endif
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li class="paginate_button page-item active">
                                        <a href="#" aria-controls="sampleTable" data-dt-idx="{{ $page }}" tabindex="0" class="page-link">{{ $page }}</a>
                                    </li>
                                @else
                                    <li class="paginate_button page-item">
                                        <a href="{{ $url }}" aria-controls="sampleTable" data-dt-idx="{{ $page }}" tabindex="0" class="page-link">{{ $page }}</a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                    @if ($paginator->hasMorePages())
                        <li class="paginate_button page-item next" id="sampleTable_next">
                            <a href="{{ $paginator->nextPageUrl() }}" aria-controls="sampleTable" data-dt-idx="7" tabindex="0" class="page-link">Next</a>
                        </li>
                    @else
                        <li class="paginate_button page-item next disabled" id="sampleTable_next">
                            <a href="#" aria-controls="sampleTable" data-dt-idx="7" tabindex="0" class="page-link">Next</a>
                        </li>
                    @endif
                </ul>
            @endif
        </div>
    </div>
</div>
