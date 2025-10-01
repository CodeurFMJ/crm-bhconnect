<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Documents - CRM-Bh Connect</title>
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
    <h1 class="h4 mb-0">Documents</h1>
    <div class="d-flex gap-2">
      <a href="{{ route('dashboard') }}" class="btn btn-light">Retour au tableau de bord</a>
      <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadDocModal">Importer un fichier</button>
    </div>
  </div>
  <div class="card">
    <div class="table-responsive">
      <table class="table table-hover mb-0">
        <thead class="table-light">
          <tr>
            <th>Client</th>
            <th>Nom du fichier</th>
            <th>Type</th>
            <th>Taille</th>
            <th>Téléchargement</th>
          </tr>
        </thead>
        <tbody>
@forelse ($documents as $doc)
          <tr>
            <td>{{ optional($doc->client)->last_name }} {{ optional($doc->client)->first_name }}</td>
            <td>{{ $doc->title }}</td>
            <td>{{ $doc->mime_type }}</td>
            <td>{{ number_format($doc->size_bytes ?? 0) }} o</td>
            <td><a class="btn btn-sm btn-outline-primary" href="{{ Storage::disk('public')->url($doc->file_path) }}" target="_blank">Ouvrir</a></td>
          </tr>
@empty
          <tr>
            <td colspan="5" class="text-center text-muted">Aucun document</td>
          </tr>
@endforelse
        </tbody>
      </table>
    </div>
    <div class="card-body">
      {{ $documents->links() }}
    </div>
  </div>
</div>

<div class="modal fade" id="uploadDocModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Importer un document</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Client</label>
            <select name="client_id" class="form-select" required>
              <option value="" disabled selected>Choisir un client</option>
@foreach ($clients as $c)
              <option value="{{ $c->id }}">{{ $c->last_name }} {{ $c->first_name }}</option>
@endforeach
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label">Fichiers (PDF / Images / CSV)</label>
            <input type="file" name="files[]" class="form-control" multiple required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-primary">Importer</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>


