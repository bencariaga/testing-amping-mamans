@extends('template.personal-page')

@section('title', 'User Profile')

@push('styles')
    <link href="{{ asset('css/miscellaneous/user-profile.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('js/miscellaneous/user-profile.js') }}"></script>
@endpush

@section('breadcrumbs')
    <a href="{{ route(strtolower(str_replace(' ', '-', Auth::user()->role)) . '.dashboard') }}"
       class="text-decoration-none text-reset">Dashboard</a> &gt;
    <a href="{{ route('user.profile.show') }}"
       class="text-decoration-none text-reset">User Profile</a>
@endsection

@section('content')
    <div class="container-fluid mt-4">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $e)
                        <div>{{ $e }}</div>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="profile-container">
            <div class="text-center mb-4">
                <div class="profile-pic-container">
                    @if($user->profile_picture)
                        <label class="profile-pic-wrapper">
                            <img src="{{ asset('storage/' . $user->profile_picture) }}"
                                 class="profile-pic">
                        </label>
                    @else
                        <label class="profile-pic-wrapper">
                            <div class="avatar-placeholder">
                                {{ substr($user->given_name, 0, 1) }}{{ substr($user->surname, 0, 1) }}
                            </div>
                        </label>
                    @endif
                </div>
                <div class="user-role">{{ $user->role }}</div>
            </div>

            <form method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="file"
                       name="profile_picture"
                       id="profile_picture_upload"
                       class="d-none">
                <input type="hidden"
                       name="remove_profile_picture_flag"
                       id="remove_profile_picture_flag"
                       value="0">

                <div class="profile-grid-container">
                    <div class="form-group">
                        <label class="form-label">Given Name <span class="required-asterisk">*</span></label>
                        <input type="text"
                               name="given_name"
                               class="form-control"
                               value="{{ old('given_name', $user->given_name) }}"
                               required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Middle Name</label>
                        <input type="text"
                               name="middle_name"
                               class="form-control"
                               value="{{ old('middle_name', $user->middle_name) }}">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Surname <span class="required-asterisk">*</span></label>
                        <input type="text"
                               name="surname"
                               class="form-control"
                               value="{{ old('surname', $user->surname) }}"
                               required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Phone Number <span class="required-asterisk">*</span></label>
                        <input type="text"
                               name="phone_number"
                               class="form-control"
                               value="{{ old('phone_number', $user->phone_number) }}"
                               required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Password <span class="required-asterisk">*</span></label>
                        <div class="input-group password-input-group">
                            <input type="password"
                                   id="password_display_current"
                                   class="form-control"
                                   value="{{ $user->plaintext_password }}"
                                   readonly>
                            <button type="button"
                                    class="btn btn-outline-secondary toggle-password"
                                    id="togglePassword">
                                <i class="bi bi-eye-fill"
                                   id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>
                    <div class="form-group button-container">
                        <button type="button"
                                class="btn btn-primary change-password-btn"
                                data-bs-toggle="modal"
                                data-bs-target="#changePasswordModal">
                            Change Password
                        </button>
                    </div>
                    <div class="form-group button-container">
                        <button type="button"
                                class="btn btn-danger delete-account-btn"
                                data-bs-toggle="modal"
                                data-bs-target="#deleteAccountModal">
                            Delete Account
                        </button>
                    </div>
                    <div class="form-group button-container">
                        <button type="button"
                                class="btn btn-secondary remove-profile-picture-btn">
                            Remove Profile Picture
                        </button>
                    </div>
                    <div class="form-group button-container">
                        <button type="submit"
                                class="btn btn-primary btn-action-update-profile">
                            Update Profile
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade"
         id="changePasswordModal"
         tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST"
                      action="{{ route('user.profile.update') }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden"
                           name="action"
                           value="change_password">
                    <div class="modal-header">
                        <h5 class="modal-title">Change Password</h5>
                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Current Password</label>
                            <input type="password"
                                   name="current_password"
                                   class="form-control"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password"
                                   name="new_password"
                                   class="form-control"
                                   required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirm New Password</label>
                            <input type="password"
                                   name="new_password_confirmation"
                                   class="form-control"
                                   required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="submit"
                                class="btn btn-primary">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade"
         id="deleteAccountModal"
         tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST"
                      action="{{ route('user.profile.destroy') }}">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Account</h5>
                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>
                            Are you sure you want to delete your account? This cannot be undone.
                        </p>
                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password"
                                   name="password_confirmation_delete"
                                   class="form-control"
                                   required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit"
                                class="btn btn-danger">
                            Delete Account
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection