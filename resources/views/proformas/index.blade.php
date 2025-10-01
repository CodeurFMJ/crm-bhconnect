<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proformas - CRM-Bh Connect</title>
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
                    <a href="{{ route('proformas.index') }}" class="list-group-item list-group-item-action active">Proformas</a>
                    <a href="{{ route('messages.index') }}" class="list-group-item list-group-item-action">Messages</a>
                    <a href="{{ route('reports.financial') }}" class="list-group-item list-group-item-action">Rapport financier</a>
                </div>
            </aside>

            <main class="col-12 col-md-9 col-lg-10">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="h3 mb-0">Proformas</h1>
                        <p class="text-muted">Gestion des proformas clients</p>
                    </div>
                    <div class="btn-group">
                        <a href="{{ route('proformas.builder') }}" class="btn btn-primary">
                            <i class="bi bi-tools me-1"></i>Constructeur de proforma
                        </a>
                        <a href="{{ route('clients.index') }}" class="btn btn-outline-primary">
                            <i class="bi bi-plus-circle me-1"></i>Nouvelle proforma
                        </a>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="border-0">Numéro</th>
                                        <th class="border-0">Client</th>
                                        <th class="border-0">Total</th>
                                        <th class="border-0">Statut</th>
                                        <th class="border-0">Date</th>
                                        <th class="border-0 text-end">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($proformas as $p)
                                        <tr>
                                            <td class="fw-semibold">{{ $p->number }}</td>
                                            <td>{{ $p->client->first_name }} {{ $p->client->last_name }}</td>
                                            <td class="fw-semibold text-success">{{ number_format($p->total, 2) }} {{ $p->currency }}</td>
                                            <td>
                                                @if($p->status === 'draft')
                                                    <span class="badge bg-warning">Brouillon</span>
                                                @elseif($p->status === 'sent')
                                                    <span class="badge bg-success">Envoyé</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ ucfirst($p->status) }}</span>
                                                @endif
                                            </td>
                                            <td class="text-muted">{{ $p->created_at->format('d/m/Y') }}</td>
                                            <td class="text-end">
                                                <button class="btn btn-sm btn-outline-primary me-1">Voir</button>
                                                <button class="btn btn-sm btn-outline-success">Envoyer</button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-4">
                                                <i class="bi bi-file-earmark-text fs-1 d-block mb-2"></i>
                                                Aucune proforma trouvée
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                @if($proformas->hasPages())
                    <div class="mt-4">
                        {{ $proformas->links() }}
                    </div>
                @endif
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


