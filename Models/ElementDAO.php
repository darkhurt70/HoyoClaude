<?php

namespace Models;

use PDO;

/**
 * DAO pour la table Element
 */
class ElementDAO extends BasePDODAO {

    /**
     * Récupère tous les éléments
     *
     * @return array Liste de tous les éléments
     */
    public function getAll(): array {
        $sql = "SELECT * FROM ELEMENT ORDER BY name";
        $result = $this->execRequest($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Récupère un élément par son ID
     *
     * @param int $id L'ID de l'élément
     * @return array|false Les données de l'élément ou false
     */
    public function getById(int $id): array|false {
        $sql = "SELECT * FROM ELEMENT WHERE id = ?";
        $result = $this->execRequest($sql, [$id]);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Crée un nouvel élément
     *
     * @param Element $element L'élément à créer
     * @return bool True si succès
     */
    public function create(Element $element): bool {
        $sql = "INSERT INTO ELEMENT (name, url_img) VALUES (?, ?)";
        $result = $this->execRequest($sql, [
            $element->getName(),
            $element->getUrlImg()
        ]);
        return $result !== false;
    }

    /**
     * Met à jour un élément
     *
     * @param Element $element L'élément à mettre à jour
     * @return int Nombre de lignes affectées
     */
    public function update(Element $element): int {
        $sql = "UPDATE ELEMENT SET name = ?, url_img = ? WHERE id = ?";
        $result = $this->execRequest($sql, [
            $element->getName(),
            $element->getUrlImg(),
            $element->getId()
        ]);
        return $result->rowCount();
    }

    /**
     * Supprime un élément
     *
     * @param int $id L'ID de l'élément à supprimer
     * @return int Nombre de lignes affectées
     */
    public function delete(int $id): int {
        $sql = "DELETE FROM ELEMENT WHERE id = ?";
        $result = $this->execRequest($sql, [$id]);
        return $result->rowCount();
    }
}
