<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Activité de {{ $user->name }} - CRM-Bh Connect</title>
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
                    <a href="{{ route('admin.online-users') }}" class="list-group-item list-group-item-action">Utilisateurs en ligne</a>
                </div>
            </aside>

            <main class="col-12 col-md-9 col-lg-10">
    <div class="row">
        <div class="col-12">
            <!-- En-tête avec informations utilisateur -->
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                        <i class="bi bi-person"></i> Activité de {{ $user->name }}
                    </h3>
                        <div>
                            @if($stats['is_online'])
                                <span class="badge bg-success">
                                    <i class="bi bi-circle-fill"></i> En ligne
                                </span>
                            @else
                                <span class="badge bg-secondary">
                                    <i class="bi bi-circle"></i> Hors ligne
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-primary">
                                    <i class="bi bi-person"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Email</span>
                                    <span class="info-box-number">{{ $user->email }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-success">
                                    <i class="bi bi-box-arrow-in-right"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Dernière connexion</span>
                                    <span class="info-box-number">
                                        @if($stats['last_login'])
                                            <div class="d-flex flex-column">
                                                <strong>{{ $stats['last_login']->logged_at->format('d/m/Y') }}</strong>
                                                <span class="badge bg-success">{{ $stats['last_login']->logged_at->format('H:i:s') }}</span>
                                                <small class="text-muted">{{ $stats['last_login']->logged_at->diffForHumans() }}</small>
                                            </div>
                                        @else
                                            <span class="text-muted">Jamais</span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning">
                                    <i class="bi bi-box-arrow-right"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Dernière déconnexion</span>
                                    <span class="info-box-number">
                                        @if($stats['last_logout'])
                                            <div class="d-flex flex-column">
                                                <strong>{{ $stats['last_logout']->logged_at->format('d/m/Y') }}</strong>
                                                <span class="badge bg-warning">{{ $stats['last_logout']->logged_at->format('H:i:s') }}</span>
                                                <small class="text-muted">{{ $stats['last_logout']->logged_at->diffForHumans() }}</small>
                                            </div>
                                        @else
                                            <span class="text-muted">Jamais</span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-info">
                                    <i class="bi bi-graph-up"></i>
                                </span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Connexions totales</span>
                                    <span class="info-box-number">{{ $stats['total_logins'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistiques détaillées -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body text-center">
                            <h4>{{ $stats['login_today'] }}</h4>
                            <p class="mb-0">Connexions aujourd'hui</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body text-center">
                            <h4>{{ $stats['login_this_week'] }}</h4>
                            <p class="mb-0">Connexions cette semaine</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body text-center">
                            <h4>{{ $stats['login_this_month'] }}</h4>
                            <p class="mb-0">Connexions ce mois</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-white">
                        <div class="card-body text-center">
                            <h4>{{ $stats['total_logouts'] }}</h4>
                            <p class="mb-0">Déconnexions totales</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistiques de temps de connexion -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card border-success">
                        <div class="card-body text-center">
                            <h5 class="card-title text-success">
                                <i class="bi bi-clock"></i> Temps total aujourd'hui
                            </h5>
                            <h3 class="text-success">{{ $stats['total_online_time_today'] }}</h3>
                            <p class="text-muted mb-0">Temps de connexion cumulé</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card border-info">
                        <div class="card-body text-center">
                            <h5 class="card-title text-info">
                                <i class="bi bi-stopwatch"></i> Session actuelle
                            </h5>
                            <h3 class="text-info">
                                @if($stats['current_session_duration'])
                                    {{ $stats['current_session_duration'] }}
                                @else
                                    <span class="text-muted">Hors ligne</span>
                                @endif
                            </h3>
                            <p class="text-muted mb-0">Durée de la session en cours</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Heures de connexion détaillées -->
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="bi bi-clock"></i> Heures de connexion détaillées
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-success">
                                <i class="bi bi-box-arrow-in-right"></i> Dernières connexions
                            </h5>
                            <div class="list-group">
                                @forelse($logs->where('action', 'login')->take(5) as $login)
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $login->logged_at->format('d/m/Y') }}</strong>
                                            <br>
                                            <span class="badge bg-success">{{ $login->logged_at->format('H:i:s') }}</span>
                                            <small class="text-muted ms-2">{{ $login->logged_at->diffForHumans() }}</small>
                                        </div>
                                        <small class="text-muted">{{ $login->ip_address }}</small>
                                    </div>
                                @empty
                                    <div class="list-group-item text-center text-muted">
                                        Aucune connexion enregistrée
                                    </div>
                                @endforelse
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-warning">
                                <i class="bi bi-box-arrow-right"></i> Dernières déconnexions
                            </h5>
                            <div class="list-group">
                                @forelse($logs->where('action', 'logout')->take(5) as $logout)
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <strong>{{ $logout->logged_at->format('d/m/Y') }}</strong>
                                            <br>
                                            <span class="badge bg-warning">{{ $logout->logged_at->format('H:i:s') }}</span>
                                            <small class="text-muted ms-2">{{ $logout->logged_at->diffForHumans() }}</small>
                                        </div>
                                        <small class="text-muted">{{ $logout->ip_address }}</small>
                                    </div>
                                @empty
                                    <div class="list-group-item text-center text-muted">
                                        Aucune déconnexion enregistrée
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Historique des connexions -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="bi bi-clock-history"></i> Historique des connexions/déconnexions
                    </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Action</th>
                                    <th>Date/Heure</th>
                                    <th>Adresse IP</th>
                                    <th>Navigateur</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($logs as $log)
                                    <tr>
                                        <td>
                                            @if($log->action == 'login')
                                                <span class="badge bg-success">
                                                    <i class="bi bi-box-arrow-in-right"></i> Connexion
                                                </span>
                                            @else
                                                <span class="badge bg-warning">
                                                    <i class="bi bi-box-arrow-right"></i> Déconnexion
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column">
                                                <strong class="text-primary">{{ $log->logged_at->format('d/m/Y') }}</strong>
                                                <span class="badge bg-light text-dark">{{ $log->logged_at->format('H:i:s') }}</span>
                                                <small class="text-muted">{{ $log->logged_at->diffForHumans() }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            <code>{{ $log->ip_address }}</code>
                                        </td>
                                        <td>
                                            <small>{{ $log->user_agent }}</small>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4">
                                            <i class="bi bi-info-circle fs-1 text-muted mb-2"></i>
                                            <p class="text-muted">Aucun historique trouvé</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($logs->hasPages())
                        <div class="d-flex justify-content-center">
                            {{ $logs->links() }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Actions -->
            <div class="mt-4">
                <a href="{{ route('admin.activity-logs') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Retour aux logs
                </a>
                <a href="{{ route('admin.users.index') }}" class="btn btn-primary">
                    <i class="bi bi-people"></i> Gestion des utilisateurs
                </a>
            </div>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<style>
.info-box {
    display: flex;
    align-items: center;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 0.375rem;
    margin-bottom: 1rem;
}

.info-box-icon {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 0.375rem;
    margin-right: 1rem;
}

.info-box-content {
    flex: 1;
}

.info-box-text {
    display: block;
    font-size: 0.875rem;
    color: #6c757d;
    margin-bottom: 0.25rem;
}

.info-box-number {
    display: block;
    font-size: 1.25rem;
    font-weight: 600;
    color: #495057;
}

.badge {
    font-size: 0.75em;
}

.card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.card-header .card-title {
    margin: 0;
    color: white;
}

.table th {
    border-top: none;
    font-weight: 600;
}
</style>
