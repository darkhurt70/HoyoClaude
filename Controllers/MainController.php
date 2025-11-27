<?php

namespace Controllers;

use League\Plates\Engine;
use Services\PersonnageService;
use Services\LogService;

/**
 * Contrôleur principal pour les pages générales
 */
class MainController {
    private Engine $templates;

    public function __construct() {
        $this->templates = new Engine('Views');
    }

    /**
     * Affiche la page d'accueil avec la liste des personnages
     *
     * @param string|null $message Message à afficher
     */
    public function index(?string $message = null): void {
        $personnageService = new PersonnageService();
        $personnages = $personnageService->getAllPersonnages();

        echo $this->templates->render('home', [
            'personnages' => $personnages,
            'message' => $message
        ]);
    }

    /**
     * Affiche la page des logs
     *
     * @param string|null $logFile Fichier de log à afficher
     */
    public function displayLogs(?string $logFile = null): void {
        $logFiles = LogService::getLogFiles();
        $logContent = null;

        // Si un fichier est spécifié, on le charge
        if ($logFile) {
            $logContent = LogService::readLogFile($logFile);
        } elseif (!empty($logFiles)) {
            // Sinon, on charge le plus récent
            $logContent = LogService::readLogFile($logFiles[0]);
            $logFile = $logFiles[0];
        }

        echo $this->templates->render('logs', [
            'logFiles' => $logFiles,
            'currentFile' => $logFile,
            'logContent' => $logContent
        ]);
    }

    /**
     * Affiche une page protégée (exemple)
     */
    public function displayProtected(): void {
        echo $this->templates->render('protected', []);
    }
}
