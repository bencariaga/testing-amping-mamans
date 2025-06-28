@extends('template.personal-page')

@section('title', 'Notifications')

@section('breadcrumbs')
    <a href="{{ route(strtolower(Auth::user()->role) . '.dashboard') }}" class="text-decoration-none text-reset">Dashboard</a>
    <span class="px-1">/</span>
    <a href="{{ route('notifications') }}" class="text-decoration-none text-reset">Notifications</a>
@endsection

@section('content')
    <h1>Notifications Page</h1>
    {{-- Content for notifications goes here --}}
@endsection