@extends('template.personal-page')

@section('title', 'Supplementary Budget')

@section('breadcrumbs')
    <a href="{{ route('administrator.dashboard') }}" class="text-decoration-none text-reset">Dashboard</a>
    <span class="px-1">/</span>
    <a href="{{ route('apply-sb') }}" class="text-decoration-none text-reset">Apply Supplementary Budget</a>
@endsection

@section('content')
    <h1>Apply Supplementary Budget Page</h1>
    {{-- Content for applying supplementary budget goes here --}}
@endsection