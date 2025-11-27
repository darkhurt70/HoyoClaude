<?php

namespace Models;

use PDO;

/**
 * DAO pour la table Origin
 */
class OriginDAO extends BasePDODAO {

    /**
     * Récupère toutes les origines
     *
     * @return array Liste de toutes les origines
     */
    public function getAll(): array {
        $sql = "SELECT * FROM ORIGIN ORDER BY name";
        $result = $this->execRequest($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère une origine par son ID
     *
     * @param int $id L'ID de l'origine
     * @return array|false Les données de l'origine ou false
     */
    public function getById(int $id): array|false {
        $sql = "SELECT * FROM ORIGIN WHERE id = ?";
        $result = $this->execRequest($sql, [$id]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Crée une nouvelle origine
     *
     * @param Origin $origin L'origine à créer
     * @return bool True si succès
     */
    public function create(Origin $origin): bool {
        $sql = "INSERT INTO ORIGIN (name, url_img) VALUES (?, ?)";
        $result = $this->execRequest($sql, [
            $origin->getName(),
            $origin->getUrlImg()
        ]);
        return $result !== false;
    }

    /**
     * Met à jour une origine
     *
     * @param Origin $origin L'origine à mettre à jour
     * @return int Nombre de lignes affectées
     */
    public function update(Origin $origin): int {
        $sql = "UPDATE ORIGIN SET name = ?, url_img = ? WHERE id = ?";
        $result = $this->execRequest($sql, [
            $origin->getName(),
            $origin->getUrlImg(),
            $origin->getId()
        ]);
        return $result->rowCount();
    }

    /**
     * Supprime une origine
     *
     * @param int $id L'ID de l'origine à supprimer
     * @return int Nombre de lignes affectées
     */
    public function delete(int $id): int {
        $sql = "DELETE FROM ORIGIN WHERE id = ?";
        $result = $this->execRequest($sql, [$id]);
        return $result->rowCount();
    }
}
