<?php

namespace Models;

use PDO;

/**
 * DAO pour la table Users
 */
class UserDAO extends BasePDODAO {

    /**
     * Récupère un utilisateur par son username
     *
     * @param string $username Le nom d'utilisateur
     * @return array|false Les données de l'utilisateur ou false
     */
    public function getByUsername(string $username): array|false {
        $sql = "SELECT * FROM USERS WHERE username = ?";
        $result = $this->execRequest($sql, [$username]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère un utilisateur par son ID
     *
     * @param string $id L'ID de l'utilisateur
     * @return array|false Les données de l'utilisateur ou false
     */
    public function getById(string $id): array|false {
        $sql = "SELECT * FROM USERS WHERE id = ?";
        $result = $this->execRequest($sql, [$id]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Crée un nouvel utilisateur
     *
     * @param User $user L'utilisateur à créer
     * @return bool True si succès
     */
    public function create(User $user): bool {
        $sql = "INSERT INTO USERS (id, username, hash_pwd) VALUES (?, ?, ?)";
        $result = $this->execRequest($sql, [
            $user->getId(),
            $user->getUsername(),
            $user->getHashPwd()
        ]);
        return $result !== false;
    }
}
