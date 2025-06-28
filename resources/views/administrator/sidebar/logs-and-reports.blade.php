@extends('template.personal-page')

@section('title', 'Logs and Reports')

@section('breadcrumbs')
    <a href="{{ route('administrator.dashboard') }}" class="text-decoration-none text-reset">Dashboard</a>
    <span class="px-1">/</span>
    <a href="{{ route('logs-and-reports') }}" class="text-decoration-none text-reset">Logs and Reports</a>
@endsection

@section('content')
    <h1>Logs and Reports Page</h1>
    {{-- Content for logs and reports goes here --}}
@endsection