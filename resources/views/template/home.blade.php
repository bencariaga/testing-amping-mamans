<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AMPING-MAMANS | @yield('title')</title>

        <link rel="icon" href="{{ asset('images/amping-logo-white.png') }}" type="image/x-icon">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
        <link href="{{ asset('css/miscellaneous/theme-toggler.css') }}" rel="stylesheet">
        <link href="{{ asset('css/authentication/home.css') }}" rel="stylesheet">
        @yield('styles')
    </head>

    <body style="background-image: url('{{ asset('images/amping-office.png') }}'); background-size: cover; background-repeat: no-repeat; background-position: center center;">
        <button class="theme-toggle" id="themeToggle" title="Toggle dark mode.">
            <i class="fas fa-moon"></i>
        </button>

        <div class="amping-container">
            <div class="content-wrapper">
                @yield('extra-image')
                <div class="form-section @yield('form-wrapper-class')">
                    <div class="header-text text-center">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('images/amping-logo.png') }}"
                                 alt="AMPING logo"
                                 class="logo-img">
                        </a>

                        <h1 class="fw-bold amping-title">A . M . P . I . N . G</h1>

                        <p class="small fw-bold info-text">
                            Auxiliaries and Medical Program for Individuals and Needy Generals
                        </p>
                        <p class="small fw-bold info-text">
                            GSC Training Center beside Post Office, Roxas Avenue
                        </p>
                        <p class="small fw-bold info-text">
                            General Santos City, Philippines | Monday to Sunday | 8:00 AM to 5:00 PM
                        </p>
                    </div>

                    @yield('content')

                    @if ($errors->any())
                        <div class="text-center small error-message mt-4">
                            @foreach ($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="text-center small alert alert-success mt-4">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/miscellaneous/theme-toggler.js') }}"></script>
        @yield('scripts')
    </body>
</html>