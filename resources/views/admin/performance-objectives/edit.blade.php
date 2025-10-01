<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Objectif de Performance - CRM-Bh Connect</title>
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
                        <h1 class="h3 mb-0">Modifier l'Objectif de Performance</h1>
                        <p class="text-muted">Modifier les informations de l'objectif</p>
                    </div>
                    <a href="{{ route('admin.performance-objectives.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i>Retour
                    </a>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">Informations de l'objectif</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.performance-objectives.update', $performanceObjective) }}">
                            @csrf
                            @method('PUT')
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nom de l'objectif <span class="text-danger">*</span></label>
                                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $performanceObjective->name) }}" required placeholder="Ex: Chiffre d'affaires mensuel" />
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Type d'objectif <span class="text-danger">*</span></label>
                                    <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                                        <option value="">Sélectionner un type</option>
                                        <option value="revenue" {{ old('type', $performanceObjective->type) === 'revenue' ? 'selected' : '' }}>Chiffre d'affaires</option>
                                        <option value="clients" {{ old('type', $performanceObjective->type) === 'clients' ? 'selected' : '' }}>Nombre de clients</option>
                                        <option value="appointments" {{ old('type', $performanceObjective->type) === 'appointments' ? 'selected' : '' }}>Rendez-vous</option>
                                        <option value="tasks" {{ old('type', $performanceObjective->type) === 'tasks' ? 'selected' : '' }}>Tâches</option>
                                        <option value="conversion" {{ old('type', $performanceObjective->type) === 'conversion' ? 'selected' : '' }}>Taux de conversion</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Valeur cible <span class="text-danger">*</span></label>
                                    <input name="target_value" type="number" step="0.01" min="0" class="form-control @error('target_value') is-invalid @enderror" value="{{ old('target_value', $performanceObjective->target_value) }}" required placeholder="0.00" />
                                    @error('target_value')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Unité <span class="text-danger">*</span></label>
                                    <input name="unit" type="text" class="form-control @error('unit') is-invalid @enderror" value="{{ old('unit', $performanceObjective->unit) }}" required placeholder="FCFA, nombre, %" />
                                    @error('unit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Période <span class="text-danger">*</span></label>
                                    <select name="period" class="form-select @error('period') is-invalid @enderror" required>
                                        <option value="">Sélectionner une période</option>
                                        <option value="monthly" {{ old('period', $performanceObjective->period) === 'monthly' ? 'selected' : '' }}>Mensuel</option>
                                        <option value="quarterly" {{ old('period', $performanceObjective->period) === 'quarterly' ? 'selected' : '' }}>Trimestriel</option>
                                        <option value="yearly" {{ old('period', $performanceObjective->period) === 'yearly' ? 'selected' : '' }}>Annuel</option>
                                    </select>
                                    @error('period')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Description détaillée de l'objectif...">{{ old('description', $performanceObjective->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <div class="form-check">
                                    <input name="is_active" type="checkbox" class="form-check-input" id="is_active" value="1" {{ old('is_active', $performanceObjective->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        Objectif actif
                                    </label>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-1"></i>Mettre à jour
                                </button>
                                <a href="{{ route('admin.performance-objectives.index') }}" class="btn btn-outline-secondary">Annuler</a>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
