<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Mon Application Laravel')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Additional head elements -->
    @stack('head')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">Mon Application</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/forms') }}">Formulaires</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="#">À propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li> --}}
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main content section -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <!-- Content -->
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Footer -->
    {{-- <footer class="bg-dark text-white mt-auto py-3">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <p>&copy; {{ date('Y') }} Mon Application. Tous droits réservés.</p>
    </div>
    </div>
    </div>
    </footer>
    --}}
    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <!-- Additional scripts -->
    @stack('scripts')
</body>
</html>
