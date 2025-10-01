<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utilisateurs en ligne - CRM-Bh Connect</title>
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
                    <a href="{{ route('proformas.index') }}" class="list-group-item list-group-item-action">Proformas</a>
                    <a href="{{ route('messages.index') }}" class="list-group-item list-group-item-action">Messages</a>
                    <a href="{{ route('reports.financial') }}" class="list-group-item list-group-item-action">Rapport financier</a>
                    <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action">Gestion des utilisateurs</a>
                    <a href="{{ route('admin.activity-logs') }}" class="list-group-item list-group-item-action">Logs d'activité</a>
                    <a href="{{ route('admin.online-users') }}" class="list-group-item list-group-item-action active">Utilisateurs en ligne</a>
                </div>
            </aside>

            <main class="col-12 col-md-9 col-lg-10">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                        <i class="bi bi-people"></i> Utilisateurs actuellement en ligne
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.activity-logs') }}" class="btn btn-info btn-sm">
                            <i class="bi bi-clock-history"></i> Voir tous les logs
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    @if($users->count() > 0)
                        <div class="row">
                            @foreach($users as $user)
                                <div class="col-md-6 col-lg-4 mb-4">
                                    <div class="card border-success">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-lg bg-success text-white rounded-circle d-flex align-items-center justify-content-center mr-3">
                                                    {{ substr($user->name, 0, 1) }}
                                                </div>
                                                <div class="flex-grow-1">
                                                    <h5 class="card-title mb-1">{{ $user->name }}</h5>
                                                    <p class="card-text text-muted mb-1">{{ $user->email }}</p>
                                                    <small class="text-success">
                                                        <i class="bi bi-circle-fill"></i> En ligne
                                                    </small>
                                                </div>
                                            </div>
                                            
                                            <hr>
                                            
                                            <div class="row text-center">
                                                <div class="col-4">
                                                    <small class="text-muted">Dernière connexion</small>
                                                    <div class="font-weight-bold">
                                                        @if($user->lastLogin())
                                                            <div class="d-flex flex-column">
                                                                <span class="badge bg-success">{{ $user->lastLogin()->logged_at->format('H:i:s') }}</span>
                                                                <small class="text-muted">{{ $user->lastLogin()->logged_at->format('d/m/Y') }}</small>
                                                            </div>
                                                        @else
                                                            <span class="text-muted">N/A</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <small class="text-muted">Durée de connexion</small>
                                                    <div class="font-weight-bold">
                                                        @if($user->getCurrentSessionDuration())
                                                            <span class="badge bg-info">{{ $user->getCurrentSessionDuration() }}</span>
                                                        @else
                                                            <span class="text-muted">N/A</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <small class="text-muted">Temps total aujourd'hui</small>
                                                    <div class="font-weight-bold">
                                                        <span class="badge bg-primary">{{ $user->getFormattedOnlineTimeToday() }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="mt-3">
                                                <a href="{{ route('admin.user-activity', $user->id) }}" class="btn btn-sm btn-outline-primary btn-block">
                                                    <i class="bi bi-eye"></i> Voir l'activité
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="bi bi-person-x fs-1 text-muted mb-3"></i>
                            <h4 class="text-muted">Aucun utilisateur en ligne</h4>
                            <p class="text-muted">Aucun employé n'est actuellement connecté au système.</p>
                            <a href="{{ route('admin.activity-logs') }}" class="btn btn-primary">
                                <i class="bi bi-clock-history"></i> Voir les logs d'activité
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.avatar-lg {
    width: 60px;
    height: 60px;
    font-size: 24px;
    font-weight: bold;
}

.card-header {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
}

.card-header .card-title {
    margin: 0;
    color: white;
}

.border-success {
    border-color: #28a745 !important;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.text-success {
    color: #28a745 !important;
}

.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.75rem;
}
</style>

<script>
// Actualiser la page toutes les 30 secondes pour voir les changements en temps réel
setTimeout(function() {
    location.reload();
}, 30000);
</script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
