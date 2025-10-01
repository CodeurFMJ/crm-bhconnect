<?php
// Version de test simple pour Railway
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM BhConnect - Test</title>
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
            max-width: 600px;
        }
        .logo {
            font-size: 3em;
            font-weight: bold;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }
        .status {
            font-size: 1.5em;
            margin: 20px 0;
            padding: 15px;
            background: rgba(0, 255, 0, 0.2);
            border-radius: 5px;
        }
        .info {
            background: rgba(255, 255, 255, 0.2);
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
            text-align: left;
        }
        .btn {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            text-decoration: none;
            padding: 15px 30px;
            border-radius: 5px;
            margin: 10px;
            transition: background 0.3s;
        }
        .btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">Bh Connect</div>
        <div class="status">✅ Application déployée avec succès !</div>
        
        <div class="info">
            <h3>🚀 Informations du serveur :</h3>
            <p><strong>PHP Version :</strong> <?php echo phpversion(); ?></p>
            <p><strong>Serveur :</strong> <?php echo $_SERVER['SERVER_SOFTWARE'] ?? 'PHP Built-in Server'; ?></p>
            <p><strong>Port :</strong> <?php echo $_SERVER['SERVER_PORT'] ?? 'Inconnu'; ?></p>
            <p><strong>Date/Heure :</strong> <?php echo date('Y-m-d H:i:s'); ?></p>
        </div>
        
        <div class="info">
            <h3>⚙️ Variables d'environnement :</h3>
            <p><strong>PORT :</strong> <?php echo getenv('PORT') ?: 'Non défini'; ?></p>
            <p><strong>APP_ENV :</strong> <?php echo getenv('APP_ENV') ?: 'Non défini'; ?></p>
            <p><strong>DATABASE_URL :</strong> <?php echo getenv('DATABASE_URL') ? '✅ Défini' : '❌ Non défini'; ?></p>
        </div>
        
        <div class="info">
            <h3>📊 Statut de l'application :</h3>
            <p>✅ Serveur PHP fonctionnel</p>
            <p>✅ Page de test accessible</p>
            <p>✅ Thème BhConnect appliqué</p>
            <p>⚠️ Base de données : <?php echo getenv('DATABASE_URL') ? 'Configurée' : 'Non configurée'; ?></p>
        </div>
        
        <div>
            <a href="/test.php" class="btn">🧪 Page de test détaillée</a>
            <a href="/" class="btn">🏠 Application Laravel</a>
        </div>
        
        <div style="margin-top: 30px; font-size: 0.9em; opacity: 0.8;">
            <p>CRM BhConnect - Version de test Railway</p>
            <p>Déployé le <?php echo date('d/m/Y à H:i:s'); ?></p>
        </div>
    </div>
</body>
</html>
