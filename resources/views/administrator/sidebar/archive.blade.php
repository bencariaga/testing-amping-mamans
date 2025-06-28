@extends('template.personal-page')

@section('title', 'Archive')

@section('breadcrumbs')
    <a href="{{ route(strtolower(Auth::user()->role) . '.dashboard') }}" class="text-decoration-none text-reset">Dashboard</a>
    <span class="px-1">/</span>
    <a href="{{ route('archive') }}" class="text-decoration-none text-reset">Archive</a>
@endsection

@section('content')
    <h1>Archive Page</h1>
    {{-- Content for archive goes here --}}
@endsection