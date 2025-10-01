<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion - CRM-Bh Connect</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  <link href="{{ asset('css/bhconnect-theme.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="login-container">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-12 col-sm-10 col-md-8 col-lg-5">
        <div class="card login-card">
          <div class="login-header">
            <div class="login-logo">
              <img src="{{ asset('images/bhconnect-logo.svg') }}" alt="BhConnect Logo">
            </div>
          </div>
          <div class="card-body p-4">
            <h1 class="h4 mb-1 text-bh-blue">Se connecter</h1>
            <p class="text-muted mb-4">Accédez à votre tableau de bord</p>

@if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
@foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
@endforeach
              </ul>
            </div>
@endif

            <form method="POST" action="{{ route('login.attempt') }}">
              @csrf
              <div class="mb-3">
                <label for="email" class="form-label">Adresse email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember" value="1">
                <label class="form-check-label" for="remember">Se souvenir de moi</label>
              </div>
              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Se connecter</button>
              </div>
            </form>
          </div>
        </div>
        <p class="text-center text-white mt-3">© 2024 BhConnect - Tous droits réservés</p>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>



