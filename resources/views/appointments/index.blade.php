<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RDV - CRM-Bh Connect</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link href="{{ asset('css/bhconnect-theme.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom">
  <div class="container-fluid">
    <a class="navbar-brand bhconnect-logo" href="{{ route('dashboard') }}">
        <img src="{{ asset('images/bhconnect-logo.svg') }}" alt="BhConnect Logo">
    </a>
    <a class="btn btn-outline-secondary btn-sm" href="{{ route('clients.index') }}">Clients</a>
  </div>
</nav>

<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4 mb-0">Rendez-vous</h1>
    <div class="d-flex gap-2">
      <a href="{{ route('dashboard') }}" class="btn btn-light">Retour au tableau de bord</a>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newApptModal">Prendre un RDV</button>
    </div>
  </div>
  <div class="card">
    <div class="table-responsive">
      <table class="table table-hover mb-0">
        <thead class="table-light">
          <tr>
            <th>Date & heure</th>
            <th>Client</th>
            <th>Sujet</th>
            <th>Statut</th>
            <th>Approbation</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
@forelse ($appointments as $appt)
          <tr>
            <td>{{ optional($appt->scheduled_at)->format('d/m/Y H:i') }}</td>
            <td>{{ optional($appt->client)->last_name }} {{ optional($appt->client)->first_name }}</td>
            <td>{{ $appt->subject }}</td>
            <td><span class="badge {{ $appt->status === 'done' ? 'text-bg-success' : ($appt->status === 'canceled' ? 'text-bg-danger' : 'text-bg-primary') }}">{{ $appt->status }}</span></td>
            <td>
              @if($appt->approval_status === 'pending')
                <span class="badge text-bg-warning">En attente</span>
              @elseif($appt->approval_status === 'approved')
                <span class="badge text-bg-success">Approuvé</span>
              @elseif($appt->approval_status === 'rejected')
                <span class="badge text-bg-danger">Rejeté</span>
              @elseif($appt->approval_status === 'rescheduled')
                <span class="badge text-bg-info">Reporté</span>
              @else
                <span class="badge text-bg-secondary">N/A</span>
              @endif
            </td>
            <td>
              @if($appt->approval_status === 'rejected' && $appt->admin_notes)
                <button class="btn btn-sm btn-outline-info" data-bs-toggle="tooltip" title="{{ $appt->admin_notes }}">
                  Voir raison
                </button>
              @endif
              @if($appt->approval_status === 'rescheduled' && $appt->rescheduled_to)
                <small class="text-muted">Nouvelle date: {{ $appt->rescheduled_to->format('d/m/Y H:i') }}</small>
              @endif
            </td>
          </tr>
@empty
          <tr>
            <td colspan="6" class="text-center text-muted">Aucun rendez-vous</td>
          </tr>
@endforelse
        </tbody>
      </table>
    </div>
    <div class="card-body">
      {{ $appointments->links() }}
    </div>
  </div>
</div>

<div class="modal fade" id="newApptModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Prendre un rendez-vous</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="newApptForm" method="POST">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Client</label>
            <select id="apptClientSelect" class="form-select" required>
              <option value="" selected disabled>Choisir un client</option>
@foreach ($clients as $c)
              <option value="{{ $c->id }}">{{ $c->last_name }} {{ $c->first_name }}</option>
@endforeach
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Date & heure</label>
            <input type="datetime-local" name="scheduled_at" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Sujet</label>
            <input type="text" name="subject" class="form-control" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Détails</label>
            <textarea name="details" class="form-control" rows="3"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
<script>
  const selectEl = document.getElementById('apptClientSelect');
  const formEl = document.getElementById('newApptForm');
  if (selectEl && formEl) {
    const updateAction = () => {
      const id = selectEl.value;
      formEl.action = id ? `{{ url('/clients') }}/${id}/appointments` : '';
    };
    selectEl.addEventListener('change', updateAction);
  }
</script>
</body>
</html>


