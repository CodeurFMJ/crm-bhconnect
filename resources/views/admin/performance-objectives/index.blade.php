<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Objectifs de Performance - CRM-Bh Connect</title>
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
                    <a href="{{ route('admin.performance-objectives.index') }}" class="list-group-item list-group-item-action active">Objectifs de performance</a>
                    <a href="{{ route('admin.data-import-export.index') }}" class="list-group-item list-group-item-action">Import/Export CSV</a>
                </div>
            </aside>

            <main class="col-12 col-md-9 col-lg-10">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="page-header">
                        <h1 class="h3 mb-0">Objectifs de Performance</h1>
                        <p class="text-muted">Définissez et gérez les objectifs de performance de l'entreprise</p>
                    </div>
                    <a href="{{ route('admin.performance-objectives.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-1"></i>Nouvel objectif
                    </a>
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
                                        <th class="border-0">Nom de l'objectif</th>
                                        <th class="border-0">Type</th>
                                        <th class="border-0">Valeur cible</th>
                                        <th class="border-0">Période</th>
                                        <th class="border-0">Statut</th>
                                        <th class="border-0">Date de création</th>
                                        <th class="border-0 text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($objectives as $objective)
                                        <tr>
                                            <td class="fw-semibold">{{ $objective->name }}</td>
                                            <td>
                                                <span class="badge bg-info">
                                                    {{ ucfirst($objective->type) }}
                                                </span>
                                            </td>
                                            <td class="fw-bold text-bh-orange">
                                                {{ $objective->formatted_target }}
                                            </td>
                                            <td>
                                                <span class="badge bg-secondary">
                                                    {{ ucfirst($objective->period) }}
                                                </span>
                                            </td>
                                            <td>
                                                @if($objective->is_active)
                                                    <span class="badge bg-success">
                                                        <i class="bi bi-check-circle me-1"></i>Actif
                                                    </span>
                                                @else
                                                    <span class="badge bg-danger">
                                                        <i class="bi bi-x-circle me-1"></i>Inactif
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="text-muted">{{ $objective->created_at->format('d/m/Y') }}</td>
                                            <td class="text-end">
                                                <a href="{{ route('admin.performance-objectives.show', $objective) }}" class="btn btn-sm btn-outline-info me-1" title="Voir">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.performance-objectives.edit', $objective) }}" class="btn btn-sm btn-outline-primary me-1" title="Modifier">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <form method="POST" action="{{ route('admin.performance-objectives.toggle', $objective) }}" class="d-inline me-1">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-warning" title="{{ $objective->is_active ? 'Désactiver' : 'Activer' }}">
                                                        <i class="bi bi-{{ $objective->is_active ? 'pause' : 'play' }}"></i>
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('admin.performance-objectives.destroy', $objective) }}" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet objectif ?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Supprimer">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-4">
                                                <i class="bi bi-target fs-1 d-block mb-2"></i>
                                                Aucun objectif de performance défini
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                @if($objectives->hasPages())
                    <div class="mt-4">
                        {{ $objectives->links() }}
                    </div>
                @endif
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
