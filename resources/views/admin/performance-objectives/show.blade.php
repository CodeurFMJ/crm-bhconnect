<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'Objectif - CRM-Bh Connect</title>
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
                        <h1 class="h3 mb-0">Détails de l'Objectif</h1>
                        <p class="text-muted">Informations détaillées de l'objectif de performance</p>
                    </div>
                    <div>
                        <a href="{{ route('admin.performance-objectives.edit', $performanceObjective) }}" class="btn btn-primary me-2">
                            <i class="bi bi-pencil me-1"></i>Modifier
                        </a>
                        <a href="{{ route('admin.performance-objectives.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-1"></i>Retour
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="card shadow-sm">
                            <div class="card-header bg-white">
                                <h5 class="card-title mb-0">Informations générales</h5>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <strong>Nom de l'objectif :</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        {{ $performanceObjective->name }}
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <strong>Type :</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        <span class="badge bg-info">
                                            {{ ucfirst($performanceObjective->type) }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <strong>Valeur cible :</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        <span class="fw-bold text-bh-orange fs-5">
                                            {{ $performanceObjective->formatted_target }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <strong>Période :</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        <span class="badge bg-secondary">
                                            {{ ucfirst($performanceObjective->period) }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <strong>Statut :</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        @if($performanceObjective->is_active)
                                            <span class="badge bg-success">
                                                <i class="bi bi-check-circle me-1"></i>Actif
                                            </span>
                                        @else
                                            <span class="badge bg-danger">
                                                <i class="bi bi-x-circle me-1"></i>Inactif
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                
                                @if($performanceObjective->description)
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <strong>Description :</strong>
                                    </div>
                                    <div class="col-sm-8">
                                        {{ $performanceObjective->description }}
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12 col-lg-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-white">
                                <h5 class="card-title mb-0">Métadonnées</h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <strong>Date de création :</strong><br>
                                    <span class="text-muted">{{ $performanceObjective->created_at->format('d/m/Y à H:i') }}</span>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>Dernière mise à jour :</strong><br>
                                    <span class="text-muted">{{ $performanceObjective->updated_at->format('d/m/Y à H:i') }}</span>
                                </div>
                                
                                <div class="mb-3">
                                    <strong>ID de l'objectif :</strong><br>
                                    <code>{{ $performanceObjective->id }}</code>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card shadow-sm mt-3">
                            <div class="card-header bg-white">
                                <h5 class="card-title mb-0">Actions rapides</h5>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <a href="{{ route('admin.performance-objectives.edit', $performanceObjective) }}" class="btn btn-primary">
                                        <i class="bi bi-pencil me-1"></i>Modifier
                                    </a>
                                    
                                    <form method="POST" action="{{ route('admin.performance-objectives.toggle', $performanceObjective) }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-{{ $performanceObjective->is_active ? 'warning' : 'success' }} w-100">
                                            <i class="bi bi-{{ $performanceObjective->is_active ? 'pause' : 'play' }} me-1"></i>
                                            {{ $performanceObjective->is_active ? 'Désactiver' : 'Activer' }}
                                        </button>
                                    </form>
                                    
                                    <form method="POST" action="{{ route('admin.performance-objectives.destroy', $performanceObjective) }}" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet objectif ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger w-100">
                                            <i class="bi bi-trash me-1"></i>Supprimer
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
