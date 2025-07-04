<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>AMPING-MAMANS</title>

        <link rel="icon" href="{{ asset('images/amping-logo-white.png') }}" type="image/x-icon">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
        <link href="{{ asset('css/miscellaneous/theme-toggler.css') }}" rel="stylesheet">
        <link href="{{ asset('css/authentication/welcome.css') }}" rel="stylesheet">
    </head>

    <body style="background-image: url('{{ asset('images/amping-office.png') }}'); background-size: contain; background-repeat: no-repeat; background-position: center center; min-height: 100vh; margin: 0; padding: 0;">
        <button class="theme-toggle" id="themeToggle" title="Toggle dark mode">
            <i class="fas fa-moon"></i>
        </button>

        <div class="amping-container">
            <div class="content-wrapper">
                <div class="form-section">
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

                        <div class="image-row d-flex justify-content-center align-items-center my-4 gap-4">
                            <img src="{{ asset('images/general-santos-seal.png') }}" alt="General Santos Seal" class="seal-img">
                            <img src="{{ asset('images/magandang-gensan.png') }}" alt="Magandang Gensan" class="gensan-img">
                        </div>

                        <div class="action-buttons d-flex flex-column flex-md-row justify-content-center align-items-center w-100 my-1 gap-3">
                            <a href="{{ route('signup') }}" class="btn btn-outline-primary btn-action fw-bold w-75 w-md-25">
                                SIGN UP
                            </a>
                            <a href="{{ route('login') }}" class="btn btn-primary btn-action fw-bold w-75 w-md-25">
                                LOG IN
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/miscellaneous/theme-toggler.js') }}"></script>
    </body>
</html>