@echo off
title Serveur PHP - HoyoClaude
color 0A
echo ========================================
echo   SERVEUR PHP - HOYOCLAUDE
echo ========================================
echo.
echo Demarrage du serveur PHP sur localhost:8000...
echo Utilisation de PHP 8.4.13 local
echo.
echo Ouvrez votre navigateur sur : http://localhost:8000
echo.
echo ========================================
echo   POUR ARRETER LE SERVEUR :
echo   Tapez "STOP" puis appuyez sur Entree
echo ========================================
echo.
cd /d "%~dp0"
start /B "" "%~dp0php 8.4.13\php.exe" -S localhost:8000 > php_server.log 2>&1
echo.
echo Serveur demarre ! Tapez STOP pour arreter :
echo.

:loop
set /p input=">>> "
if /i "%input%"=="STOP" goto stop
if /i "%input%"=="stop" goto stop
if /i "%input%"=="EXIT" goto stop
if /i "%input%"=="exit" goto stop
if /i "%input%"=="QUIT" goto stop
if /i "%input%"=="quit" goto stop
echo Commande invalide. Tapez "STOP" pour arreter le serveur.
goto loop

:stop
echo.
echo Arret du serveur en cours...
taskkill /F /IM php.exe >nul 2>&1
echo Serveur arrete !
echo.
pause
