<?php
// Page de test simple pour vérifier le déploiement
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
        }
        h1 {
            font-size: 3em;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        }
        .status {
            font-size: 1.2em;
            margin: 10px 0;
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
        }
        .btn:hover {
            background: #e05a2b;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🚀 CRM BhConnect</h1>
        <div class="status success">✅ Serveur PHP fonctionnel</div>
        <div class="status success">✅ Page de test accessible</div>
        <div class="status success">✅ Thème BhConnect appliqué</div>
        <div class="status info">ℹ️ Version PHP: <?php echo phpversion(); ?></div>
        <div class="status info">ℹ️ Date: <?php echo date('d/m/Y à H:i:s'); ?></div>
        
        <div style="margin-top: 30px;">
            <a href="/" class="btn">🏠 Accueil</a>
            <a href="/login" class="btn">🔐 Connexion</a>
        </div>
    </div>
</body>
</html>
