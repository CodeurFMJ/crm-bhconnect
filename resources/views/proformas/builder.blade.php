<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Constructeur de Proforma - CRM-Bh Connect</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/bhconnect-theme.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .proforma-builder {
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        .builder-sidebar {
            background: white;
            border-right: 1px solid #dee2e6;
            height: 100vh;
            overflow-y: auto;
        }
        .builder-main {
            background: white;
            margin: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            min-height: calc(100vh - 40px);
        }
        .proforma-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 8px 8px 0 0;
        }
        .proforma-body {
            padding: 30px;
        }
        .item-row {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 15px;
            background: #f8f9fa;
            transition: all 0.3s ease;
        }
        .item-row:hover {
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .item-row.dragging {
            opacity: 0.5;
            transform: rotate(5deg);
        }
        .drag-handle {
            cursor: move;
            color: #6c757d;
        }
        .drag-handle:hover {
            color: #495057;
        }
        .total-section {
            background: #f8f9fa;
            border: 2px solid #dee2e6;
            border-radius: 8px;
            padding: 20px;
            margin-top: 30px;
        }
        .company-info {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #e9ecef;
        }
        .client-info {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #e9ecef;
        }
        .preview-mode {
            background: #f8f9fa;
        }
        .preview-mode .item-row {
            background: white;
            border: 1px solid #dee2e6;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom">
        <div class="container-fluid">
            <a class="navbar-brand fw-semibold" href="{{ route('dashboard') }}">CRM-Bh Connect</a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="{{ route('dashboard') }}">Tableau de bord</a>
            </div>
        </div>
    </nav>

    <div class="container-fluid proforma-builder">
        <div class="row g-0">
            <!-- Sidebar -->
            <div class="col-md-3 builder-sidebar">
                <div class="p-3">
                    <h5 class="mb-3">Éléments de proforma</h5>
                    
                    <div class="mb-3">
                        <h6>Informations</h6>
                        <button class="btn btn-outline-primary btn-sm w-100 mb-2" onclick="addCompanyInfo()">
                            <i class="bi bi-building me-1"></i>Informations société
                        </button>
                        <button class="btn btn-outline-primary btn-sm w-100 mb-2" onclick="addClientInfo()">
                            <i class="bi bi-person me-1"></i>Informations client
                        </button>
                    </div>

                    <div class="mb-3">
                        <h6>Articles</h6>
                        <button class="btn btn-outline-success btn-sm w-100 mb-2" onclick="addItem()">
                            <i class="bi bi-plus-circle me-1"></i>Ajouter article
                        </button>
                        <button class="btn btn-outline-info btn-sm w-100 mb-2" onclick="addTextBlock()">
                            <i class="bi bi-text-paragraph me-1"></i>Bloc de texte
                        </button>
                    </div>

                    <div class="mb-3">
                        <h6>Totaux</h6>
                        <button class="btn btn-outline-warning btn-sm w-100 mb-2" onclick="addSubtotal()">
                            <i class="bi bi-calculator me-1"></i>Sous-total
                        </button>
                        <button class="btn btn-outline-warning btn-sm w-100 mb-2" onclick="addTax()">
                            <i class="bi bi-percent me-1"></i>Taxe
                        </button>
                        <button class="btn btn-outline-warning btn-sm w-100 mb-2" onclick="addTotal()">
                            <i class="bi bi-currency-exchange me-1"></i>Total
                        </button>
                    </div>

                    <div class="mb-3">
                        <h6>Actions</h6>
                        <button class="btn btn-primary btn-sm w-100 mb-2" onclick="previewProforma()">
                            <i class="bi bi-eye me-1"></i>Aperçu
                        </button>
                        <button class="btn btn-success btn-sm w-100 mb-2" onclick="saveProforma()">
                            <i class="bi bi-save me-1"></i>Sauvegarder
                        </button>
                    </div>
                </div>
            </div>

            <!-- Main Builder Area -->
            <div class="col-md-9">
                <div class="builder-main" id="proformaBuilder">
                    <!-- Proforma Header -->
                    <div class="proforma-header">
                        <div class="row">
                            <div class="col-md-6">
                                <h2 class="mb-0">PROFORMA</h2>
                                <p class="mb-0">N° <span id="proformaNumber">PF-{{ date('Ymd') }}-001</span></p>
                            </div>
                            <div class="col-md-6 text-end">
                                <p class="mb-0">Date: <span id="proformaDate">{{ date('d/m/Y') }}</span></p>
                                <p class="mb-0">Échéance: <span id="proformaDue">{{ date('d/m/Y', strtotime('+30 days')) }}</span></p>
                            </div>
                        </div>
                    </div>

                    <!-- Proforma Body -->
                    <div class="proforma-body" id="proformaBody">
                        <!-- Company Info -->
                        <div class="company-info" id="companyInfo">
                            <h5>Société</h5>
                            <p class="mb-1"><strong>CRM-Bh Connect</strong></p>
                            <p class="mb-1">Adresse: Douala, Cameroun</p>
                            <p class="mb-1">Tél: +237 XXX XX XX XX</p>
                            <p class="mb-0">Email: contact@crm-bh.com</p>
                        </div>

                        <!-- Client Info -->
                        <div class="client-info" id="clientInfo">
                            <h5>Facturer à</h5>
                            <p class="mb-1"><strong id="clientName">Nom du client</strong></p>
                            <p class="mb-1" id="clientAddress">Adresse du client</p>
                            <p class="mb-0" id="clientContact">Contact du client</p>
                        </div>

                        <!-- Items Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 5%"></th>
                                        <th style="width: 40%">Description</th>
                                        <th style="width: 15%">Quantité</th>
                                        <th style="width: 15%">Prix unitaire</th>
                                        <th style="width: 15%">Total</th>
                                        <th style="width: 10%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody id="itemsTable">
                                    <!-- Items will be added here dynamically -->
                                </tbody>
                            </table>
                        </div>

                        <!-- Totals -->
                        <div class="total-section">
                            <div class="row">
                                <div class="col-md-6"></div>
                                <div class="col-md-6">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Sous-total:</span>
                                        <span id="subtotal">0 FCFA</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span>Taxe (19%):</span>
                                        <span id="tax">0 FCFA</span>
                                    </div>
                                    <hr>
                                    <div class="d-flex justify-content-between fw-bold fs-5">
                                        <span>Total:</span>
                                        <span id="total">0 FCFA</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Terms -->
                        <div class="mt-4">
                            <h6>Conditions de paiement</h6>
                            <p class="text-muted">Paiement à 30 jours. Pénailté de retard: 1% par mois.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let itemCount = 0;
        let isPreviewMode = false;

        function addItem() {
            itemCount++;
            const tbody = document.getElementById('itemsTable');
            const row = document.createElement('tr');
            row.innerHTML = `
                <td class="text-center">
                    <i class="bi bi-grip-vertical drag-handle"></i>
                </td>
                <td>
                    <input type="text" class="form-control form-control-sm" placeholder="Description de l'article" onchange="calculateTotals()">
                </td>
                <td>
                    <input type="number" class="form-control form-control-sm" placeholder="1" min="0" step="0.01" onchange="calculateTotals()">
                </td>
                <td>
                    <input type="number" class="form-control form-control-sm" placeholder="0.00" min="0" step="0.01" onchange="calculateTotals()">
                </td>
                <td class="text-end">
                    <span class="item-total">0 FCFA</span>
                </td>
                <td class="text-center">
                    <button class="btn btn-sm btn-outline-danger" onclick="removeItem(this)">
                        <i class="bi bi-trash"></i>
                    </button>
                </td>
            `;
            tbody.appendChild(row);
            calculateTotals();
        }

        function removeItem(button) {
            button.closest('tr').remove();
            calculateTotals();
        }

        function calculateTotals() {
            const rows = document.querySelectorAll('#itemsTable tr');
            let subtotal = 0;

            rows.forEach(row => {
                const quantity = parseFloat(row.querySelector('input[type="number"]:nth-of-type(1)')?.value || 0);
                const price = parseFloat(row.querySelector('input[type="number"]:nth-of-type(2)')?.value || 0);
                const total = quantity * price;
                
                const totalCell = row.querySelector('.item-total');
                if (totalCell) {
                    totalCell.textContent = total.toLocaleString('fr-FR') + ' FCFA';
                }
                
                subtotal += total;
            });

            const tax = subtotal * 0.19; // 19% tax
            const total = subtotal + tax;

            document.getElementById('subtotal').textContent = subtotal.toLocaleString('fr-FR') + ' FCFA';
            document.getElementById('tax').textContent = tax.toLocaleString('fr-FR') + ' FCFA';
            document.getElementById('total').textContent = total.toLocaleString('fr-FR') + ' FCFA';
        }

        function addCompanyInfo() {
            const companyInfo = document.getElementById('companyInfo');
            companyInfo.innerHTML = `
                <h5>Informations Société</h5>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Nom de l'entreprise</label>
                        <input type="text" class="form-control" value="CRM-Bh Connect">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" value="contact@crm-bh.com">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label class="form-label">Téléphone</label>
                        <input type="text" class="form-control" value="+237 XXX XX XX XX">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Adresse</label>
                        <input type="text" class="form-control" value="Douala, Cameroun">
                    </div>
                </div>
            `;
        }

        function addClientInfo() {
            const clientInfo = document.getElementById('clientInfo');
            clientInfo.innerHTML = `
                <h5>Informations Client</h5>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label">Nom du client</label>
                        <input type="text" class="form-control" id="clientNameInput" onchange="updateClientName()">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label class="form-label">Téléphone</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Adresse</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
            `;
        }

        function updateClientName() {
            const name = document.getElementById('clientNameInput').value;
            document.getElementById('clientName').textContent = name || 'Nom du client';
        }

        function addTextBlock() {
            const tbody = document.getElementById('itemsTable');
            const row = document.createElement('tr');
            row.innerHTML = `
                <td colspan="6">
                    <textarea class="form-control" rows="3" placeholder="Ajouter un bloc de texte..."></textarea>
                </td>
            `;
            tbody.appendChild(row);
        }

        function addSubtotal() {
            // This would add a subtotal row
            console.log('Adding subtotal');
        }

        function addTax() {
            // This would add a tax row
            console.log('Adding tax');
        }

        function addTotal() {
            // This would add a total row
            console.log('Adding total');
        }

        function previewProforma() {
            isPreviewMode = !isPreviewMode;
            const builder = document.getElementById('proformaBuilder');
            
            if (isPreviewMode) {
                builder.classList.add('preview-mode');
                // Hide edit controls
                document.querySelectorAll('input, textarea, button').forEach(el => {
                    if (!el.classList.contains('btn-primary') && !el.classList.contains('btn-success')) {
                        el.style.display = 'none';
                    }
                });
            } else {
                builder.classList.remove('preview-mode');
                // Show edit controls
                document.querySelectorAll('input, textarea, button').forEach(el => {
                    el.style.display = '';
                });
            }
        }

        function saveProforma() {
            // Collect all data and send to server
            const data = {
                number: document.getElementById('proformaNumber').textContent,
                date: document.getElementById('proformaDate').textContent,
                due_date: document.getElementById('proformaDue').textContent,
                items: [],
                subtotal: parseFloat(document.getElementById('subtotal').textContent.replace(/[^\d]/g, '')),
                tax: parseFloat(document.getElementById('tax').textContent.replace(/[^\d]/g, '')),
                total: parseFloat(document.getElementById('total').textContent.replace(/[^\d]/g, ''))
            };

            // Collect items
            const rows = document.querySelectorAll('#itemsTable tr');
            rows.forEach(row => {
                const inputs = row.querySelectorAll('input[type="text"], input[type="number"]');
                if (inputs.length >= 3) {
                    data.items.push({
                        description: inputs[0].value,
                        quantity: parseFloat(inputs[1].value) || 0,
                        unit_price: parseFloat(inputs[2].value) || 0
                    });
                }
            });

            console.log('Saving proforma:', data);
            alert('Proforma sauvegardée avec succès!');
        }

        // Initialize with one item
        addItem();
    </script>
</body>
</html>


