<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultats de recherche - CRM-Bh Connect</title>
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
                    <a href="{{ route('appointments.index') }}" class="list-group-item list-group-item-action">Rendez-vous</a>
                    <a href="{{ route('proformas.index') }}" class="list-group-item list-group-item-action">Proformas</a>
                    <a href="{{ route('messages.index') }}" class="list-group-item list-group-item-action">Messages</a>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('reports.financial') }}" class="list-group-item list-group-item-action">Rapport financier</a>
                        <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action">Gestion des utilisateurs</a>
                    @endif
                </div>
            </aside>

            <main class="col-12 col-md-9 col-lg-10">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="h3 mb-0">Résultats de recherche</h1>
                        <p class="text-muted">Recherche pour : "{{ $query }}"</p>
                    </div>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i>Retour au tableau de bord
                    </a>
                </div>

                <!-- Clients -->
                @if($results['clients']->count() > 0)
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">Clients ({{ $results['clients']->count() }})</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nom</th>
                                        <th>Email</th>
                                        <th>Téléphone</th>
                                        <th>Entreprise</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($results['clients'] as $client)
                                    <tr>
                                        <td>{{ $client->first_name }} {{ $client->last_name }}</td>
                                        <td>{{ $client->email }}</td>
                                        <td>{{ $client->phone }}</td>
                                        <td>{{ $client->company }}</td>
                                        <td>
                                            <a href="{{ route('clients.index') }}" class="btn btn-sm btn-outline-primary">Voir</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Rendez-vous -->
                @if($results['appointments']->count() > 0)
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">Rendez-vous ({{ $results['appointments']->count() }})</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Client</th>
                                        <th>Sujet</th>
                                        <th>Date</th>
                                        <th>Statut</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($results['appointments'] as $appointment)
                                    <tr>
                                        <td>{{ $appointment->client->first_name }} {{ $appointment->client->last_name }}</td>
                                        <td>{{ $appointment->subject }}</td>
                                        <td>{{ $appointment->scheduled_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <span class="badge bg-{{ $appointment->status === 'planned' ? 'primary' : ($appointment->status === 'done' ? 'success' : 'danger') }}">
                                                {{ ucfirst($appointment->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('appointments.index') }}" class="btn btn-sm btn-outline-primary">Voir</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Proformas -->
                @if($results['proformas']->count() > 0)
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">Proformas ({{ $results['proformas']->count() }})</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Client</th>
                                        <th>Titre</th>
                                        <th>Montant</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($results['proformas'] as $proforma)
                                    <tr>
                                        <td>{{ $proforma->client->first_name }} {{ $proforma->client->last_name }}</td>
                                        <td>{{ $proforma->title }}</td>
                                        <td>FCFA {{ number_format($proforma->total_amount, 0, ',', ' ') }}</td>
                                        <td>{{ $proforma->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <a href="{{ route('proformas.index') }}" class="btn btn-sm btn-outline-primary">Voir</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif

                @if($results['clients']->count() === 0 && $results['appointments']->count() === 0 && $results['proformas']->count() === 0)
                <div class="card shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-search fs-1 text-muted d-block mb-3"></i>
                        <h5 class="text-muted">Aucun résultat trouvé</h5>
                        <p class="text-muted">Aucun élément ne correspond à votre recherche "{{ $query }}"</p>
                        <a href="{{ route('dashboard') }}" class="btn btn-primary">Retour au tableau de bord</a>
                    </div>
                </div>
                @endif
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
