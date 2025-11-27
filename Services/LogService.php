<?php

namespace Services;

/**
 * Service pour gérer les logs de l'application
 */
class LogService {
    private const LOG_DIR = 'logs/';

    /**
     * Écrit un message dans le fichier de log du mois en cours
     *
     * @param string $message Le message à logger
     * @param string $level Le niveau de log (INFO, ERROR, SUCCESS)
     */
    public static function log(string $message, string $level = 'INFO'): void {
        // Crée le nom du fichier basé sur le mois/année actuel
        $filename = self::LOG_DIR . 'MIHOYO_' . date('m_Y') . '.log';

        // Crée le répertoire logs s'il n'existe pas
        if (!is_dir(self::LOG_DIR)) {
            mkdir(self::LOG_DIR, 0777, true);
        }

        // Formate le message avec timestamp
        $timestamp = date('Y-m-d H:i:s');
        $logMessage = "[$timestamp] [$level] $message" . PHP_EOL;

        // Écrit dans le fichier
        file_put_contents($filename, $logMessage, FILE_APPEND);
    }

    /**
     * Récupère la liste des fichiers de log disponibles
     *
     * @return array Liste des fichiers de log (sans le chemin)
     */
    public static function getLogFiles(): array {
        if (!is_dir(self::LOG_DIR)) {
            return [];
        }

        $files = scandir(self::LOG_DIR);
        $logFiles = [];

        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..' && strpos($file, '.log') !== false) {
                $logFiles[] = $file;
            }
        }

        // Trie par date décroissante
        rsort($logFiles);

        return $logFiles;
    }

    /**
     * Lit le contenu d'un fichier de log
     *
     * @param string $filename Le nom du fichier de log
     * @return string|false Le contenu du fichier ou false
     */
    public static function readLogFile(string $filename): string|false {
        $filepath = self::LOG_DIR . basename($filename); // basename pour éviter les directory traversal

        if (!file_exists($filepath)) {
            return false;
        }

        return file_get_contents($filepath);
    }

    /**
     * Logs pour les opérations CRUD sur les personnages
     */
    public static function logPersonnageCreated(string $name): void {
        self::log("Personnage créé: $name", 'SUCCESS');
    }

    public static function logPersonnageUpdated(string $id, string $name): void {
        self::log("Personnage mis à jour: $name (ID: $id)", 'SUCCESS');
    }

    public static function logPersonnageDeleted(string $id): void {
        self::log("Personnage supprimé (ID: $id)", 'SUCCESS');
    }

    public static function logError(string $error): void {
        self::log($error, 'ERROR');
    }
}
