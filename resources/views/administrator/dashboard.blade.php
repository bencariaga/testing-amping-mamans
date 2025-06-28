@extends('template.personal-page')

@section('title', 'Dashboard')

@push('styles')
    <link href="{{ asset('css/dashboard/dashboard.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('js/miscellaneous/dashboard.js') }}"></script>
@endpush

@section('breadcrumbs')
    <a href="{{ route('administrator.dashboard') }}" class="text-decoration-none text-reset">Dashboard</a>
@endsection

@section('content')
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 fw-bold overview-heading ps-1">Welcome back! Here is the overview.</h1>
        <div class="d-flex gap-2">
            <select class="form-select fw-bold form-select-sm w-auto ps-3 date-dropdown-custom" id="yearSelect">
                <option value="2025">2025</option>
                <option value="2024">2024</option>
                <option value="2023">2023</option>
                <option value="2022">2022</option>
                <option value="2021">2021</option>
                <option value="2020">2020</option>
                <option value="2019">2019</option>
                <option value="2018">2018</option>
            </select>
            <select class="form-select fw-bold form-select-sm w-auto ps-3 date-dropdown-custom" id="monthSelect">
            </select>
            <select class="form-select fw-bold form-select-sm w-auto ps-3 date-dropdown-custom" id="daySelect">
            </select>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <a href="{{ route('allocate-budget') }}" class="text-decoration-none text-reset">
                <div class="card-budget h-100">
                    <div class="card-title-custom">Allocated Budget:</div>
                    <div class="card-amount-custom">PHP 500,000,000.00</div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('expense-history') }}" class="text-decoration-none text-reset">
                <div class="card-budget h-100">
                    <div class="card-title-custom">Budget Amount Used:</div>
                    <div class="card-amount-custom">PHP 376,543,210.88</div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('budget-statistics') }}" class="text-decoration-none text-reset">
                <div class="card-budget h-100">
                    <div class="card-title-custom">Remaining Budget:</div>
                    <div class="card-amount-custom">PHP 123,456,789.12</div>
                </div>
            </a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <a href="{{ route('data-record-counting-year') }}" class="text-decoration-none text-reset">
                <div class="card-budget h-100">
                    <div class="card-title-custom">Data Record Counting Year:</div>
                    <div class="card-amount-custom">2025</div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('gl-list') }}" class="text-decoration-none text-reset">
                <div class="card-budget h-100">
                    <div class="card-title-custom">Guarantee Letters Released:</div>
                    <div class="d-flex justify-content-between mt-3">
                        <div>
                            <div class="card-subtitle-custom">Total:</div>
                            <div class="card-subamount-custom">12,345</div>
                        </div>
                        <div>
                            <div class="card-subtitle-custom">Today:</div>
                            <div class="card-subamount-custom">200</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('apply-sb') }}" class="text-decoration-none text-reset">
                <div class="card-budget h-100">
                    <div class="card-title-custom">Supplementary Budget Used:</div>
                    <div class="card-amount-custom text-danger">NO</div>
                </div>
            </a>
        </div>
    </div>
@endsection