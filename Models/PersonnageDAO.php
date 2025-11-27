<?php

namespace Models;

use PDO;

/**
 * DAO pour la table Personnage
 */
class PersonnageDAO extends BasePDODAO {

    /**
     * Récupère tous les personnages (sans relations)
     *
     * @return array Liste de tous les personnages
     */
    public function getAll(): array {
        $sql = "SELECT * FROM PERSONNAGE ORDER BY name";
        $result = $this->execRequest($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère un personnage par son ID (sans relations)
     *
     * @param string $id L'ID du personnage
     * @return array|false Les données du personnage ou false
     */
    public function getById(string $id): array|false {
        $sql = "SELECT * FROM PERSONNAGE WHERE id = ?";
        $result = $this->execRequest($sql, [$id]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Crée un nouveau personnage
     *
     * @param string $id ID du personnage
     * @param string $name Nom du personnage
     * @param int|null $elementId ID de l'élément
     * @param int|null $unitclassId ID de la classe
     * @param int $rarity Rareté
     * @param int|null $originId ID de l'origine
     * @param string $urlImg URL de l'image
     * @return bool True si succès
     */
    public function create(
        string $id,
        string $name,
        ?int $elementId,
        ?int $unitclassId,
        int $rarity,
        ?int $originId,
        string $urlImg
    ): bool {
        $sql = "INSERT INTO PERSONNAGE (id, name, element, unitclass, rarity, origin, url_img)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $result = $this->execRequest($sql, [
            $id,
            $name,
            $elementId,
            $unitclassId,
            $rarity,
            $originId,
            $urlImg
        ]);
        return $result !== false;
    }

    /**
     * Met à jour un personnage
     *
     * @param string $id ID du personnage
     * @param string $name Nom du personnage
     * @param int|null $elementId ID de l'élément
     * @param int|null $unitclassId ID de la classe
     * @param int $rarity Rareté
     * @param int|null $originId ID de l'origine
     * @param string $urlImg URL de l'image
     * @return int Nombre de lignes affectées
     */
    public function update(
        string $id,
        string $name,
        ?int $elementId,
        ?int $unitclassId,
        int $rarity,
        ?int $originId,
        string $urlImg
    ): int {
        $sql = "UPDATE PERSONNAGE
                SET name = ?, element = ?, unitclass = ?, rarity = ?, origin = ?, url_img = ?
                WHERE id = ?";
        $result = $this->execRequest($sql, [
            $name,
            $elementId,
            $unitclassId,
            $rarity,
            $originId,
            $urlImg,
            $id
        ]);
        return $result->rowCount();
    }

    /**
     * Supprime un personnage
     *
     * @param string $id L'ID du personnage à supprimer
     * @return int Nombre de lignes affectées
     */
    public function delete(string $id): int {
        $sql = "DELETE FROM PERSONNAGE WHERE id = ?";
        $result = $this->execRequest($sql, [$id]);
        return $result->rowCount();
    }
}
