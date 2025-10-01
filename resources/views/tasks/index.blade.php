<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Tâches - CRM-Bh Connect</title>
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
                    <a href="{{ route('tasks.index') }}" class="list-group-item list-group-item-action active">Tâches</a>
                    <a href="{{ route('proformas.index') }}" class="list-group-item list-group-item-action">Proformas</a>
                    <a href="{{ route('messages.index') }}" class="list-group-item list-group-item-action">Messages</a>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('reports.financial') }}" class="list-group-item list-group-item-action">Rapport financier</a>
                        <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action">Gestion des utilisateurs</a>
                        <a href="{{ route('admin.appointments.pending') }}" class="list-group-item list-group-item-action">RDV en attente</a>
                    @endif
                    <a href="{{ route('notifications.index') }}" class="list-group-item list-group-item-action">Notifications</a>
                </div>
            </aside>

            <main class="col-12 col-md-9 col-lg-10">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="h3 mb-0">Gestion des Tâches</h1>
                        <p class="text-muted">
                            @if(auth()->user()->isAdmin())
                                Gérez et assignez les tâches aux employés
                            @else
                                Vos tâches assignées
                            @endif
                        </p>
                    </div>
                    <div>
                        @if(auth()->user()->isAdmin())
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#assignTaskModal">
                                <i class="bi bi-plus-circle me-1"></i>Assigner une tâche
                            </button>
                        @endif
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary ms-2">
                            <i class="bi bi-arrow-left me-1"></i>Retour
                        </a>
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
                                        @if(auth()->user()->isAdmin())
                                            <th>Assigné à</th>
                                            <th>Assigné par</th>
                                        @endif
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
                                        @if(auth()->user()->isAdmin())
                                            <td>{{ $task->assignedTo->name }}</td>
                                            <td>{{ $task->assignedBy->name }}</td>
                                        @endif
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
                                                @if(auth()->user()->isAdmin())
                                                    <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editTaskModal-{{ $task->id }}">
                                                        Modifier
                                                    </button>
                                                    <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#reassignTaskModal-{{ $task->id }}">
                                                        Réassigner
                                                    </button>
                                                    <form method="POST" action="{{ route('tasks.destroy', $task) }}" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette tâche ?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                                                    </form>
                                                @else
                                                    @if($task->status !== 'completed' && $task->status !== 'cancelled')
                                                        <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#updateStatusModal-{{ $task->id }}">
                                                            Mettre à jour
                                                        </button>
                                                    @endif
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
                        <h5 class="text-muted">Aucune tâche</h5>
                        <p class="text-muted">
                            @if(auth()->user()->isAdmin())
                                Aucune tâche n'a été créée pour le moment
                            @else
                                Aucune tâche ne vous a été assignée
                            @endif
                        </p>
                        @if(auth()->user()->isAdmin())
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#assignTaskModal">
                                Créer la première tâche
                            </button>
                        @endif
                    </div>
                </div>
                @endif
            </main>
        </div>
    </div>

    @if(auth()->user()->isAdmin())
    <!-- Modal Assigner une tâche -->
    <div class="modal fade" id="assignTaskModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" action="{{ route('tasks.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Assigner une nouvelle tâche</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Titre de la tâche *</label>
                                    <input type="text" name="title" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Priorité *</label>
                                    <select name="priority" class="form-select" required>
                                        <option value="low">Faible</option>
                                        <option value="medium" selected>Moyenne</option>
                                        <option value="high">Élevée</option>
                                        <option value="urgent">Urgente</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Description *</label>
                            <textarea name="description" class="form-control" rows="3" required></textarea>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Assigner à *</label>
                                    <select name="assigned_to" class="form-select" required>
                                        <option value="">Sélectionner un employé</option>
                                        @foreach($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Client (optionnel)</label>
                                    <select name="client_id" class="form-select">
                                        <option value="">Aucun client</option>
                                        @foreach($clients as $client)
                                            <option value="{{ $client->id }}">{{ $client->first_name }} {{ $client->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Date d'échéance</label>
                                    <input type="date" name="due_date" class="form-control" min="{{ date('Y-m-d') }}">
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Notes additionnelles</label>
                            <textarea name="notes" class="form-control" rows="2" placeholder="Instructions spéciales, contexte, etc."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Assigner la tâche</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

