# CRM-Bh Connect - Setup GitHub Script
Write-Host "========================================" -ForegroundColor Cyan
Write-Host "    CRM-Bh Connect - Setup GitHub" -ForegroundColor Cyan
Write-Host "========================================" -ForegroundColor Cyan
Write-Host ""

Write-Host "1. Créer un repository sur GitHub:" -ForegroundColor Yellow
Write-Host "   - Aller sur https://github.com" -ForegroundColor White
Write-Host "   - Cliquer sur 'New repository'" -ForegroundColor White
Write-Host "   - Nom: crm-bhconnect" -ForegroundColor White
Write-Host "   - Description: CRM professionnel pour BhConnect" -ForegroundColor White
Write-Host "   - Cliquer sur 'Create repository'" -ForegroundColor White
Write-Host ""

$repoUrl = Read-Host "2. Entrez l'URL de votre repository GitHub (ex: https://github.com/votre-username/crm-bhconnect.git)"

Write-Host ""
Write-Host "3. Configuration du repository local..." -ForegroundColor Yellow
git remote add origin $repoUrl
git branch -M main

Write-Host ""
Write-Host "4. Pousser le code vers GitHub..." -ForegroundColor Yellow
git push -u origin main

Write-Host ""
Write-Host "========================================" -ForegroundColor Green
Write-Host "    Repository configuré avec succès!" -ForegroundColor Green
Write-Host "========================================" -ForegroundColor Green
Write-Host ""
Write-Host "Prochaines étapes:" -ForegroundColor Cyan
Write-Host "1. Aller sur https://railway.app" -ForegroundColor White
Write-Host "2. Se connecter avec GitHub" -ForegroundColor White
Write-Host "3. 'New Project' -> 'Deploy from GitHub repo'" -ForegroundColor White
Write-Host "4. Sélectionner 'crm-bhconnect'" -ForegroundColor White
Write-Host ""
Write-Host "Appuyez sur une touche pour continuer..." -ForegroundColor Gray
$null = $Host.UI.RawUI.ReadKey("NoEcho,IncludeKeyDown")
