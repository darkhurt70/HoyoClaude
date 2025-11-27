<?php

namespace Models;

use Config\Config;
use PDO;
use PDOStatement;

/**
 * Classe de base pour les DAO utilisant PDO
 */
abstract class BasePDODAO {
    private ?PDO $db = null;

    /**
     * Exécute une requête SQL
     *
     * @param string $sql La requête SQL à exécuter
     * @param array|null $params Les paramètres de la requête préparée
     * @return PDOStatement|false Le résultat de l'exécution
     */
    protected function execRequest(string $sql, ?array $params = null): PDOStatement|false {
        if ($params == null) {
            $result = $this->getDB()->query($sql);
        } else {
            $result = $this->getDB()->prepare($sql);
            $result->execute($params);
        }
        return $result;
    }

    /**
     * Obtient la connexion PDO (Singleton)
     *
     * @return PDO La connexion PDO
     */
    private function getDB(): PDO {
        if ($this->db == null) {
            // Récupère les paramètres de connexion depuis le fichier de config
            $dsn = Config::get('dsn');
            $user = Config::get('user');
            $pass = Config::get('pass');

            // Crée la connexion PDO
            $this->db = new PDO($dsn, $user, $pass);

            // Configure PDO pour lancer des exceptions en cas d'erreur
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return $this->db;
    }
}
