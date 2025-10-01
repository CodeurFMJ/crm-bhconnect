<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvel Utilisateur - CRM-Bh Connect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
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
                    <a href="{{ route('proformas.index') }}" class="list-group-item list-group-item-action">Proformas</a>
                    <a href="{{ route('messages.index') }}" class="list-group-item list-group-item-action">Messages</a>
                    <a href="{{ route('reports.financial') }}" class="list-group-item list-group-item-action">Rapport financier</a>
                    <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action active">Gestion des utilisateurs</a>
                </div>
            </aside>

            <main class="col-12 col-md-9 col-lg-10">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="page-header">
                        <h1 class="h3 mb-0">Nouvel Utilisateur</h1>
                        <p class="text-muted">Créer un compte pour un employé</p>
                    </div>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i>Retour
                    </a>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">Informations du compte</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.users.store') }}">
                            @csrf
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nom complet</label>
                                    <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required />
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email</label>
                                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required />
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Mot de passe</label>
                                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" required />
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Confirmer le mot de passe</label>
                                    <input name="password_confirmation" type="password" class="form-control" required />
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Rôle</label>
                                <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                                    <option value="">Sélectionner un rôle</option>
                                    <option value="employee" {{ old('role') === 'employee' ? 'selected' : '' }}>Employé</option>
                                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Administrateur</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-1"></i>Créer l'utilisateur
                                </button>
                                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Annuler</a>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


