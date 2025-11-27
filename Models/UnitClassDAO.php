<?php

namespace Models;

use PDO;

/**
 * DAO pour la table UnitClass
 */
class UnitClassDAO extends BasePDODAO {

    /**
     * Récupère toutes les classes d'unités
     *
     * @return array Liste de toutes les classes
     */
    public function getAll(): array {
        $sql = "SELECT * FROM UNITCLASS ORDER BY name";
        $result = $this->execRequest($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère une classe par son ID
     *
     * @param int $id L'ID de la classe
     * @return array|false Les données de la classe ou false
     */
    public function getById(int $id): array|false {
        $sql = "SELECT * FROM UNITCLASS WHERE id = ?";
        $result = $this->execRequest($sql, [$id]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Crée une nouvelle classe
     *
     * @param UnitClass $unitClass La classe à créer
     * @return bool True si succès
     */
    public function create(UnitClass $unitClass): bool {
        $sql = "INSERT INTO UNITCLASS (name, url_img) VALUES (?, ?)";
        $result = $this->execRequest($sql, [
            $unitClass->getName(),
            $unitClass->getUrlImg()
        ]);
        return $result !== false;
    }

    /**
     * Met à jour une classe
     *
     * @param UnitClass $unitClass La classe à mettre à jour
     * @return int Nombre de lignes affectées
     */
    public function update(UnitClass $unitClass): int {
        $sql = "UPDATE UNITCLASS SET name = ?, url_img = ? WHERE id = ?";
        $result = $this->execRequest($sql, [
            $unitClass->getName(),
            $unitClass->getUrlImg(),
            $unitClass->getId()
        ]);
        return $result->rowCount();
    }

    /**
     * Supprime une classe
     *
     * @param int $id L'ID de la classe à supprimer
     * @return int Nombre de lignes affectées
     */
    public function delete(int $id): int {
        $sql = "DELETE FROM UNITCLASS WHERE id = ?";
        $result = $this->execRequest($sql, [$id]);
        return $result->rowCount();
    }
}
