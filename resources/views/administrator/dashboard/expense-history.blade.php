@extends('template.personal-page')

@section('title', 'Expense History')

@push('styles')
    <link href="{{ asset('css/dashboard/expense-history.css') }}" rel="stylesheet">
    <link href="{{ asset('css/miscellaneous/table-search.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('js/miscellaneous/table-search.js') }}"></script>
@endpush

@section('breadcrumbs')
    <a href="{{ route(strtolower(Auth::user()->role) . '.dashboard') }}" class="text-decoration-none text-reset">Dashboard</a> &gt; 
    <a href="{{ route('expense-history') }}" class="text-decoration-none text-reset">Expense History</a>
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="controls-wrapper">
            <div class="date-range-container">
                <form id="filterForm" method="GET" action="{{ route('expense-history') }}">
                    <div class="search-container mb-3">
                        <div class="input-group">
                            <input
                                type="text"
                                id="search"
                                name="search"
                                class="form-control fw-bold"
                                placeholder="Search in the Expense History"
                                value="{{ request('search') }}"
                            >
                            <button class="btn btn-primary fw-bold" type="submit">Search</button>
                        </div>
                    </div>
                    <div class="date-picker-group mb-2 fw-bold">
                        <label class="date-picker-label text-end">From:</label>
                        <select class="form-select form-select-sm fw-bold" id="startYearSelect" name="start_year"></select>
                        <select class="form-select form-select-sm fw-bold" id="startMonthSelect" name="start_month"></select>
                        <select class="form-select form-select-sm fw-bold" id="startDaySelect" name="start_day"></select>
                    </div>
                    <div class="date-picker-group fw-bold">
                        <label class="date-picker-label text-end">To:</label>
                        <select class="form-select form-select-sm fw-bold" id="endYearSelect" name="end_year"></select>
                        <select class="form-select form-select-sm fw-bold" id="endMonthSelect" name="end_month"></select>
                        <select class="form-select form-select-sm fw-bold" id="endDaySelect" name="end_day"></select>
                    </div>
                </form>
                <div class="pagination-controls-container d-flex justify-content-between align-items-center mt-4">
                    <div class="items-per-page-selector">
                        <form id="perPageForm" method="GET" action="{{ route('expense-history') }}" class="d-flex align-items-center gap-2">
                            <input type="hidden" name="search" value="{{ request('search') }}">
                            <select name="per_page" id="viewCount" class="form-select form-select-sm fw-bold ps-3" onchange="document.getElementById('perPageForm').submit()">
                                <option value="10" @if(request('per_page',10)==10) selected @endif>10</option>
                                <option value="20" @if(request('per_page')==20) selected @endif>20</option>
                                <option value="50" @if(request('per_page')==50) selected @endif>50</option>
                                <option value="100" @if(request('per_page')==100) selected @endif>100</option>
                                <option value="all" @if(request('per_page')=='all') selected @endif>All</option>
                            </select>
                            <label for="viewCount" class="form-label fw-bold mb-0">rows per page</label>
                        </form>
                    </div>
                    <div class="pagination-info-buttons">
                        @if($expenses instanceof \Illuminate\Pagination\LengthAwarePaginator)
                            <span class="me-3 fw-bold" id="pageInfo">{{ $expenses->firstItem() }}-{{ $expenses->lastItem() }} of {{ $expenses->total() }}</span>
                            <a href="{{ $expenses->previousPageUrl() }}" class="btn btn-outline-secondary fw-bold @if(!$expenses->onFirstPage()) active @else disabled @endif">Previous</a>
                            <a href="{{ $expenses->nextPageUrl() }}" class="btn btn-outline-secondary fw-bold @if($expenses->hasMorePages()) active @else disabled @endif">Next</a>
                        @else
                            <span class="me-3 fw-bold" id="pageInfo">Showing all {{ count($expenses) }} items</span>
                            <a href="#" class="btn btn-outline-secondary fw-bold disabled">Previous</a>
                            <a href="#" class="btn btn-outline-secondary fw-bold disabled">Next</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="summary-container">
                <dl>
                    <div class="summary-item">
                        <dt>Allocated Budget:</dt>
                        <dd><span class="money-currency">PHP</span> <span class="money-value">10,000,000.00</span></dd>
                    </div>
                    <div class="summary-item">
                        <dt>Budget Amount Used:</dt>
                        <dd><span class="money-currency">PHP</span> <span class="money-value">2,507,957.00</span></dd>
                    </div>
                    <div class="summary-item total">
                        <dt>REMAINING BUDGET:</dt>
                        <dd><span class="money-currency">PHP</span> <span class="money-value">7,492,043.00</span></dd>
                    </div>
                </dl>
            </div>
        </div>
        <div class="table-responsive shadow-sm mt-4 mb-5">
            <table class="common-table">
                <thead>
                    <tr>
                        <th>Control No.</th>
                        <th>Medical Assistance Type</th>
                        <th>Application No.</th>
                        <th>Date in Effect</th>
                        <th class="money-amount-header">Assistance Money Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($expenses as $expense)
                        <tr @if(isset($expense->is_active_row) && $expense->is_active_row) class="active-row" @endif>
                            <td class="font-semibold">{{ $expense->exp_id }}</td>
                            <td class="font-semibold">{{ $expense->med_type }}</td>
                            <td class="font-semibold">{{ $expense->app_id }}</td>
                            <td class="font-semibold">{{ \Carbon\Carbon::parse($expense->app_date)->format('m/d/y | h:i:s A') }}</td>
                            <td class="money-amount-cell">
                                <span class="money-currency fw-bold">PHP&nbsp;&nbsp;&nbsp;&nbsp;</span>
                                <span class="money-value">{{ number_format($expense->assist_mny_amt, 2) }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center p-3 font-semibold">No expenses found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection