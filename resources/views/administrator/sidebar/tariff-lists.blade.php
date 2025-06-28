@extends('template.personal-page')

@section('title', 'Tariff Lists')

@push('styles')
<link href="{{ asset('css/sidebar/tariff-lists.css') }}" rel="stylesheet">
@endpush

@push('scripts')
<script src="{{ asset('js/sidebar/tariff-lists.js') }}"></script>
@endpush

@section('breadcrumbs')
<a href="{{ route('administrator.dashboard') }}" class="text-decoration-none text-reset">Dashboard</a> &gt;
<a href="{{ route('tariff-lists') }}" class="text-decoration-none text-reset">Tariff Lists</a>
@endsection

@section('content')
<div class="container-fluid py-4">
    <div class="toolbar d-flex justify-content-center align-items-center gap-3 mb-4">
        <button id="editUpdateBtn" class="btn btn-primary btn-action fw-bold" type="button">Edit Data</button>
        <form id="sortForm" method="GET" action="{{ route('tariff-lists') }}" class="m-0">
            <select name="sort" id="sortSelect" class="form-select form-select-sm fw-bold ps-3">
                <option value="range_lowest" @if(request('sort', 'range_lowest') == 'range_lowest') selected @endif>Expense Range (Lowest)</option>
                <option value="range_highest" @if(request('sort') == 'range_highest') selected @endif>Expense Range (Highest)</option>
            </select>
        </form>
    </div>
    <form id="tariffForm" class="mb-5" method="POST" action="{{ route('tariff-lists.update') }}">
        @csrf
        @method('PUT')
        <div class="row row-cols-1 row-cols-md-3 row-cols-lg-2 g-4">
            @foreach([
                'Hospital Bill',
                'Medical Prescription',
                'Laboratory Test',
                'Diagnostic Test',
                'Hemodialysis',
                'Blood Request',
            ] as $type)
                <div class="col">
                    <div class="shadow-sm tariff-section p-3 h-100">
                        <h2 class="section-title fw-bold text-center">{{ $type }}</h2>
                        <div class="table-responsive">
                            <table class="expense-table">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="money-amount-header text-center">Expense Range</th>
                                        <th rowspan="2" class="money-amount-header text-center">Monetary<br>Assistance<br>Amount</th>
                                    </tr>
                                    <tr>
                                        <th class="money-amount-header text-center">Minimum</th>
                                        <th class="money-amount-header text-center">Maximum</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($serviceLists[$type] ?? [] as $row)
                                        <tr>
                                            <td class="money-amount-cell">
                                                <div class="money-amount-container">
                                                    <span class="money-currency fw-bold">₱</span>
                                                    <input
                                                        type="text"
                                                        name="range_min[{{ $row->service_id }}]"
                                                        class="form-control form-control-sm range-input text-end money-value"
                                                        value="{{ number_format($row->exp_range_min, 2) }}"
                                                        readonly
                                                    >
                                                </div>
                                            </td>
                                            <td class="money-amount-cell">
                                                <div class="money-amount-container">
                                                    <span class="money-currency fw-bold">₱</span>
                                                    <input
                                                        type="text"
                                                        name="range_max[{{ $row->service_id }}]"
                                                        class="form-control form-control-sm range-input text-end money-value"
                                                        value="{{ number_format($row->exp_range_max, 2) }}"
                                                        readonly
                                                    >
                                                </div>
                                            </td>
                                            <td class="money-amount-cell">
                                                <div class="money-amount-container">
                                                    <span class="money-currency fw-bold">₱</span>
                                                    <input
                                                        type="text"
                                                        name="tariff_amount[{{ $row->service_id }}]"
                                                        class="form-control form-control-sm tariff-input text-end money-value"
                                                        value="{{ number_format((float) str_replace(',', '', $row->assist_amt), 2) }}"
                                                        readonly
                                                    >
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </form>
</div>
@endsection