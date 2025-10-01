@echo off
echo ========================================
echo    CRM-Bh Connect - Setup GitHub
echo ========================================
echo.

echo 1. Creer un repository sur GitHub:
echo    - Aller sur https://github.com
echo    - Cliquer sur "New repository"
echo    - Nom: crm-bhconnect
echo    - Description: CRM professionnel pour BhConnect
echo    - Cliquer sur "Create repository"
echo.

echo 2. Copier l'URL du repository (ex: https://github.com/votre-username/crm-bhconnect.git)
set /p REPO_URL="Entrez l'URL de votre repository GitHub: "

echo.
echo 3. Configuration du repository local...
git remote add origin %REPO_URL%
git branch -M main

echo.
echo 4. Pousser le code vers GitHub...
git push -u origin main

echo.
echo ========================================
echo    Repository configure avec succes!
echo ========================================
echo.
echo Prochaines etapes:
echo 1. Aller sur https://railway.app
echo 2. Se connecter avec GitHub
echo 3. "New Project" -> "Deploy from GitHub repo"
echo 4. Selectionner "crm-bhconnect"
echo.
pause
