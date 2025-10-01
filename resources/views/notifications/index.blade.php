<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications - CRM-Bh Connect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/bhconnect-theme.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom">
        <div class="container-fluid">
            <a class="navbar-brand bhconnect-logo" href="{{ route('dashboard') }}">
                <img src="{{ asset('images/bhconnect-logo.svg') }}" alt="BhConnect Logo">
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('dashboard') }}">Tableau de bord</a>
            </div>
        </div>
    </nav>

    <div class="container-fluid mt-4">
        <div class="row">
            <aside class="col-12 col-md-3 col-lg-2 mb-3 mb-md-0">
                <div class="list-group shadow-sm">
                    <a href="{{ route('dashboard') }}" class="list-group-item list-group-item-action">Tableau de bord</a>
                    <a href="{{ route('clients.index') }}" class="list-group-item list-group-item-action">Clients</a>
                    <a href="{{ route('appointments.index') }}" class="list-group-item list-group-item-action">Rendez-vous</a>
                    <a href="{{ route('proformas.index') }}" class="list-group-item list-group-item-action">Proformas</a>
                    <a href="{{ route('messages.index') }}" class="list-group-item list-group-item-action">Messages</a>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('reports.financial') }}" class="list-group-item list-group-item-action">Rapport financier</a>
                        <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action">Gestion des utilisateurs</a>
                        <a href="{{ route('admin.appointments.pending') }}" class="list-group-item list-group-item-action">RDV en attente</a>
                    @endif
                    <a href="{{ route('notifications.index') }}" class="list-group-item list-group-item-action active">Notifications</a>
                </div>
            </aside>

            <main class="col-12 col-md-9 col-lg-10">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="h3 mb-0">Notifications</h1>
                        <p class="text-muted">Vos notifications et alertes</p>
                    </div>
                    <div>
                        <form method="POST" action="{{ route('notifications.read-all') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary btn-sm">Marquer tout comme lu</button>
                        </form>
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary btn-sm ms-2">
                            <i class="bi bi-arrow-left me-1"></i>Retour
                        </a>
                    </div>
                </div>

                @if($notifications->count() > 0)
                <div class="card shadow-sm">
                    <div class="card-body p-0">
                        @foreach($notifications as $notification)
                        <div class="border-bottom p-3 {{ !$notification->is_read ? 'bg-light' : '' }}">
                            <div class="d-flex justify-content-between align-items-start">
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-2">
                                        <h6 class="mb-0 me-2">{{ $notification->title }}</h6>
                                        @if(!$notification->is_read)
                                            <span class="badge bg-primary">Nouveau</span>
                                        @endif
                                        <span class="badge bg-{{ $notification->type === 'appointment_created' ? 'info' : ($notification->type === 'appointment_approved' ? 'success' : ($notification->type === 'appointment_rejected' ? 'danger' : 'warning')) }}">
                                            {{ ucfirst(str_replace('_', ' ', $notification->type)) }}
                                        </span>
                                    </div>
                                    <p class="text-muted mb-2">{{ $notification->message }}</p>
                                    <small class="text-muted">{{ $notification->created_at->format('d/m/Y H:i') }}</small>
                                </div>
                                @if(!$notification->is_read)
                                <div class="ms-3">
                                    <form method="POST" action="{{ route('notifications.read', $notification) }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-primary">Marquer comme lu</button>
                                    </form>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="d-flex justify-content-center p-3">
                        {{ $notifications->links() }}
                    </div>
                </div>
                @else
                <div class="card shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-bell fs-1 text-muted d-block mb-3"></i>
                        <h5 class="text-muted">Aucune notification</h5>
                        <p class="text-muted">Vous n'avez pas de notifications pour le moment</p>
                    </div>
                </div>
                @endif
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

