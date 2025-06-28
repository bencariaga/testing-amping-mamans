@extends('template.home')

@section('title', 'Signup')

@section('styles')
    <link href="{{ asset('css/authentication/signup.css') }}" rel="stylesheet">
@endsection

@section('extra-image')@endsection

@section('form-wrapper-class', 'w-100')

@section('content')
    <form class="registration-form" method="POST" action="{{ route('signup.post') }}" enctype="multipart/form-data">
        @csrf
        <h3 class="form-title text-center">Information of New Account</h3>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="given_name" class="form-label">
                        Given Name <span class="required-asterisk">*</span>
                    </label>
                    <input type="text"
                           id="given_name"
                           name="given_name"
                           class="form-control"
                           placeholder="Type your given name."
                           value="{{ old('given_name') }}"
                           required>
                </div>
                <div class="form-group mb-3">
                    <label for="middle_name" class="form-label">Middle Name</label>
                    <input type="text"
                           id="middle_name"
                           name="middle_name"
                           class="form-control"
                           placeholder="Type your middle name."
                           value="{{ old('middle_name') }}">
                </div>
                <div class="form-group mb-3">
                    <label for="surname" class="form-label">
                        Surname <span class="required-asterisk">*</span>
                    </label>
                    <input type="text"
                           id="surname"
                           name="surname"
                           class="form-control"
                           placeholder="Type your surname."
                           value="{{ old('surname') }}"
                           required>
                </div>
                <div class="form-group mb-3">
                    <label for="role" class="form-label">
                        Role <span class="required-asterisk">*</span>
                    </label>
                    <select id="role" name="role" class="form-select" required>
                        <option value="">Select your role in the AMPING.</option>
                        <option value="Administrator" {{ old('role') == 'Administrator' ? 'selected' : '' }}>Administrator</option>
                        <option value="Encoder" {{ old('role') == 'Encoder' ? 'selected' : '' }}>Encoder</option>
                        <option value="GL Operator" {{ old('role') == 'GL Operator' ? 'selected' : '' }}>GL Operator</option>
                        <option value="SMS Operator" {{ old('role') == 'SMS Operator' ? 'selected' : '' }}>SMS Operator</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="phone_number" class="form-label">
                        Phone Number <span class="required-asterisk">*</span>
                    </label>
                    <input type="number"
                           id="phone_number"
                           name="phone_number"
                           class="form-control"
                           placeholder="11 / 13 number digits; &quot;09&quot; / &quot;+639&quot; format."
                           value="{{ old('phone_number') }}"
                           required>
                </div>
                <div class="form-group mb-3">
                    <label for="password" class="form-label">
                        Set Password <span class="required-asterisk">*</span>
                    </label>
                    <input type="password"
                           id="password"
                           name="password"
                           class="form-control"
                           placeholder="Between A & Z, 0 & 9; no special characters."
                           required>
                </div>
                <div class="form-group mb-3">
                    <label for="password_confirmation" class="form-label">
                        Confirm Password <span class="required-asterisk">*</span>
                    </label>
                    <input type="password"
                           id="password_confirmation"
                           name="password_confirmation"
                           class="form-control"
                           placeholder="Repeat what the password you have typed."
                           required>
                </div>
                <div class="form-group mb-4">
                    <label for="profile_picture" class="form-label">
                        Profile Picture
                    </label>
                    <input type="file"
                           id="profile_picture"
                           name="profile_picture"
                           class="form-control file-input"
                           accept=".jpg,.jpeg,.jfif,.png">
                    <small class="form-text accepted-text">
                        Accepted Formats: JPG, JPEG, JFIF, PNG (Max: 8 MB)
                    </small>
                </div>
            </div>
        </div>
        <div class="action-buttons d-flex flex-column flex-md-row justify-content-center align-items-center w-100 my-1 gap-3">
            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-action fw-bold w-75 w-md-25 text-center">
                BACK TO LOGIN
            </a>
            <button type="submit" class="btn btn-primary btn-action fw-bold w-75 w-md-25">
                REGISTER
            </button>
        </div>
    </form>
@endsection