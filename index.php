<?php
// Application CRM BhConnect - Version de test ultra-simple
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM BhConnect - Test</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #FF6B35 0%, #1B365D 100%);
            color: white;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .container {
            text-align: center;
            background: rgba(255, 255, 255, 0.1);
            padding: 40px;
            border-radius: 15px;
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            max-width: 600px;
            width: 100%;
        }
        
        .logo {
            font-size: 4em;
            font-weight: bold;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
            background: linear-gradient(45deg, #FF6B35, #FFD700);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .status {
            font-size: 1.8em;
            margin: 20px 0;
            padding: 20px;
            background: rgba(0, 255, 0, 0.2);
            border-radius: 10px;
            border: 2px solid rgba(0, 255, 0, 0.3);
        }
        
        .info {
            background: rgba(255, 255, 255, 0.15);
            padding: 25px;
            border-radius: 10px;
            margin: 20px 0;
            text-align: left;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .info h3 {
            color: #FFD700;
            margin-bottom: 15px;
            font-size: 1.3em;
        }
        
        .info p {
            margin: 8px 0;
            font-size: 1.1em;
        }
        
        .btn {
            display: inline-block;
            background: linear-gradient(45deg, #FF6B35, #FF8C42);
            color: white;
            text-decoration: none;
            padding: 15px 30px;
            border-radius: 25px;
            margin: 10px;
            transition: all 0.3s ease;
            font-weight: bold;
            box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 107, 53, 0.4);
        }
        
        .success {
            color: #90EE90;
            font-weight: bold;
        }
        
        .warning {
            color: #FFD700;
            font-weight: bold;
        }
        
        .error {
            color: #FF6B6B;
            font-weight: bold;
        }
        
        .footer {
            margin-top: 30px;
            font-size: 0.9em;
            opacity: 0.8;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">Bh Connect</div>
        <div class="status">✅ Application déployée avec succès !</div>
        
        <div class="info">
            <h3>🚀 Informations du serveur</h3>
            <p><strong>PHP Version :</strong> <span class="success"><?php echo phpversion(); ?></span></p>
            <p><strong>Serveur :</strong> <span class="success"><?php echo $_SERVER['SERVER_SOFTWARE'] ?? 'PHP Built-in Server'; ?></span></p>
            <p><strong>Port :</strong> <span class="success"><?php echo $_SERVER['SERVER_PORT'] ?? 'Inconnu'; ?></span></p>
            <p><strong>Date/Heure :</strong> <span class="success"><?php echo date('d/m/Y à H:i:s'); ?></span></p>
        </div>
        
        <div class="info">
            <h3>⚙️ Variables d'environnement</h3>
            <p><strong>PORT :</strong> 
                <?php 
                $port = getenv('PORT');
                if ($port) {
                    echo '<span class="success">' . $port . '</span>';
                } else {
                    echo '<span class="error">Non défini</span>';
                }
                ?>
            </p>
            <p><strong>APP_ENV :</strong> 
                <?php 
                $env = getenv('APP_ENV');
                if ($env) {
                    echo '<span class="success">' . $env . '</span>';
                } else {
                    echo '<span class="warning">Non défini</span>';
                }
                ?>
            </p>
            <p><strong>DATABASE_URL :</strong> 
                <?php 
                $db = getenv('DATABASE_URL');
                if ($db) {
                    echo '<span class="success">✅ Défini</span>';
                } else {
                    echo '<span class="warning">⚠️ Non défini</span>';
                }
                ?>
            </p>
        </div>
        
        <div class="info">
            <h3>📊 Statut de l'application</h3>
            <p><span class="success">✅ Serveur PHP fonctionnel</span></p>
            <p><span class="success">✅ Page de test accessible</span></p>
            <p><span class="success">✅ Thème BhConnect appliqué</span></p>
            <p><span class="success">✅ Interface responsive</span></p>
            <p>
                <?php 
                $db = getenv('DATABASE_URL');
                if ($db) {
                    echo '<span class="success">✅ Base de données configurée</span>';
                } else {
                    echo '<span class="warning">⚠️ Base de données non configurée</span>';
                }
                ?>
            </p>
        </div>
        
        <div>
            <a href="/test.php" class="btn">🧪 Test détaillé</a>
            <a href="/public/" class="btn">🏠 Application Laravel</a>
        </div>
        
        <div class="footer">
            <p><strong>CRM BhConnect</strong> - Version de test Railway</p>
            <p>Déployé le <?php echo date('d/m/Y à H:i:s'); ?></p>
            <p>ID de session : <?php echo session_id() ?: 'Non démarrée'; ?></p>
        </div>
    </div>
</body>
</html>
