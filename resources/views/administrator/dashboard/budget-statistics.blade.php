@extends('template.personal-page')

@section('title', 'Budget Statistics')

@section('breadcrumbs')
    <a href="{{ route('administrator.dashboard') }}" class="text-decoration-none text-reset">Dashboard</a>
    <span class="px-1">/</span>
    <a href="{{ route('budget-statistics') }}" class="text-decoration-none text-reset">Budget Statistics</a>
@endsection

@section('content')
    <h1>Budget Statistics Page</h1>
    {{-- Content for budget statistics goes here --}}
@endsection