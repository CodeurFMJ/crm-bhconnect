<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Tâches - CRM-Bh Connect</title>
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
                    <a href="{{ route('tasks.my-tasks') }}" class="list-group-item list-group-item-action active">Mes Tâches</a>
                    <a href="{{ route('proformas.index') }}" class="list-group-item list-group-item-action">Proformas</a>
                    <a href="{{ route('messages.index') }}" class="list-group-item list-group-item-action">Messages</a>
                    <a href="{{ route('notifications.index') }}" class="list-group-item list-group-item-action">Notifications</a>
                </div>
            </aside>

            <main class="col-12 col-md-9 col-lg-10">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="h3 mb-0">Mes Tâches</h1>
                        <p class="text-muted">Gérez vos tâches assignées</p>
                    </div>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i>Retour au tableau de bord
                    </a>
                </div>

                <!-- Statistiques rapides -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title text-warning">{{ $tasks->where('status', 'pending')->count() }}</h5>
                                <p class="card-text">En attente</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title text-info">{{ $tasks->where('status', 'in_progress')->count() }}</h5>
                                <p class="card-text">En cours</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title text-success">{{ $tasks->where('status', 'completed')->count() }}</h5>
                                <p class="card-text">Terminées</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title text-danger">{{ $tasks->filter(function($task) { return $task->isOverdue(); })->count() }}</h5>
                                <p class="card-text">En retard</p>
                            </div>
                        </div>
                    </div>
                </div>

                @if($tasks->count() > 0)
                <div class="card shadow-sm">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Titre</th>
                                        <th>Priorité</th>
                                        <th>Statut</th>
                                        <th>Assigné par</th>
                                        <th>Client</th>
                                        <th>Échéance</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tasks as $task)
                                    <tr class="{{ $task->isOverdue() ? 'table-danger' : '' }}">
                                        <td>
                                            <div>
                                                <strong>{{ $task->title }}</strong>
                                                @if($task->isOverdue())
                                                    <span class="badge bg-danger ms-2">En retard</span>
                                                @endif
                                                <br>
                                                <small class="text-muted">{{ Str::limit($task->description, 50) }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $task->getPriorityColor() }}">
                                                {{ ucfirst($task->priority) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $task->getStatusColor() }}">
                                                {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                                            </span>
                                        </td>
                                        <td>{{ $task->assignedBy->name }}</td>
                                        <td>
                                            @if($task->client)
                                                {{ $task->client->first_name }} {{ $task->client->last_name }}
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($task->due_date)
                                                {{ $task->due_date->format('d/m/Y') }}
                                            @else
                                                <span class="text-muted">N/A</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#viewTaskModal-{{ $task->id }}">
                                                    Voir
                                                </button>
                                                @if($task->status !== 'completed' && $task->status !== 'cancelled')
                                                    <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#updateStatusModal-{{ $task->id }}">
                                                        Mettre à jour
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="d-flex justify-content-center p-3">
                            {{ $tasks->links() }}
                        </div>
                    </div>
                </div>
                @else
                <div class="card shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-clipboard-check fs-1 text-muted d-block mb-3"></i>
                        <h5 class="text-muted">Aucune tâche assignée</h5>
                        <p class="text-muted">Vous n'avez aucune tâche assignée pour le moment</p>
                    </div>
                </div>
                @endif
            </main>
        </div>
    </div>

    <!-- Modales pour chaque tâche -->
    @foreach($tasks as $task)
    <!-- Modal Voir tâche -->
    <div class="modal fade" id="viewTaskModal-{{ $task->id }}" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ $task->title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Priorité:</strong>
                            <span class="badge bg-{{ $task->getPriorityColor() }} ms-2">
                                {{ ucfirst($task->priority) }}
                            </span>
                        </div>
                        <div class="col-md-6">
                            <strong>Statut:</strong>
                            <span class="badge bg-{{ $task->getStatusColor() }} ms-2">
                                {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <strong>Description:</strong>
                        <p class="mt-2">{{ $task->description }}</p>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Assigné par:</strong> {{ $task->assignedBy->name }}
                        </div>
                        <div class="col-md-6">
                            <strong>Client:</strong> 
                            @if($task->client)
                                {{ $task->client->first_name }} {{ $task->client->last_name }}
                            @else
                                N/A
                            @endif
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Date d'échéance:</strong>
                            @if($task->due_date)
                                {{ $task->due_date->format('d/m/Y') }}
                            @else
                                N/A
                            @endif
                        </div>
                        <div class="col-md-6">
                            <strong>Créée le:</strong> {{ $task->created_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                    
                    @if($task->notes)
                    <div class="mb-3">
                        <strong>Notes:</strong>
                        <p class="mt-2">{{ $task->notes }}</p>
                    </div>
                    @endif
                    
                    @if($task->completed_at)
                    <div class="mb-3">
                        <strong>Terminée le:</strong> {{ $task->completed_at->format('d/m/Y H:i') }}
                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Mettre à jour le statut -->
    <div class="modal fade" id="updateStatusModal-{{ $task->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('tasks.update-status', $task) }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Mettre à jour le statut</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Tâche:</strong> {{ $task->title }}</p>
                        
                        <div class="mb-3">
                            <label class="form-label">Nouveau statut *</label>
                            <select name="status" class="form-select" required>
                                <option value="pending" {{ $task->status === 'pending' ? 'selected' : '' }}>En attente</option>
                                <option value="in_progress" {{ $task->status === 'in_progress' ? 'selected' : '' }}>En cours</option>
                                <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Terminée</option>
                                <option value="cancelled" {{ $task->status === 'cancelled' ? 'selected' : '' }}>Annulée</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-success">Mettre à jour</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

