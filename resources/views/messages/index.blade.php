<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages - CRM-Bh Connect</title>
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
                    <a href="{{ route('proformas.index') }}" class="list-group-item list-group-item-action">Proformas</a>
                    <a href="{{ route('messages.index') }}" class="list-group-item list-group-item-action active">Messages</a>
                    <a href="{{ route('reports.financial') }}" class="list-group-item list-group-item-action">Rapport financier</a>
                </div>
            </aside>

            <main class="col-12 col-md-9 col-lg-10">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="h3 mb-0">Messages</h1>
                        <p class="text-muted">Envoyez des emails et messages WhatsApp</p>
                    </div>
                </div>

                <div class="row g-4">
                    <!-- Email Section -->
                    <div class="col-12 col-lg-6">
                        <div class="card shadow-sm h-100">
                            <div class="card-header bg-primary text-white">
                                <h5 class="card-title mb-0">
                                    <i class="bi bi-envelope me-2"></i>Envoyer un Email
                                </h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('messages.email') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Destinataire</label>
                                        <input name="to" type="email" class="form-control" placeholder="client@example.com" required />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Sujet</label>
                                        <input name="subject" class="form-control" placeholder="Sujet du message" required />
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Message</label>
                                        <textarea name="body" class="form-control" rows="6" placeholder="Votre message..." required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Client (optionnel)</label>
                                        <select name="client_id" class="form-select">
                                            <option value="">Sélectionner un client</option>
                                            <!-- Add client options here -->
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="bi bi-send me-1"></i>Envoyer l'email
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- WhatsApp Section -->
                    <div class="col-12 col-lg-6">
                        <div class="card shadow-sm h-100">
                            <div class="card-header bg-success text-white">
                                <h5 class="card-title mb-0">
                                    <i class="bi bi-whatsapp me-2"></i>Envoyer WhatsApp
                                </h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('messages.whatsapp') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Numéro de téléphone</label>
                                        <input name="to" class="form-control" placeholder="+237 6XX XX XX XX" required />
                                        <div class="form-text">Format international requis (ex: +237 6XX XX XX XX)</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Message</label>
                                        <textarea name="body" class="form-control" rows="6" placeholder="Votre message WhatsApp..." required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Client (optionnel)</label>
                                        <select name="client_id" class="form-select">
                                            <option value="">Sélectionner un client</option>
                                            <!-- Add client options here -->
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-success w-100">
                                        <i class="bi bi-whatsapp me-1"></i>Envoyer WhatsApp
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Messages -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header bg-white">
                                <h5 class="card-title mb-0">Messages récents</h5>
                            </div>
                            <div class="card-body">
                                <div class="text-center text-muted py-4">
                                    <i class="bi bi-chat-dots fs-1 d-block mb-2"></i>
                                    Aucun message envoyé récemment
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


