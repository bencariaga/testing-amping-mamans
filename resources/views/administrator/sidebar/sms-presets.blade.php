@extends('template.personal-page')

@section('title', 'SMS Presets')

@section('breadcrumbs')
    <a href="{{ route(strtolower(Auth::user()->role) . '.dashboard') }}" class="text-decoration-none text-reset">Dashboard</a>
    <span class="px-1">/</span>
    <a href="{{ route('sms-presets') }}" class="text-decoration-none text-reset">SMS Presets</a>
@endsection

@section('content')
    <h1>SMS Presets Page</h1>
    {{-- Content for SMS presets goes here --}}
@endsection