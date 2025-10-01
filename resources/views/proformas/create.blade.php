<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle Proforma - CRM-Bh Connect</title>
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
                    <a href="{{ route('proformas.index') }}" class="list-group-item list-group-item-action active">Proformas</a>
                    <a href="{{ route('messages.index') }}" class="list-group-item list-group-item-action">Messages</a>
                    <a href="{{ route('reports.financial') }}" class="list-group-item list-group-item-action">Rapport financier</a>
                </div>
            </aside>

            <main class="col-12 col-md-9 col-lg-10">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h1 class="h3 mb-0">Nouvelle Proforma</h1>
                        <p class="text-muted">Client: {{ $client->first_name }} {{ $client->last_name }}</p>
                    </div>
                    <a href="{{ route('proformas.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i>Retour
                    </a>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h5 class="card-title mb-0">Détails de la proforma</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('proformas.store', $client) }}">
                            @csrf
                            
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label">Taxe (FCFA)</label>
                                    <input name="tax" type="number" step="0.01" class="form-control" placeholder="0.00" />
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Devise</label>
                                    <select name="currency" class="form-select">
                                        <option value="XAF" selected>FCFA</option>
                                        <option value="EUR">EUR</option>
                                        <option value="USD">USD</option>
                                    </select>
                                </div>
                            </div>

                            <h6 class="mb-3">Articles</h6>
                            <div id="items">
                                <div class="item border rounded p-3 mb-3 bg-light">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Description</label>
                                            <input name="items[0][description]" class="form-control" placeholder="Description de l'article" required />
                                        </div>
                                        <div class="col-md-2">
                                            <label class="form-label">Quantité</label>
                                            <input name="items[0][quantity]" type="number" step="0.01" class="form-control" placeholder="1" required />
                                        </div>
                                        <div class="col-md-3">
                                            <label class="form-label">Prix Unitaire</label>
                                            <input name="items[0][unit_price]" type="number" step="0.01" class="form-control" placeholder="0.00" required />
                                        </div>
                                        <div class="col-md-1 d-flex align-items-end">
                                            <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeItem(this)">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-2 mb-4">
                                <button type="button" class="btn btn-outline-primary" onclick="addItem()">
                                    <i class="bi bi-plus-circle me-1"></i>Ajouter un article
                                </button>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-save me-1"></i>Enregistrer
                                </button>
                                <a href="{{ route('proformas.index') }}" class="btn btn-outline-secondary">Annuler</a>
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let itemIndex = 1;
        
        function addItem() {
            const itemsContainer = document.getElementById('items');
            const newItem = document.createElement('div');
            newItem.className = 'item border rounded p-3 mb-3 bg-light';
            newItem.innerHTML = `
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Description</label>
                        <input name="items[${itemIndex}][description]" class="form-control" placeholder="Description de l'article" required />
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Quantité</label>
                        <input name="items[${itemIndex}][quantity]" type="number" step="0.01" class="form-control" placeholder="1" required />
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Prix Unitaire</label>
                        <input name="items[${itemIndex}][unit_price]" type="number" step="0.01" class="form-control" placeholder="0.00" required />
                    </div>
                    <div class="col-md-1 d-flex align-items-end">
                        <button type="button" class="btn btn-outline-danger btn-sm" onclick="removeItem(this)">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            `;
            itemsContainer.appendChild(newItem);
            itemIndex++;
        }
        
        function removeItem(button) {
            button.closest('.item').remove();
        }
    </script>
</body>
</html>


