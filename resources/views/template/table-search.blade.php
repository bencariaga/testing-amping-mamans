@props([
    'formId',
    'searchPlaceholder' => 'Search...',
    'currentSearchValue' => '',
    'showSort' => false,
    'sortOptions' => [],
    'currentPerPageValue' => 10,
    'paginationData'
])

@push('styles')
    <link href="{{ asset('css/miscellaneous/table-search.css') }}" rel="stylesheet">
@endpush

<div class="d-flex flex-wrap align-items-center justify-content-between mb-3 gap-3">
    <div class="common-search-input-group me-4">
        <div class="input-group">
            <input
                type="text"
                id="search"
                name="search"
                class="form-control fw-bold"
                placeholder="{{ $searchPlaceholder }}"
                value="{{ $currentSearchValue }}"
            >
            <button class="btn btn-primary fw-bold" type="submit">Search</button>
        </div>
    </div>

    @if($showSort)
        <div class="common-sort-selector d-flex align-items-center ms-5 gap-2">
            <label for="sort_by" class="form-label fw-bold mb-0">Sort:</label>
            <select name="sort_by" id="sort_by" class="form-select form-select-sm fw-bold ps-3" onchange="document.getElementById('{{ $formId }}').submit()">
                @foreach($sortOptions as $option)
                    <option value="{{ $option['value'] }}" @if($option['selected']) selected @endif>{{ $option['display'] }}</option>
                @endforeach
            </select>
        </div>
    @endif

    <div class="common-items-per-page-selector d-flex align-items-center ms-5 gap-2">
        <label for="per_page" class="form-label fw-bold mb-0">Rows per page:</label>
        <select name="per_page" id="per_page" class="form-select form-select-sm fw-bold ps-3" onchange="document.getElementById('{{ $formId }}').submit()">
            <option value="10" @if($currentPerPageValue == 10) selected @endif>10</option>
            <option value="20" @if($currentPerPageValue == 20) selected @endif>20</option>
            <option value="50" @if($currentPerPageValue == 50) selected @endif>50</option>
            <option value="100" @if($currentPerPageValue == 100) selected @endif>100</option>
            <option value="all" @if($currentPerPageValue == 'all') selected @endif>All</option>
        </select>
    </div>

    <div class="common-pagination-info-buttons d-flex align-items-center gap-2 ms-auto">
        @if($paginationData instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <span class="fw-bold" id="pageInfo">{{ $paginationData->firstItem() }}-{{ $paginationData->lastItem() }} of {{ $paginationData->total() }}</span>
            <a href="{{ $paginationData->previousPageUrl() }}" class="btn btn-outline-secondary fw-bold @if(!$paginationData->onFirstPage()) active @else disabled @endif">Previous</a>
            <a href="{{ $paginationData->nextPageUrl() }}" class="btn btn-outline-secondary fw-bold @if($paginationData->hasMorePages()) active @else disabled @endif">Next</a>
        @else
            <span class="fw-bold" id="pageInfo">Showing all {{ count($paginationData) }} items</span>
            <a href="#" class="btn btn-outline-secondary fw-bold disabled">Previous</a>
            <a href="#" class="btn btn-outline-secondary fw-bold disabled">Next</a>
        @endif
    </div>
</div>