@extends('template.home')

@section('title', 'Login')

@section('styles')
    <link href="{{ asset('css/authentication/authentication.css') }}" rel="stylesheet">
@endsection

@section('extra-image')
    <div class="image-section">
        <img src="{{ asset('images/medical-assistance-monitoring-and-notification-symbols.png') }}"
             alt="Medical Assistance, Monitoring and Notification Symbols"
             class="left-main-image">
    </div>
@endsection

@section('form-wrapper-class', '')

@section('content')
    <form class="form-container" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="form-group">
            <input type="number"
                   name="contact_number"
                   class="form-control mb-3"
                   placeholder="Phone Number"
                   value="{{ old('contact_number') }}"
                   required>
        </div>
        <div class="form-group">
            <input type="password"
                   name="password"
                   class="form-control mb-3"
                   placeholder="Password"
                   required>
        </div>

        <a href="{{ route('change-password') }}" class="forgot-link fw-semibold text-decoration-none">
            Forgot Password?
        </a>

        <div class="action-buttons d-flex flex-column flex-md-row justify-content-center align-items-center w-100 my-1 gap-3">
            <a href="{{ route('signup') }}" class="btn btn-primary btn-action fw-bold w-75 w-md-25 text-center">
                SIGN UP
            </a>
            <button type="submit" class="btn btn-primary btn-action fw-bold w-75 w-md-25">
                LOG IN
            </button>
        </div>
    </form>
@endsection