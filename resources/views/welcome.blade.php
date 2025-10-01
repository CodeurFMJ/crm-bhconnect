<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRM-Bh Connect</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link href="{{ asset('css/bhconnect-theme.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom">
  <div class="container-fluid">
    <a class="navbar-brand bhconnect-logo" href="#">
      <img src="{{ asset('images/bhconnect-logo.svg') }}" alt="BhConnect Logo">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <form class="d-flex ms-auto my-2 my-lg-0" role="search" method="GET" action="{{ route('search') }}">
        <input class="form-control me-2" type="search" name="q" placeholder="Rechercher clients, RDV, proformas..." aria-label="Search" value="{{ request('q') }}">
        <button class="btn btn-outline-primary" type="submit">Rechercher</button>
      </form>
      <ul class="navbar-nav ms-3 mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link position-relative" href="{{ route('notifications.index') }}">
            <i class="bi bi-bell"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="notification-count">
              {{ $user->unreadNotifications()->count() }}
            </span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span class="me-2">{{ $user->name }}</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="#">Profil</a></li>
            <li><a class="dropdown-item" href="#">Paramètres</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="dropdown-item">Déconnexion</button>
              </form>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<br>
<div class="container-fluid">
  <div class="row">
    <aside class="col-12 col-md-3 col-lg-2 mb-3 mb-md-0">
      <div class="list-group shadow-sm">
        <a href="#" class="list-group-item list-group-item-action active" aria-current="true">Tableau de bord</a>
        <a href="{{ route('clients.index') }}" class="list-group-item list-group-item-action">Clients</a>
        <a href="{{ route('appointments.index') }}" class="list-group-item list-group-item-action">Rendez-vous</a>
        <a href="{{ route('tasks.my-tasks') }}" class="list-group-item list-group-item-action">Tâches</a>
        <a href="{{ route('notes.index') }}" class="list-group-item list-group-item-action">Notes</a>
        <a href="{{ route('documents.index') }}" class="list-group-item list-group-item-action">Documents</a>
        <a href="{{ route('proformas.index') }}" class="list-group-item list-group-item-action">Proformas</a>
        <a href="{{ route('messages.index') }}" class="list-group-item list-group-item-action">Messages (Email & WhatsApp)</a>
        @if(isset($user) && $user->isAdmin())
            <a href="{{ route('reports.financial') }}" class="list-group-item list-group-item-action">Rapport financier</a>
            <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action">Gestion des utilisateurs</a>
            <a href="{{ route('tasks.index') }}" class="list-group-item list-group-item-action">Gestion des tâches</a>
            <a href="{{ route('admin.appointments.pending') }}" class="list-group-item list-group-item-action">
                RDV en attente
                @if($user->unreadNotifications()->where('type', 'appointment_created')->count() > 0)
                    <span class="badge bg-danger ms-2">{{ $user->unreadNotifications()->where('type', 'appointment_created')->count() }}</span>
                @endif
            </a>
        @endif
        <a href="#" class="list-group-item list-group-item-action">Opportunités</a>
        <a href="#" class="list-group-item list-group-item-action">Tâches</a>
        <a href="#" class="list-group-item list-group-item-action">Campagnes</a>
        <a href="#" class="list-group-item list-group-item-action">Paramètres</a>
      </div>
    </aside>

    <main class="col-12 col-md-9 col-lg-10">
      <div class="row g-3">
        <div class="col-12">
          <div class="page-header">
            <h1 class="h3 mb-0">Tableau de bord</h1>
            <p class="text-muted">Vue d'ensemble de votre activité</p>
          </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
          <div class="card dashboard-card shadow-sm h-100">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start">
                <div>
                  <h6 class="card-subtitle text-muted">Clients actifs</h6>
                  <h2 class="card-title mt-2 mb-0">{{ number_format($metrics['activeClients'] ?? 0) }}</h2>
                </div>
                <span class="badge text-bg-success">+{{ $metrics['activeClientsGrowthPct'] ?? 0 }}%</span>
              </div>
              <div class="progress mt-3" style="height: 6px;">
                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $metrics['activeClientsGrowthPct'] ?? 0 }}%" aria-valuenow="{{ $metrics['activeClientsGrowthPct'] ?? 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
          <div class="card dashboard-card shadow-sm h-100">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start">
                <div>
                  <h6 class="card-subtitle text-muted">RDV planifiés</h6>
                  <h2 class="card-title mt-2 mb-0">{{ number_format($metrics['openOpportunities'] ?? 0) }}</h2>
                </div>
                <span class="badge text-bg-primary">+{{ $metrics['openOpportunitiesDelta'] ?? 0 }}</span>
              </div>
              <div class="progress mt-3" style="height: 6px;">
                <div class="progress-bar" role="progressbar" style="width: {{ $pipeline[0]['percent'] ?? 0 }}%" aria-valuenow="{{ $pipeline[0]['percent'] ?? 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12 col-sm-6 col-xl-3">
          <div class="card dashboard-card shadow-sm h-100">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start">
                <div>
                  <h6 class="card-subtitle text-muted">RDV en retard</h6>
                  <h2 class="card-title mt-2 mb-0">{{ number_format($metrics['overdueTasks'] ?? 0) }}</h2>
                </div>
                <span class="badge text-bg-danger">{{ $metrics['overdueTasksDelta'] ?? 0 }}</span>
              </div>
              <div class="progress mt-3" style="height: 6px;">
                <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $pipeline[3]['percent'] ?? 0 }}%" aria-valuenow="{{ $pipeline[3]['percent'] ?? 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>

        @if($user->isAdmin())
        <div class="col-12 col-sm-6 col-xl-3">
          <div class="card dashboard-card shadow-sm h-100">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start">
                <div>
                  <h6 class="card-subtitle text-muted">Chiffre d'affaires (ce mois)</h6>
                  <h2 class="card-title mt-2 mb-0">FCFA {{ number_format($metrics['revenueMonth'] ?? 0, 0, ',', ' ') }}</h2>
                </div>
                <span class="badge text-bg-secondary">{{ ($metrics['revenueDelta'] ?? 0) >= 0 ? '+' : '' }}FCFA {{ number_format($metrics['revenueDelta'] ?? 0, 0, ',', ' ') }}</span>
              </div>
              <div class="progress mt-3" style="height: 6px;">
                <div class="progress-bar bg-secondary" role="progressbar" style="width: {{ $metrics['revenueProgressPct'] ?? 0 }}%" aria-valuenow="{{ $metrics['revenueProgressPct'] ?? 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>
        @else
        <div class="col-12 col-sm-6 col-xl-3">
          <div class="card dashboard-card shadow-sm h-100">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-start">
                <div>
                  <h6 class="card-subtitle text-muted">Mes clients assignés</h6>
                  <h2 class="card-title mt-2 mb-0">{{ $user->assignedClients()->count() }}</h2>
                </div>
                <span class="badge text-bg-primary">Assignés</span>
              </div>
              <div class="progress mt-3" style="height: 6px;">
                <div class="progress-bar bg-primary" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>
        @endif

        <!-- Statistiques des tâches -->
        <div class="col-12">
          <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
              <span>Statistiques des Tâches</span>
              <a href="{{ route('tasks.my-tasks') }}" class="btn btn-sm btn-primary">Voir mes tâches</a>
            </div>
            <div class="card-body">
              <div class="row text-center">
                <div class="col-6 col-md-3">
                  <div class="border-end">
                    <h4 class="text-warning mb-1">{{ $taskStats['pending'] ?? 0 }}</h4>
                    <small class="text-muted">En attente</small>
                  </div>
                </div>
                <div class="col-6 col-md-3">
                  <div class="border-end">
                    <h4 class="text-info mb-1">{{ $taskStats['in_progress'] ?? 0 }}</h4>
                    <small class="text-muted">En cours</small>
                  </div>
                </div>
                <div class="col-6 col-md-3">
                  <div class="border-end">
                    <h4 class="text-success mb-1">{{ $taskStats['completed'] ?? 0 }}</h4>
                    <small class="text-muted">Terminées</small>
                  </div>
                </div>
                <div class="col-6 col-md-3">
                  <div>
                    <h4 class="text-danger mb-1">{{ $taskStats['overdue'] ?? 0 }}</h4>
                    <small class="text-muted">En retard</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="card shadow-sm">
            <div class="card-header bg-white">Actions rapides</div>
            <div class="card-body">
              <a href="{{ route('proformas.index') }}" class="btn btn-sm btn-outline-primary me-2">Voir les proformas</a>
              <a href="{{ route('messages.index') }}" class="btn btn-sm btn-outline-success me-2">Envoyer un message</a>
              <a href="{{ route('tasks.my-tasks') }}" class="btn btn-sm btn-outline-warning me-2">Mes tâches</a>
              @if($user->isAdmin())
                <a href="{{ route('tasks.index') }}" class="btn btn-sm btn-outline-info me-2">Gérer les tâches</a>
                <a href="{{ route('reports.financial') }}" class="btn btn-sm btn-outline-dark">Voir le rapport financier</a>
              @endif
            </div>
          </div>
        </div>

        @if($user->isAdmin())
        <div class="col-12 col-xl-8">
          <div class="card dashboard-card shadow-sm h-100">
            <div class="card-header bg-white">
              Performance des ventes
            </div>
            <div class="card-body">
              <div class="row g-3">
                <div class="col-6">
                  <div class="small text-muted">Ce trimestre</div>
                  <div class="display-6">FCFA {{ number_format($sales['quarterAmount'] ?? 0, 0, ',', ' ') }}</div>
                </div>
                <div class="col-6">
                  <div class="small text-muted">Objectif</div>
                  <div class="display-6">FCFA {{ number_format($sales['goalAmount'] ?? 0, 0, ',', ' ') }}</div>
                </div>
              </div>
              <div class="mt-3">
                <div class="progress" style="height: 10px;">
                  <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $sales['progressPct'] ?? 0 }}%" aria-valuenow="{{ $sales['progressPct'] ?? 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="form-text">{{ $sales['progressPct'] ?? 0 }}% de l'objectif atteint</div>
              </div>
            </div>
          </div>
        </div>
        @else
        <div class="col-12 col-xl-8">
          <div class="card dashboard-card shadow-sm h-100">
            <div class="card-header bg-white">
              Mes proformas récentes
            </div>
            <div class="card-body">
              <div class="text-center text-muted py-4">
                <i class="bi bi-file-earmark-text fs-1 d-block mb-2"></i>
                Aucune proforma créée récemment
              </div>
            </div>
          </div>
        </div>
        @endif

        <div class="col-12 col-xl-4">
          <div class="card dashboard-card shadow-sm h-100">
            <div class="card-header bg-white">Pipeline par étape</div>
            <div class="card-body">
@foreach (($pipeline ?? []) as $stage)
              <div class="d-flex align-items-center mb-2">
                <div class="me-2" style="width: 110px;">{{ $stage['label'] }}</div>
                <div class="progress flex-grow-1" style="height: 8px;">
                  <div class="progress-bar {{ $stage['color'] }}" style="width: {{ $stage['percent'] }}%"></div>
                </div>
                <span class="ms-2 small text-muted">{{ $stage['percent'] }}%</span>
              </div>
@endforeach
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
              <span>Activités récentes</span>
              <a href="{{ route('clients.index') }}" class="btn btn-sm btn-primary">Gérer les clients</a>
            </div>
            <div class="table-responsive">
              <table class="table table-hover mb-0">
                <thead class="table-light">
                  <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Type</th>
                    <th scope="col">Client</th>
                    <th scope="col">Détail</th>
                    <th scope="col" class="text-end">Statut</th>
                  </tr>
                </thead>
                <tbody>
@forelse (($activities ?? []) as $activity)
                  <tr>
                    <td>{{ $activity['date'] }}</td>
                    <td>{{ $activity['type'] }}</td>
                    <td>{{ $activity['client'] }}</td>
                    <td>{{ $activity['detail'] }}</td>
                    <td class="text-end"><span class="badge {{ $activity['status']['class'] ?? '' }}">{{ $activity['status']['label'] ?? '' }}</span></td>
                  </tr>
@empty
                  <tr>
                    <td colspan="5" class="text-center text-muted">Aucune activité récente</td>
                  </tr>
@endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>

        
    </div>
    </main>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

</body>
</html>