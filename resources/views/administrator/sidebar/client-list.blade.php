@extends('template.personal-page')

@section('title', 'Client List')

@push('styles')
	<link href="{{ asset('css/sidebar/client-list.css') }}" rel="stylesheet">
	<link href="{{ asset('css/miscellaneous/table-search.css') }}" rel="stylesheet">
@endpush

@push('scripts')
	<script src="{{ asset('js/miscellaneous/table-search.js') }}"></script>
@endpush

@section('breadcrumbs')
	<a href="{{ route(strtolower(Auth::user()->role) . '.dashboard') }}" class="text-decoration-none text-reset">Dashboard</a> &gt; 
	<a href="{{ route('client-list') }}" class="text-decoration-none text-reset">Client List</a>
@endsection

@section('content')
	<div class="container-fluid py-4">
		<div class="controls-wrapper">
			<form id="filterForm" method="GET" action="{{ route('client-list') }}">
				<div class="controls-grid mb-4">
					@include('template.table-search', [
						'formId' => 'filterForm',
						'searchPlaceholder' => 'Search in the Client List',
						'currentSearchValue' => request('search'),
						'showSort' => true,
						'sortOptions' => [
							['value'=>'name_asc',  'display'=>'Surname', 'selected'=>(request('sort_by','name_asc')=='name_asc')],
							['value'=>'latest',    'display'=>'Latest',  'selected'=>(request('sort_by')=='latest')],
							['value'=>'oldest',    'display'=>'Oldest',  'selected'=>(request('sort_by')=='oldest')],
						],
						'currentPerPageValue' => request('per_page',10),
						'paginationData'      => $clients
					])
				</div>
				@foreach(request()->except(['page','per_page','sort_by','search']) as $key=>$value)
					<input type="hidden" name="{{ $key }}" value="{{ $value }}">
				@endforeach
			</form>
		</div>
		<div class="grid-container mb-4">
			<div class="grid-row">
				<div class="grid-cell">
					<div class="d-flex align-items-center gap-2">
						<label class="date-picker-label fw-bold">From:</label>
						<select class="form-select form-select-sm fw-bold w-auto date-dropdown-custom" id="startYearSelect" name="start_year"></select>
						<select class="form-select form-select-sm fw-bold w-auto date-dropdown-custom" id="startMonthSelect" name="start_month"></select>
						<select class="form-select form-select-sm fw-bold w-auto date-dropdown-custom" id="startDaySelect" name="start_day"></select>
					</div>
				</div>
				<div class="grid-cell">
					<div class="d-flex align-items-center gap-2">
						<label id="to" class="date-picker-label fw-bold">To:</label>
						<select class="form-select form-select-sm fw-bold w-auto date-dropdown-custom" id="endYearSelect" name="end_year"></select>
						<select class="form-select form-select-sm fw-bold w-auto date-dropdown-custom" id="endMonthSelect" name="end_month"></select>
						<select class="form-select form-select-sm fw-bold w-auto date-dropdown-custom" id="endDaySelect" name="end_day"></select>
					</div>
				</div>
			</div>
			<div id="buttons" class="grid-item d-flex align-items-center ms-3">
                <a href="{{ route('client.registration.create') }}" class="btn btn-success fw-bold me-4">New Clients</a>
				<a href="{{ route('client.registration.create') }}" id="composeFormBtn" class="btn btn-success fw-bold ms-4">Old Clients</a>
            </div>
		</div>
		<div class="table-responsive shadow-sm mt-3 mb-5">
			<table class="common-table">
				<thead>
					<tr>
						<th>Client No.</th>
						<th>Client Name</th>
						<th>Phone Number</th>
						<th>Age</th>
						<th>Time Registered</th>
					</tr>
				</thead>
				<tbody>
					@forelse($clients as $client)
						<tr onclick="window.location='{{ route('client.profile.show',$client->client_id) }}'" style="cursor:pointer">
							<td class="font-semibold">{{ $client->client_id }}</td>
							<td class="font-semibold">{{ $client->surname }}, {{ $client->given_name }}{{ $client->middle_name ? ' ' . strtoupper(substr($client->middle_name, 0, 1)) . '.' : '' }}</td>
							<td class="font-semibold">{{ $client->phone_number ?? '—' }}</td>
							<td class="font-semibold">{{ $client->age }}</td>
							<td class="font-semibold">{{ \Carbon\Carbon::parse($client->time_registered)->format('m/d/y | h:i:s A') }}</td>
						</tr>
					@empty
						<tr>
							<td colspan="5" class="text-center p-3 font-semibold">No clients found.</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</div>
	</div>
@endsection