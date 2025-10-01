<?php
// Page de test simple pour vérifier que l'application fonctionne
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test CRM BhConnect</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #FF6B35, #1B365D);
            color: white;
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 10px;
            backdrop-filter: blur(10px);
        }
        .logo {
            font-size: 3em;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .status {
            font-size: 1.2em;
            margin: 20px 0;
        }
        .info {
            background: rgba(255, 255, 255, 0.2);
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">Bh Connect</div>
        <div class="status">✅ Application fonctionnelle !</div>
        <div class="info">
            <h3>Informations du serveur :</h3>
            <p><strong>PHP Version :</strong> <?php echo phpversion(); ?></p>
            <p><strong>Serveur :</strong> <?php echo $_SERVER['SERVER_SOFTWARE'] ?? 'Inconnu'; ?></p>
            <p><strong>Port :</strong> <?php echo $_SERVER['SERVER_PORT'] ?? 'Inconnu'; ?></p>
            <p><strong>Date/Heure :</strong> <?php echo date('Y-m-d H:i:s'); ?></p>
        </div>
        <div class="info">
            <h3>Variables d'environnement :</h3>
            <p><strong>PORT :</strong> <?php echo getenv('PORT') ?: 'Non défini'; ?></p>
            <p><strong>APP_ENV :</strong> <?php echo getenv('APP_ENV') ?: 'Non défini'; ?></p>
            <p><strong>DATABASE_URL :</strong> <?php echo getenv('DATABASE_URL') ? 'Défini' : 'Non défini'; ?></p>
        </div>
        <div class="status">
            <a href="/" style="color: white; text-decoration: none; background: rgba(255, 255, 255, 0.2); padding: 10px 20px; border-radius: 5px;">
                🏠 Aller à l'application principale
            </a>
        </div>
    </div>
</body>
</html>
