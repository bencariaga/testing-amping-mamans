@extends('template.personal-page')

@section('title', 'Data Record Counting Year')

@section('breadcrumbs')
    <a href="{{ route('administrator.dashboard') }}" class="text-decoration-none text-reset">Dashboard</a>
    <span class="px-1">/</span>
    <a href="{{ route('data-record-counting-year') }}" class="text-decoration-none text-reset">Data Record Counting Year</a>
@endsection

@section('content')
    <h1>Data Record Counting Year Page</h1>
    {{-- Content for data record counting year goes here --}}
@endsection