<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Notes - CRM-Bh Connect</title>
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
    <h1 class="h4 mb-0">Notes</h1>
    <a href="{{ route('dashboard') }}" class="btn btn-light">Retour au tableau de bord</a>
  </div>
  <div class="card">
    <div class="table-responsive">
      <table class="table table-hover mb-0">
        <thead class="table-light">
          <tr>
            <th>Date</th>
            <th>Client</th>
            <th>Contenu</th>
          </tr>
        </thead>
        <tbody>
@forelse ($notes as $note)
          <tr>
            <td>{{ optional($note->created_at)->format('d/m/Y H:i') }}</td>
            <td>{{ optional($note->client)->last_name }} {{ optional($note->client)->first_name }}</td>
            <td>{{ $note->content }}</td>
          </tr>
@empty
          <tr>
            <td colspan="3" class="text-center text-muted">Aucune note</td>
          </tr>
@endforelse
        </tbody>
      </table>
    </div>
    <div class="card-body">
      {{ $notes->links() }}
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>


