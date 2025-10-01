<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import/Export CSV - CRM-Bh Connect</title>
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
                    <a href="{{ route('admin.performance-objectives.index') }}" class="list-group-item list-group-item-action">Objectifs de performance</a>
                    <a href="{{ route('admin.data-import-export.index') }}" class="list-group-item list-group-item-action active">Import/Export CSV</a>
                </div>
            </aside>

            <main class="col-12 col-md-9 col-lg-10">
                <div class="page-header mb-4">
                    <h1 class="h3 mb-0">Import/Export CSV</h1>
                    <p class="text-muted">Importez et exportez vos données en format CSV</p>
                </div>

                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <!-- Statistiques -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header bg-white">
                                <h5 class="card-title mb-0">Statistiques des données</h5>
                            </div>
                            <div class="card-body">
                                <div class="row text-center" id="stats-container">
                                    <div class="col-6 col-md-3">
                                        <div class="border-end">
                                            <h4 class="text-bh-orange mb-1" id="clients-count">-</h4>
                                            <small class="text-muted">Clients</small>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="border-end">
                                            <h4 class="text-bh-blue mb-1" id="appointments-count">-</h4>
                                            <small class="text-muted">Rendez-vous</small>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div class="border-end">
                                            <h4 class="text-success mb-1" id="proformas-count">-</h4>
                                            <small class="text-muted">Proformas</small>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-3">
                                        <div>
                                            <h4 class="text-info mb-1" id="tasks-count">-</h4>
                                            <small class="text-muted">Tâches</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Export CSV -->
                    <div class="col-12 col-lg-6 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-header bg-white">
                                <h5 class="card-title mb-0">
                                    <i class="bi bi-download text-bh-orange me-2"></i>Exporter les données
                                </h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted mb-4">Téléchargez vos données au format CSV pour analyse ou sauvegarde.</p>
                                
                                <div class="d-grid gap-2">
                                    <a href="{{ route('admin.data-import-export.export-clients') }}" class="btn btn-outline-primary">
                                        <i class="bi bi-people me-2"></i>Exporter les clients
                                    </a>
                                    <a href="{{ route('admin.data-import-export.export-appointments') }}" class="btn btn-outline-info">
                                        <i class="bi bi-calendar-event me-2"></i>Exporter les rendez-vous
                                    </a>
                                    <a href="{{ route('admin.data-import-export.export-proformas') }}" class="btn btn-outline-success">
                                        <i class="bi bi-file-earmark-text me-2"></i>Exporter les proformas
                                    </a>
                                    <a href="{{ route('admin.data-import-export.export-tasks') }}" class="btn btn-outline-warning">
                                        <i class="bi bi-check2-square me-2"></i>Exporter les tâches
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Import CSV -->
                    <div class="col-12 col-lg-6 mb-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-header bg-white">
                                <h5 class="card-title mb-0">
                                    <i class="bi bi-upload text-bh-blue me-2"></i>Importer des données
                                </h5>
                            </div>
                            <div class="card-body">
                                <p class="text-muted mb-4">Importez des données depuis un fichier CSV.</p>
                                
                                <form action="{{ route('admin.data-import-export.import-clients') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Fichier CSV des clients</label>
                                        <input type="file" name="csv_file" class="form-control" accept=".csv,.txt" required>
                                        <div class="form-text">
                                            Format attendu: Nom, Prénom, Email, Téléphone, Âge, Chiffre d'affaires
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="bi bi-upload me-2"></i>Importer les clients
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Aperçu des données -->
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header bg-white">
                                <h5 class="card-title mb-0">
                                    <i class="bi bi-table text-bh-orange me-2"></i>Aperçu des données
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Type de données</th>
                                                <th>Nombre d'enregistrements</th>
                                                <th>Dernière mise à jour</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="fw-semibold">
                                                    <i class="bi bi-people text-bh-orange me-2"></i>Clients
                                                </td>
                                                <td id="clients-count-table">-</td>
                                                <td id="clients-updated">-</td>
                                                <td>
                                                    <a href="{{ route('admin.data-import-export.export-clients') }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="bi bi-download"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fw-semibold">
                                                    <i class="bi bi-calendar-event text-bh-blue me-2"></i>Rendez-vous
                                                </td>
                                                <td id="appointments-count-table">-</td>
                                                <td id="appointments-updated">-</td>
                                                <td>
                                                    <a href="{{ route('admin.data-import-export.export-appointments') }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="bi bi-download"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fw-semibold">
                                                    <i class="bi bi-file-earmark-text text-success me-2"></i>Proformas
                                                </td>
                                                <td id="proformas-count-table">-</td>
                                                <td id="proformas-updated">-</td>
                                                <td>
                                                    <a href="{{ route('admin.data-import-export.export-proformas') }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="bi bi-download"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="fw-semibold">
                                                    <i class="bi bi-check2-square text-warning me-2"></i>Tâches
                                                </td>
                                                <td id="tasks-count-table">-</td>
                                                <td id="tasks-updated">-</td>
                                                <td>
                                                    <a href="{{ route('admin.data-import-export.export-tasks') }}" class="btn btn-sm btn-outline-primary">
                                                        <i class="bi bi-download"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Charger les statistiques au chargement de la page
        document.addEventListener('DOMContentLoaded', function() {
            fetch('{{ route("admin.data-import-export.stats") }}')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('clients-count').textContent = data.clients || 0;
                    document.getElementById('appointments-count').textContent = data.appointments || 0;
                    document.getElementById('proformas-count').textContent = data.proformas || 0;
                    document.getElementById('tasks-count').textContent = data.tasks || 0;
                    
                    document.getElementById('clients-count-table').textContent = data.clients || 0;
                    document.getElementById('appointments-count-table').textContent = data.appointments || 0;
                    document.getElementById('proformas-count-table').textContent = data.proformas || 0;
                    document.getElementById('tasks-count-table').textContent = data.tasks || 0;
                })
                .catch(error => console.error('Erreur lors du chargement des statistiques:', error));
        });
    </script>
</body>
</html>
