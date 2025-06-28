@extends('template.personal-page')

@section('title', 'User List')

@push('styles')
    <link href="{{ asset('css/sidebar/user-list.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('js/miscellaneous/table-search.js') }}"></script>
@endpush

@section('breadcrumbs')
    <a href="{{ route(strtolower(Auth::user()->role) . '.dashboard') }}" class="text-decoration-none text-reset">Dashboard</a> &gt; 
    <a href="{{ route('user-list') }}" class="text-decoration-none text-reset">User List</a>
@endsection

@section('content')
    <div class="container-fluid py-4">
        <div class="controls-wrapper">
            <form id="filterForm" method="GET" action="{{ route('user-list') }}">
                <div class="controls-grid">
                    @include('template.table-search', [
                        'formId' => 'filterForm',
                        'searchPlaceholder' => 'Search in the User List',
                        'currentSearchValue' => request('search'),
                        'showSort' => true,
                        'sortOptions' => [
                            ['value' => 'username_asc', 'display' => 'Surname', 'selected' => request('sort_by', 'username_asc') == 'username_asc'],
                            ['value' => 'role_asc', 'display' => 'Role', 'selected' => request('sort_by') == 'role_asc'],
                            ['value' => 'latest', 'display' => 'Latest', 'selected' => request('sort_by') == 'latest'],
                            ['value' => 'oldest', 'display' => 'Oldest', 'selected' => request('sort_by') == 'oldest']
                        ],
                        'currentPerPageValue' => request('per_page', 10),
                        'paginationData' => $users
                    ])
                </div>
                @foreach(request()->except(['page', 'per_page', 'sort_by', 'search']) as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach
            </form>
        </div>
        <div class="table-responsive shadow-sm mt-4 mb-5">
            <table class="common-table">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Phone Number</th>
                        <th>Role</th>
                        <th>Date Registered</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr @if(isset($user->is_active_row) && $user->is_active_row) class="active-row" @endif>
                            <td class="font-semibold">{{ $user->user_id }}</td>
                            <td class="font-semibold">{{ $user->username }}</td>
                            <td class="font-semibold">{{ $user->phone_number }}</td>
                            <td class="font-semibold">{{ ucfirst($user->role) }}</td>
                            <td class="font-semibold">{{ \Carbon\Carbon::parse($user->time_registered)->format('m/d/y | h:i:s A') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center p-3 font-semibold">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection