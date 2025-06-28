@extends('template.personal-page')

@section('title', 'Allocate Budget')

@section('breadcrumbs')
    <a href="{{ route('administrator.dashboard') }}" class="text-decoration-none text-reset">Dashboard</a>
    <span class="px-1">/</span>
    <a href="{{ route('allocate-budget') }}" class="text-decoration-none text-reset">Allocate Budget</a>
@endsection

@section('content')
    <h1>Allocate Budget Page</h1>
    {{-- Content for allocating budget goes here --}}
@endsection