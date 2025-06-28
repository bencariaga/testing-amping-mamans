<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AMPING-MAMANS | @yield('title')</title>

        <link rel="icon" href="{{ asset('images/amping-logo-white.png') }}" type="image/x-icon">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
        <link href="{{ asset('css/miscellaneous/theme-toggler.css') }}" rel="stylesheet">
        <link href="{{ asset('css/miscellaneous/personal-page.css') }}" rel="stylesheet">
        @stack('styles')
    </head>

    <body class="d-flex flex-column min-vh-100">
        <div class="d-flex flex-grow-1">
            <aside id="sidebar" class="d-flex flex-column sidebar-v1">
                <div class="d-flex flex-column align-items-center py-2 px-3 border-bottom border-secondary">
                    <img alt="AMPING Logo" class="amping-logo" src="{{ asset('images/amping-logo.png') }}">
                    <p class="text-center small lh-sm mt-2 fw-semibold sidebar-brand-text">
                        <span class="line">Auxiliaries and Medical</span>
                        <span class="line">Program for Individuals</span>
                        <span class="line">and Needy Generals</span>
                    </p>
                </div>

                <nav class="d-flex flex-column mt-3 px-2 sidebar-nav">
                    <a class="nav-link text-white @if(request()->routeIs(strtolower(str_replace(' ', '-', Auth::user()->role)) . '.dashboard')) active @endif"
                       href="{{ route(strtolower(str_replace(' ', '-', Auth::user()->role)) . '.dashboard') }}">
                        <div class="nav-icon"><i class="fas fa-th-large fa-lg"></i></div>
                        <div class="nav-text">Dashboard</div>
                    </a>
                    <a class="nav-link text-white @if(request()->routeIs('notifications')) active @endif"
                       href="{{ route('notifications') }}">
                        <div class="nav-icon"><i class="fas fa-bell fa-lg"></i></div>
                        <div class="nav-text">Notifications</div>
                    </a>

                    @if(Auth::user()->role === 'Administrator')
                        <a class="nav-link text-white @if(request()->routeIs('user-list')) active @endif"
                           href="{{ route('user-list') }}">
                            <div class="nav-icon"><i class="fas fa-user fa-lg"></i></div>
                            <div class="nav-text">User List</div>
                        </a>
                        <a class="nav-link text-white @if(request()->routeIs('client-list')) active @endif"
                           href="{{ route('client-list') }}">
                            <div class="nav-icon"><i class="fas fa-users fa-lg"></i></div>
                            <div class="nav-text">Client List</div>
                        </a>
                        <a class="nav-link text-white @if(request()->routeIs('tariff-lists')) active @endif"
                           href="{{ route('tariff-lists') }}">
                            <div class="nav-icon"><i class="fas fa-file-invoice-dollar fa-lg"></i></div>
                            <div class="nav-text">Tariff Lists</div>
                        </a>
                        <a class="nav-link text-white @if(request()->routeIs('sms-presets')) active @endif"
                           href="{{ route('sms-presets') }}">
                            <div class="nav-icon"><i class="fas fa-comment-alt fa-lg"></i></div>
                            <div class="nav-text">SMS Presets</div>
                        </a>
                        <a class="nav-link text-white @if(request()->routeIs('logs-and-reports')) active @endif"
                           href="{{ route('logs-and-reports') }}">
                            <div class="nav-icon"><i class="fas fa-file-alt fa-lg"></i></div>
                            <div class="nav-text">Logs and Reports</div>
                        </a>
                        <a class="nav-link text-white @if(request()->routeIs('archive')) active @endif"
                           href="{{ route('archive') }}">
                            <div class="nav-icon"><i class="fas fa-archive fa-lg"></i></div>
                            <div class="nav-text">Archive</div>
                        </a>
                    @endif

                    @if(Auth::user()->role === 'Encoder')
                        <a class="nav-link text-white @if(request()->routeIs('client-list')) active @endif"
                           href="{{ route('client-list') }}">
                            <div class="nav-icon"><i class="fas fa-users fa-lg"></i></div>
                            <div class="nav-text">Client List</div>
                        </a>
                        <a class="nav-link text-white @if(request()->routeIs('archive')) active @endif"
                           href="{{ route('archive') }}">
                            <div class="nav-icon"><i class="fas fa-archive fa-lg"></i></div>
                            <div class="nav-text">Archive</div>
                        </a>
                    @endif

                    @if(Auth::user()->role === 'GL Operator')
                        <a class="nav-link text-white @if(request()->routeIs('tariff-lists')) active @endif"
                           href="{{ route('tariff-lists') }}">
                            <div class="nav-icon"><i class="fas fa-file-invoice-dollar fa-lg"></i></div>
                            <div class="nav-text">Tariff Lists</div>
                        </a>
                    @endif

                    @if(Auth::user()->role === 'SMS Operator')
                        <a class="nav-link text-white @if(request()->routeIs('sms-presets')) active @endif"
                           href="{{ route('sms-presets') }}">
                            <div class="nav-icon"><i class="fas fa-comment-alt fa-lg"></i></div>
                            <div class="nav-text">SMS Presets</div>
                        </a>
                    @endif

                    <a href="#" class="nav-link text-white" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <div class="nav-icon"><i class="fas fa-sign-out-alt fa-lg"></i></div>
                        <div class="nav-text">Log Out</div>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </nav>
            </aside>

            <main class="flex-grow-1 p-4 main-content-v2">
                <header class="d-flex justify-content-between align-items-center px-4 py-3 mb-4 navbar-top">
                    <h2 class="dashboard-title">
                        @yield('breadcrumbs')
                    </h2>

                    <div class="d-flex align-items-center gap-4">
                        <div class="surface-level-profile">
                            <div class="name">{{ Auth::user()->surname }}, {{ Auth::user()->given_name }} {{ Auth::user()->middle_name }}</div>
                            <div class="phone-number-role">{{ Auth::user()->phone_number }} | {{ Auth::user()->role }}</div>
                        </div>

                        @if(Auth::user()->profile_picture)
                            <a href="{{ route('user.profile.show') }}">
                                <img alt="User Avatar"
                                     class="profile-picture px-0 py-0 border border-white border-2"
                                     src="{{ asset('storage/' . Auth::user()->profile_picture) }}">
                            </a>
                        @else
                            <a href="{{ route('user.profile.show') }}"
                               class="profile-picture-placeholder rounded-circle bg-primary text-white d-flex align-items-center justify-content-center text-decoration-none">
                                {{ substr(Auth::user()->given_name, 0, 1) }}{{ substr(Auth::user()->surname, 0, 1) }}
                            </a>
                        @endif
                    </div>
                </header>

                @yield('content')
            </main>
        </div>

        <button class="theme-toggle" id="themeToggle" title="Toggle dark mode.">
            <i class="fas fa-moon"></i>
        </button>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/miscellaneous/theme-toggler.js') }}"></script>
        @stack('scripts')
    </body>
</html>