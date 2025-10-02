<?php
// Page d'accueil simple pour Railway
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM BhConnect - Déployé sur Railway</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #1B365D, #FF6B35);
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
            border-radius: 20px;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            max-width: 600px;
        }
        h1 {
            font-size: 3em;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        .status {
            font-size: 1.2em;
            margin: 10px 0;
            padding: 10px;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.1);
        }
        .success {
            color: #4CAF50;
        }
        .info {
            color: #FFC107;
        }
        .btn {
            display: inline-block;
            padding: 15px 30px;
            background: #FF6B35;
            color: white;
            text-decoration: none;
            border-radius: 10px;
            margin: 10px;
            transition: all 0.3s;
            font-weight: bold;
        }
        .btn:hover {
            background: #e05a2b;
            transform: translateY(-2px);
        }
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }
        .feature {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🚀 CRM BhConnect</h1>
        <p style="font-size: 1.3em; margin-bottom: 30px;">Déployé avec succès sur Railway !</p>
        
        <div class="status success">✅ Serveur PHP fonctionnel</div>
        <div class="status success">✅ Application accessible</div>
        <div class="status success">✅ Thème BhConnect appliqué</div>
        <div class="status info">ℹ️ Version PHP: <?php echo phpversion(); ?></div>
        <div class="status info">ℹ️ Date: <?php echo date('d/m/Y à H:i:s'); ?></div>
        
        <div class="features">
            <div class="feature">
                <h3>👥 Gestion des clients</h3>
                <p>CRUD complet</p>
            </div>
            <div class="feature">
                <h3>📅 Rendez-vous</h3>
                <p>Planification et suivi</p>
            </div>
            <div class="feature">
                <h3>📊 Performance</h3>
                <p>Objectifs définis par l'admin</p>
            </div>
            <div class="feature">
                <h3>📁 Import/Export</h3>
                <p>Données CSV structurées</p>
            </div>
        </div>
        
        <div style="margin-top: 30px;">
            <a href="/test.php" class="btn">🧪 Page de test</a>
            <a href="/login" class="btn">🔐 Connexion</a>
        </div>
        
        <div style="margin-top: 20px; font-size: 0.9em; opacity: 0.8;">
            <p>🎉 Déploiement réussi sur Railway !</p>
            <p>🔗 URL: <?php echo $_SERVER['HTTP_HOST']; ?></p>
        </div>
    </div>
</body>
</html>
