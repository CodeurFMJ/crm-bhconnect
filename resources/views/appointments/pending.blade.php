<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RDV en Attente - CRM-Bh Connect</title>
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
                    <a href="{{ route('reports.financial') }}" class="list-group-item list-group-item-action">Rapport financier</a>
                    <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action">Gestion des utilisateurs</a>
                    <a href="{{ route('admin.appointments.pending') }}" class="list-group-item list-group-item-action active">RDV en attente</a>
                </div>
            </aside>

            <main class="col-12 col-md-9 col-lg-10">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="h3 mb-0">Rendez-vous en Attente d'Approbation</h1>
                        <p class="text-muted">Gérez les demandes de RDV des employés</p>
                    </div>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i>Retour au tableau de bord
                    </a>
                </div>

                @if($appointments->count() > 0)
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Client</th>
                                        <th>Sujet</th>
                                        <th>Date prévue</th>
                                        <th>Créé par</th>
                                        <th>Détails</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($appointments as $appointment)
                                    <tr>
                                        <td>
                                            <div>
                                                <strong>{{ $appointment->client->first_name }} {{ $appointment->client->last_name }}</strong>
                                                <br>
                                                <small class="text-muted">{{ $appointment->client->email }}</small>
                                            </div>
                                        </td>
                                        <td>{{ $appointment->subject }}</td>
                                        <td>{{ $appointment->scheduled_at->format('d/m/Y H:i') }}</td>
                                        <td>{{ $appointment->creator ? $appointment->creator->name : 'N/A' }}</td>
                                        <td>
                                            @if($appointment->details)
                                                <button class="btn btn-sm btn-outline-info" type="button" data-bs-toggle="collapse" data-bs-target="#details-{{ $appointment->id }}">
                                                    Voir détails
                                                </button>
                                            @else
                                                <span class="text-muted">Aucun détail</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#approveModal-{{ $appointment->id }}">
                                                    Approuver
                                                </button>
                                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#rescheduleModal-{{ $appointment->id }}">
                                                    Reporter
                                                </button>
                                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal-{{ $appointment->id }}">
                                                    Rejeter
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @if($appointment->details)
                                    <tr>
                                        <td colspan="6">
                                            <div class="collapse" id="details-{{ $appointment->id }}">
                                                <div class="card card-body">
                                                    {{ $appointment->details }}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="d-flex justify-content-center mt-3">
                            {{ $appointments->links() }}
                        </div>
                    </div>
                </div>
                @else
                <div class="card shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-calendar-check fs-1 text-muted d-block mb-3"></i>
                        <h5 class="text-muted">Aucun RDV en attente</h5>
                        <p class="text-muted">Tous les rendez-vous ont été traités</p>
                    </div>
                </div>
                @endif
            </main>
        </div>
    </div>

    <!-- Modales d'approbation -->
    @foreach($appointments as $appointment)
    <!-- Modal Approuver -->
    <div class="modal fade" id="approveModal-{{ $appointment->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('appointments.approve', $appointment) }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Approuver le RDV</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Client:</strong> {{ $appointment->client->first_name }} {{ $appointment->client->last_name }}</p>
                        <p><strong>Sujet:</strong> {{ $appointment->subject }}</p>
                        <p><strong>Date:</strong> {{ $appointment->scheduled_at->format('d/m/Y H:i') }}</p>
                        <p><strong>Créé par:</strong> {{ $appointment->creator ? $appointment->creator->name : 'N/A' }}</p>
                        
                        <div class="mb-3">
                            <label for="admin_notes_{{ $appointment->id }}" class="form-label">Notes (optionnel)</label>
                            <textarea class="form-control" id="admin_notes_{{ $appointment->id }}" name="admin_notes" rows="3" placeholder="Ajoutez des notes pour l'employé..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-success">Approuver</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Reporter -->
    <div class="modal fade" id="rescheduleModal-{{ $appointment->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('appointments.reschedule', $appointment) }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Reporter le RDV</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Client:</strong> {{ $appointment->client->first_name }} {{ $appointment->client->last_name }}</p>
                        <p><strong>Sujet:</strong> {{ $appointment->subject }}</p>
                        <p><strong>Date actuelle:</strong> {{ $appointment->scheduled_at->format('d/m/Y H:i') }}</p>
                        <p><strong>Créé par:</strong> {{ $appointment->creator ? $appointment->creator->name : 'N/A' }}</p>
                        
                        <div class="mb-3">
                            <label for="rescheduled_to_{{ $appointment->id }}" class="form-label">Nouvelle date *</label>
                            <input type="datetime-local" class="form-control" id="rescheduled_to_{{ $appointment->id }}" name="rescheduled_to" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="admin_notes_reschedule_{{ $appointment->id }}" class="form-label">Raison du report *</label>
                            <textarea class="form-control" id="admin_notes_reschedule_{{ $appointment->id }}" name="admin_notes" rows="3" required placeholder="Expliquez pourquoi le RDV est reporté..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-warning">Reporter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Rejeter -->
    <div class="modal fade" id="rejectModal-{{ $appointment->id }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('appointments.reject', $appointment) }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Rejeter le RDV</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Client:</strong> {{ $appointment->client->first_name }} {{ $appointment->client->last_name }}</p>
                        <p><strong>Sujet:</strong> {{ $appointment->subject }}</p>
                        <p><strong>Date:</strong> {{ $appointment->scheduled_at->format('d/m/Y H:i') }}</p>
                        <p><strong>Créé par:</strong> {{ $appointment->creator ? $appointment->creator->name : 'N/A' }}</p>
                        
                        <div class="mb-3">
                            <label for="admin_notes_reject_{{ $appointment->id }}" class="form-label">Raison du rejet *</label>
                            <textarea class="form-control" id="admin_notes_reject_{{ $appointment->id }}" name="admin_notes" rows="3" required placeholder="Expliquez pourquoi le RDV est rejeté..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-danger">Rejeter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
