<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CRM-Bh Connect')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="{{ asset('css/bhconnect-theme.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom">
        <div class="container-fluid">
            <a class="navbar-brand bhconnect-logo" href="{{ route('dashboard') }}">
                <img src="{{ asset('images/bhconnect-logo.svg') }}" alt="BhConnect Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form class="d-flex ms-auto my-2 my-lg-0" role="search" method="GET" action="{{ route('search') }}">
                    <input class="form-control me-2" type="search" name="q" placeholder="Rechercher clients, RDV, proformas..." aria-label="Search" value="{{ request('q') }}">
                    <button class="btn btn-outline-primary" type="submit">Rechercher</button>
                </form>
                <ul class="navbar-nav ms-3 mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link position-relative" href="{{ route('notifications.index') }}">
                            <i class="bi bi-bell"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="notification-count">
                                {{ $user->unreadNotifications()->count() }}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="me-2">{{ $user->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Profil</a></li>
                            <li><a class="dropdown-item" href="#">Paramètres</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Déconnexion</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid mt-4">
        <div class="row">
            <aside class="col-12 col-md-3 col-lg-2 mb-3 mb-md-0">
                <div class="list-group shadow-sm">
                    <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2 me-2"></i>Tableau de bord
                    </a>
                    <a href="{{ route('clients.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('clients.*') ? 'active' : '' }}">
                        <i class="bi bi-people me-2"></i>Clients
                    </a>
                    <a href="{{ route('appointments.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('appointments.*') ? 'active' : '' }}">
                        <i class="bi bi-calendar-event me-2"></i>Rendez-vous
                    </a>
                    <a href="{{ route('tasks.my-tasks') }}" class="list-group-item list-group-item-action {{ request()->routeIs('tasks.*') ? 'active' : '' }}">
                        <i class="bi bi-check2-square me-2"></i>Tâches
                    </a>
                    <a href="{{ route('notes.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('notes.*') ? 'active' : '' }}">
                        <i class="bi bi-sticky me-2"></i>Notes
                    </a>
                    <a href="{{ route('documents.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('documents.*') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark me-2"></i>Documents
                    </a>
                    <a href="{{ route('proformas.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('proformas.*') ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-text me-2"></i>Proformas
                    </a>
                    <a href="{{ route('messages.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('messages.*') ? 'active' : '' }}">
                        <i class="bi bi-chat-dots me-2"></i>Messages
                    </a>
                    @if(isset($user) && $user->isAdmin())
                        <a href="{{ route('reports.financial') }}" class="list-group-item list-group-item-action {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                            <i class="bi bi-graph-up me-2"></i>Rapport financier
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                            <i class="bi bi-people me-2"></i>Gestion des utilisateurs
                        </a>
                        <a href="{{ route('admin.performance-objectives.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.performance-objectives.*') ? 'active' : '' }}">
                            <i class="bi bi-target me-2"></i>Objectifs de performance
                        </a>
                        <a href="{{ route('admin.data-import-export.index') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin.data-import-export.*') ? 'active' : '' }}">
                            <i class="bi bi-download me-2"></i>Import/Export CSV
                        </a>
                        <a href="{{ route('admin.appointments.pending') }}" class="list-group-item list-group-item-action">
                            <i class="bi bi-clock me-2"></i>RDV en attente
                            @if($user->unreadNotifications()->where('type', 'appointment_created')->count() > 0)
                                <span class="badge bg-danger ms-2">{{ $user->unreadNotifications()->where('type', 'appointment_created')->count() }}</span>
                            @endif
                        </a>
                    @endif
                </div>
            </aside>

            <main class="col-12 col-md-9 col-lg-10">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    @stack('scripts')
</body>
</html>
