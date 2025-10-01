<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Utilisateurs - CRM-Bh Connect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/bhconnect-theme.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom">
        <div class="container-fluid">
            <a class="navbar-brand bhconnect-logo" href="{{ route('dashboard') }}">
                <div class="logo-text">
                    <span class="logo-bh">Bh</span><span class="logo-connect">Connect</span>
                    <i class="bi bi-airplane logo-airplane"></i>
                </div>
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
                    <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action active">Gestion des utilisateurs</a>
                </div>
            </aside>

            <main class="col-12 col-md-9 col-lg-10">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="page-header">
                        <h1 class="h3 mb-0">Gestion des Utilisateurs</h1>
                        <p class="text-muted">Gérez les comptes des employés</p>
                    </div>
                    <div>
                        <a href="{{ route('admin.activity-logs') }}" class="btn btn-info me-2">
                            <i class="bi bi-clock-history me-1"></i>Logs d'activité
                        </a>
                        <a href="{{ route('admin.online-users') }}" class="btn btn-success me-2">
                            <i class="bi bi-people me-1"></i>En ligne
                        </a>
                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                            <i class="bi bi-person-plus me-1"></i>Nouvel utilisateur
                        </a>
                    </div>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="card shadow-sm">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="border-0">Nom</th>
                                        <th class="border-0">Email</th>
                                        <th class="border-0">Rôle</th>
                                        <th class="border-0">Statut</th>
                                        <th class="border-0">Date de création</th>
                                        <th class="border-0 text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $user)
                                        <tr>
                                            <td class="fw-semibold">{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if($user->role === 'admin')
                                                    <span class="badge bg-danger">Administrateur</span>
                                                @else
                                                    <span class="badge bg-primary">Employé</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($user->isCurrentlyOnline())
                                                    <span class="badge bg-success">
                                                        <i class="bi bi-circle-fill me-1"></i>En ligne
                                                    </span>
                                                @else
                                                    <span class="badge bg-secondary">
                                                        <i class="bi bi-circle me-1"></i>Hors ligne
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-muted">{{ $user->created_at->format('d/m/Y') }}</td>
                                            <td class="text-end">
                                                <a href="{{ route('admin.user-activity', $user) }}" class="btn btn-sm btn-outline-info me-1" title="Voir l'activité">
                                                    <i class="bi bi-clock-history"></i>
                                                </a>
                                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-primary me-1">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-4">
                                                <i class="bi bi-people fs-1 d-block mb-2"></i>
                                                Aucun utilisateur trouvé
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                @if($users->hasPages())
                    <div class="mt-4">
                        {{ $users->links() }}
                    </div>
                @endif
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


