@extends('template.personal-page')

@section('title', 'Guarantee Letter List')

@push('styles')
    <link href="{{ asset('css/dashboard/gl-list.css') }}" rel="stylesheet">
    <link href="{{ asset('css/miscellaneous/table-search.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('js/miscellaneous/table-search.js') }}"></script>
@endpush

@section('breadcrumbs')
    <a href="{{ route(strtolower(Auth::user()->role) . '.dashboard') }}" class="text-decoration-none text-reset">Dashboard</a> &gt; 
    <a href="{{ route('gl-list') }}" class="text-decoration-none text-reset">GL List</a>
@endsection

@section('content')
    <div class="container-fluid py-4">
        <form id="filterForm" method="GET" action="{{ route('gl-list') }}">
            <div class="grid-container mb-4">
                <div class="grid-row">
                    <div class="grid-cell">
                        <div class="common-search-input-group">
                            <div class="input-group">
                                <input
                                    type="text"
                                    id="search"
                                    name="search"
                                    class="form-control fw-bold"
                                    placeholder="Search in the GL List"
                                    value="{{ request('search') }}"
                                >
                                <button class="btn btn-primary fw-bold" type="submit">Search</button>
                            </div>
                        </div>
                    </div>

                    <div class="grid-cell">
                        <div class="d-flex align-items-center gap-3">
                            <span class="fw-bold">Rows:</span>
                            <select name="per_page" id="per_page" class="form-select form-select-sm fw-bold date-dropdown-custom" onchange="document.getElementById('filterForm').submit()">
                                <option value="10"  @if(request('per_page',10)==10) selected @endif>10</option>
                                <option value="20"  @if(request('per_page')==20) selected @endif>20</option>
                                <option value="50"  @if(request('per_page')==50) selected @endif>50</option>
                                <option value="100" @if(request('per_page')==100) selected @endif>100</option>
                                <option value="all" @if(request('per_page')=='all') selected @endif>All</option>
                            </select>
                            <span class="fw-bold">per page</span>
                        </div>
                    </div>

                    <div class="grid-cell">
                        <div class="d-flex align-items-center gap-2">
                            <label class="date-picker-label fw-bold">From:</label>
                            <select class="form-select fw-bold form-select-sm w-auto ps-3 date-dropdown-custom" id="startYearSelect" name="start_year"></select>
                            <select class="form-select fw-bold form-select-sm w-auto ps-3 date-dropdown-custom" id="startMonthSelect" name="start_month"></select>
                            <select class="form-select fw-bold form-select-sm w-auto ps-3 date-dropdown-custom" id="startDaySelect" name="start_day"></select>
                        </div>
                    </div>
                </div>

                <div class="grid-row">
                    <div class="grid-cell">
                        <div class="d-flex align-items-center gap-3">
                            <span class="fw-bold">Sort:</span>
                            <select name="sort_by" id="sort_by" class="form-select form-select-sm fw-bold date-dropdown-custom me-5" onchange="document.getElementById('filterForm').submit()">
                                <option value="gl_id_asc" @if(request('sort_by','gl_id_asc')=='gl_id_asc') selected @endif>GL No.</option>
                                <option value="date_desc" @if(request('sort_by')=='date_desc') selected @endif>Date Applied (Newest)</option>
                                <option value="date_asc" @if(request('sort_by')=='date_asc') selected @endif>Date Applied (Oldest)</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid-cell">
                        <div class="pagination-info-buttons">
                            @if($letters instanceof \Illuminate\Pagination\LengthAwarePaginator)
                                <span class="me-3 fw-bold">{{ $letters->firstItem() }}-{{ $letters->lastItem() }} of {{ $letters->total() }}</span>
                                <a href="{{ $letters->previousPageUrl() }}" class="btn btn-outline-secondary fw-bold @if(!$letters->onFirstPage()) active @else disabled @endif">Previous</a>
                                <a href="{{ $letters->nextPageUrl() }}" class="btn btn-outline-secondary fw-bold @if($letters->hasMorePages()) active @else disabled @endif">Next</a>
                            @else
                                <span class="me-3 fw-bold">Showing all {{ count($letters) }} items</span>
                                <a href="#" class="btn btn-outline-secondary fw-bold disabled">Previous</a>
                                <a href="#" class="btn btn-outline-secondary fw-bold disabled">Next</a>
                            @endif
                        </div>
                    </div>

                    <div class="grid-cell">
                        <div class="d-flex align-items-center gap-2">
                            <label class="date-picker-label fw-bold">To:</label>
                            <select class="form-select fw-bold form-select-sm w-auto ps-3 date-dropdown-custom" id="endYearSelect" name="end_year"></select>
                            <select class="form-select fw-bold form-select-sm w-auto ps-3 date-dropdown-custom" id="endMonthSelect" name="end_month"></select>
                            <select class="form-select fw-bold form-select-sm w-auto ps-3 date-dropdown-custom" id="endDaySelect" name="end_day"></select>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="table-responsive shadow-sm mt-3 mb-5">
            <table class="common-table">
                <thead>
                    <tr>
                        <th>GL No.</th>
                        <th>Beneficiary</th>
                        <th>Med. Assist. Type</th>
                        <th>App. No.</th>
                        <th>Need. Mny. Amt.</th>
                        <th>Assist. Mny. Amt.</th>
                        <th>Date Applied</th>
                        <th>App. Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($letters as $letter)
                        <tr>
                            <td class="font-semibold">{{ $letter->gl_id }}</td>
                            <td class="font-semibold">{{ $letter->beneficiary }}</td>
                            <td class="font-semibold">{{ $letter->med_type }}</td>
                            <td class="font-semibold">{{ $letter->app_id }}</td>
                            <td class="font-semibold">{{ number_format($letter->needed_mny_amt,2) }}</td>
                            <td class="font-semibold">{{ number_format($letter->assist_mny_amt,2) }}</td>
                            <td class="font-semibold">{{ \Carbon\Carbon::parse($letter->app_date)->format('m/d/y | h:i:s A') }}</td>
                            <td class="font-semibold">{{ $letter->app_status }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center p-3 font-semibold">No guarantee letters found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection