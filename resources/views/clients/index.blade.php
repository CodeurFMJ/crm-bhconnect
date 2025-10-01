<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Clients - CRM-Bh Connect</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
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
    <div class="d-flex">
      <form action="{{ route('logout') }}" method="POST" class="ms-2">
        @csrf
        <button class="btn btn-outline-secondary btn-sm">Déconnexion</button>
      </form>
    </div>
  </div>
  </nav>

<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4 mb-0">Clients</h1>
    <div class="d-flex align-items-center gap-2">
      <span class="badge text-bg-light">CA total: FCFA {{ number_format($companyRevenue ?? 0, 0, ',', ' ') }}</span>
      <a href="{{ route('dashboard') }}" class="btn btn-light btn-sm">Retour au tableau de bord</a>
      <button class="btn btn-sm btn-success" data-bs-toggle="collapse" data-bs-target="#createClientForm">Nouveau client</button>
    </div>
  </div>

  <div class="collapse" id="createClientForm">
    <div class="card card-body mb-3">
      <form action="{{ route('clients.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
        @csrf
        <div class="col-sm-6 col-lg-3">
          <label class="form-label">Nom</label>
          <input type="text" name="last_name" class="form-control" required>
        </div>
        <div class="col-sm-6 col-lg-3">
          <label class="form-label">Prénom</label>
          <input type="text" name="first_name" class="form-control" required>
        </div>
        <div class="col-sm-6 col-lg-2">
          <label class="form-label">Âge</label>
          <input type="number" name="age" class="form-control" min="0" max="150">
        </div>
        <div class="col-sm-6 col-lg-2">
          <label class="form-label">CA (FCFA)</label>
          <input type="number" step="0.01" name="revenue" class="form-control" min="0">
        </div>
        <div class="col-12 col-lg-6">
          <label class="form-label">Documents (PDF/JPG/PNG)</label>
          <input type="file" name="documents[]" class="form-control" multiple>
        </div>
        <div class="col-12">
          <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
      </form>
    </div>
  </div>

  <div class="card">
    <div class="table-responsive">
      <table class="table table-hover mb-0">
        <thead class="table-light">
          <tr>
            <th>Nom complet</th>
            <th>Âge</th>
            <th>CA (FCFA)</th>
            <th>RDV</th>
            <th>Notes</th>
            <th class="text-end">Actions</th>
          </tr>
        </thead>
        <tbody>
@foreach (($clients ?? []) as $client)
          <tr>
            <td>{{ $client->last_name }} {{ $client->first_name }}</td>
            <td>{{ $client->age ?? '—' }}</td>
            <td>FCFA {{ number_format($client->revenue ?? 0, 0, ',', ' ') }}</td>
            <td>{{ $client->appointments_count ?? 0 }}</td>
            <td>{{ $client->notes_count ?? 0 }}</td>
            <td class="text-end">
              <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#editClientModal{{ $client->id }}">Modifier</button>
              <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addApptModal{{ $client->id }}">RDV</button>
              <button class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#addNoteModal{{ $client->id }}">Note</button>
              <form action="{{ route('clients.destroy', $client) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Supprimer ce client ?')">Supprimer</button>
              </form>
            </td>
          </tr>

          <tr class="table-group-divider">
            <td colspan="6">
              <div class="row g-3">
                <div class="col-md-6">
                  <div class="small text-muted mb-1">Derniers RDV</div>
@foreach ($client->appointments as $appt)
                  <div class="d-flex justify-content-between border rounded p-2 mb-2">
                    <div>
                      <div class="fw-semibold">{{ $appt->subject }} <span class="badge text-bg-light">{{ $appt->status }}</span></div>
                              <div class="text-muted small">{{ optional($appt->scheduled_at)->format('d/m/Y H:i') }}</div>
                    </div>
                  </div>
@endforeach
                </div>
                <div class="col-md-6">
                  <div class="small text-muted mb-1">Dernières notes</div>
@foreach ($client->notes as $note)
                  <div class="border rounded p-2 mb-2">
                            <div class="small">{{ optional($note->created_at)->format('d/m/Y H:i') }}</div>
                    <div>{{ $note->content }}</div>
                  </div>
@endforeach
                </div>
              </div>
            </td>
          </tr>

          <div class="modal fade" id="editClientModal{{ $client->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Modifier client</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('clients.update', $client) }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')
                  <div class="modal-body">
                    <div class="mb-3">
                      <label class="form-label">Nom</label>
                      <input type="text" name="last_name" class="form-control" value="{{ $client->last_name }}" required>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Prénom</label>
                      <input type="text" name="first_name" class="form-control" value="{{ $client->first_name }}" required>
                    </div>
                    <div class="row g-3">
                      <div class="col-6">
                        <label class="form-label">Âge</label>
                        <input type="number" name="age" class="form-control" min="0" max="150" value="{{ $client->age }}">
                      </div>
                      <div class="col-6">
                        <label class="form-label">CA (FCFA)</label>
                        <input type="number" step="0.01" name="revenue" class="form-control" min="0" value="{{ $client->revenue }}">
                      </div>
                    </div>
                    <div class="mt-3">
                      <label class="form-label">Ajouter des documents</label>
                      <input type="file" name="documents[]" class="form-control" multiple>
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

          <div class="modal fade" id="addApptModal{{ $client->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Nouveau RDV</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('appointments.store', $client) }}" method="POST">
                  @csrf
                  <div class="modal-body">
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

          <div class="modal fade" id="addNoteModal{{ $client->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Ajouter une note</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('notes.store', $client) }}" method="POST">
                  @csrf
                  <div class="modal-body">
                    <div class="mb-3">
                      <label class="form-label">Contenu</label>
                      <textarea name="content" class="form-control" rows="4" required></textarea>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

@endforeach
        </tbody>
      </table>
    </div>
    <div class="card-body">
      {{ $clients->links() }}
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>


