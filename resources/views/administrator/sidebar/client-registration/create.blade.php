@extends('template.personal-page')

@section('title', 'Registration Form')

@push('styles')
	<link href="{{ asset('css/sidebar/client-registration/create.css') }}" rel="stylesheet">
@endpush

@push('scripts')
	<script src="{{ asset('js/sidebar/client-registration/create.js') }}"></script>
@endpush

@section('breadcrumbs')
	<a href="{{ route('client-list') }}" class="text-decoration-none text-reset">Client List</a> &gt; 
	<a href="{{ route('client.registration.create') }}" class="text-decoration-none text-reset">Client Profile</a>
@endsection

@section('content')
	<div class="container pt-3">
		<form id="regForm" action="{{ route('client.profile.store') }}" method="POST" autocomplete="off" class="needs-validation" novalidate enctype="multipart/form-data">
			@csrf
			<div class="d-flex justify-content-between align-items-center mb-4">
				<h2 id="regFormTitle" class="fw-bold">Registration Form</h2>
				<div class="d-flex gap-3">
					<a href="{{ route('client-list') }}" class="text-decoration-none text-reset">
						<button type="button" id="prevBtn" class="btn btn-secondary fw-bold px-4">BACK</button>
					</a>
					<button type="submit" id="nextBtn" class="btn btn-primary fw-bold px-4">SUBMIT</button>
				</div>
			</div>
			@include('administrator.sidebar.client-registration.create-top')
			@include('administrator.sidebar.client-registration.create-bottom')
		</form>
	</div>
@endsection