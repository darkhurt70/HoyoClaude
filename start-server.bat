@echo off
echo Demarrage du serveur PHP sur localhost:8000...
echo.
echo Ouvrez votre navigateur sur : http://localhost:8000
echo.
echo Appuyez sur Ctrl+C pour arreter le serveur
echo.
cd /d "%~dp0"
php -S localhost:8000
pause
