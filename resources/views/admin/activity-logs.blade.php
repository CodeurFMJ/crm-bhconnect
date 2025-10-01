<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logs d'activité des employés - CRM-Bh Connect</title>
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
                    <a href="{{ route('admin.activity-logs') }}" class="list-group-item list-group-item-action active">Logs d'activité</a>
                    <a href="{{ route('admin.online-users') }}" class="list-group-item list-group-item-action">Utilisateurs en ligne</a>
                </div>
            </aside>

            <main class="col-12 col-md-9 col-lg-10">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">
                        <i class="bi bi-clock-history"></i> Logs d'activité des employés
                    </h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.online-users') }}" class="btn btn-success btn-sm">
                            <i class="bi bi-people"></i> Utilisateurs en ligne
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    <!-- Filtres -->
                    <form method="GET" action="{{ route('admin.activity-logs') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="user_id">Employé</label>
                                <select name="user_id" id="user_id" class="form-control">
                                    <option value="">Tous les employés</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="action">Action</label>
                                <select name="action" id="action" class="form-control">
                                    <option value="">Toutes les actions</option>
                                    <option value="login" {{ request('action') == 'login' ? 'selected' : '' }}>Connexion</option>
                                    <option value="logout" {{ request('action') == 'logout' ? 'selected' : '' }}>Déconnexion</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="date_from">Date début</label>
                                <input type="date" name="date_from" id="date_from" class="form-control" value="{{ request('date_from') }}">
                            </div>
                            <div class="col-md-2">
                                <label for="date_to">Date fin</label>
                                <input type="date" name="date_to" id="date_to" class="form-control" value="{{ request('date_to') }}">
                            </div>
                            <div class="col-md-3 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="bi bi-search"></i> Filtrer
                                </button>
                                <a href="{{ route('admin.activity-logs') }}" class="btn btn-secondary">
                                    <i class="bi bi-x"></i> Effacer
                                </a>
                            </div>
                        </div>
                    </form>

                    <!-- Tableau des logs -->
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Employé</th>
                                    <th>Action</th>
                                    <th>Date/Heure</th>
                                    <th>Adresse IP</th>
                                    <th>Navigateur</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($logs as $log)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mr-2">
                                                    {{ substr($log->user->name, 0, 1) }}
                                                </div>
                                                <div>
                                                    <strong>{{ $log->user->name }}</strong>
                                                    <br>
                                                    <small class="text-muted">{{ $log->user->email }}</small>
                                                </div>
                                            </div>
                                        </td>
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
                                            <small>{{ Str::limit($log->user_agent, 50) }}</small>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.user-activity', $log->user->id) }}" class="btn btn-sm btn-info">
                                                <i class="bi bi-eye"></i> Voir l'activité
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">
                                            <i class="bi bi-info-circle fs-1 text-muted mb-2"></i>
                                            <p class="text-muted">Aucun log d'activité trouvé</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($logs->hasPages())
                        <div class="d-flex justify-content-center">
                            {{ $logs->appends(request()->query())->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<style>
.avatar-sm {
    width: 40px;
    height: 40px;
    font-size: 16px;
    font-weight: bold;
}

.badge {
    font-size: 0.75em;
}

.table th {
    border-top: none;
    font-weight: 600;
}

.card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.card-header .card-title {
    margin: 0;
    color: white;
}

.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.75rem;
}
</style>
