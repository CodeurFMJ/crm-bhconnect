<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapport Financier - CRM-Bh Connect</title>
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
                    <a href="{{ route('reports.financial') }}" class="list-group-item list-group-item-action active">Rapport financier</a>
                </div>
            </aside>

            <main class="col-12 col-md-9 col-lg-10">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="h3 mb-0">Rapport Financier</h1>
                        <p class="text-muted">Analyse des revenus et performance</p>
                    </div>
                    <button class="btn btn-outline-primary" onclick="window.print()">
                        <i class="bi bi-printer me-1"></i>Imprimer
                    </button>
                </div>

                <!-- Filter Section -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">Filtres</h5>
                    </div>
                    <div class="card-body">
                        <form method="GET" class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Date de début</label>
                                <input type="date" name="from" value="{{ $from }}" class="form-control" />
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Date de fin</label>
                                <input type="date" name="to" value="{{ $to }}" class="form-control" />
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="bi bi-funnel me-1"></i>Filtrer
                                </button>
                                <a href="{{ route('reports.financial') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-clockwise me-1"></i>Réinitialiser
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Summary Cards -->
                <div class="row g-4 mb-4">
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card shadow-sm border-0 bg-primary text-white">
                            <div class="card-body text-center">
                                <i class="bi bi-currency-exchange fs-1 mb-2"></i>
                                <h3 class="card-title">{{ number_format($total, 0, ',', ' ') }} FCFA</h3>
                                <p class="card-text">Total des revenus</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card shadow-sm border-0 bg-success text-white">
                            <div class="card-body text-center">
                                <i class="bi bi-check-circle fs-1 mb-2"></i>
                                <h3 class="card-title">{{ $byStatus->where('status', 'sent')->sum('count') }}</h3>
                                <p class="card-text">Proformas envoyées</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card shadow-sm border-0 bg-warning text-white">
                            <div class="card-body text-center">
                                <i class="bi bi-file-earmark-text fs-1 mb-2"></i>
                                <h3 class="card-title">{{ $byStatus->where('status', 'draft')->sum('count') }}</h3>
                                <p class="card-text">Brouillons</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card shadow-sm border-0 bg-info text-white">
                            <div class="card-body text-center">
                                <i class="bi bi-graph-up fs-1 mb-2"></i>
                                <h3 class="card-title">{{ $byStatus->count() }}</h3>
                                <p class="card-text">Statuts différents</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detailed Report -->
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">Détail par statut</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="border-0">Statut</th>
                                        <th class="border-0 text-center">Nombre</th>
                                        <th class="border-0 text-end">Montant total</th>
                                        <th class="border-0 text-end">Montant moyen</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($byStatus as $row)
                                        <tr>
                                            <td>
                                                @if($row->status === 'draft')
                                                    <span class="badge bg-warning">Brouillon</span>
                                                @elseif($row->status === 'sent')
                                                    <span class="badge bg-success">Envoyé</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ ucfirst($row->status) }}</span>
                                                @endif
                                            </td>
                                            <td class="text-center fw-semibold">{{ $row->count }}</td>
                                            <td class="text-end fw-semibold text-success">{{ number_format($row->amount, 0, ',', ' ') }} FCFA</td>
                                            <td class="text-end text-muted">{{ $row->count > 0 ? number_format($row->amount / $row->count, 0, ',', ' ') : '0' }} FCFA</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-4">
                                                <i class="bi bi-graph-down fs-1 d-block mb-2"></i>
                                                Aucune donnée trouvée pour cette période
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Chart Placeholder -->
                <div class="card shadow-sm mt-4">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">Évolution des revenus</h5>
                    </div>
                    <div class="card-body">
                        <div class="text-center text-muted py-5">
                            <i class="bi bi-bar-chart fs-1 d-block mb-2"></i>
                            Graphique d'évolution des revenus
                            <br><small>À implémenter avec une bibliothèque de graphiques</small>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


