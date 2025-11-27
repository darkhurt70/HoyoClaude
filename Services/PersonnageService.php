<?php

namespace Services;

use Models\Personnage;
use Models\PersonnageDAO;
use Models\ElementDAO;
use Models\OriginDAO;
use Models\UnitClassDAO;
use Models\Element;
use Models\Origin;
use Models\UnitClass;

/**
 * Service pour gérer les personnages avec leurs relations
 */
class PersonnageService {
    private PersonnageDAO $personnageDAO;
    private ElementDAO $elementDAO;
    private OriginDAO $originDAO;
    private UnitClassDAO $unitClassDAO;

    public function __construct() {
        $this->personnageDAO = new PersonnageDAO();
        $this->elementDAO = new ElementDAO();
        $this->originDAO = new OriginDAO();
        $this->unitClassDAO = new UnitClassDAO();
    }

    /**
     * Récupère tous les personnages avec leurs relations
     *
     * @return array Tableau de Personnage
     */
    public function getAllPersonnages(): array {
        $personnagesData = $this->personnageDAO->getAll();
        $personnages = [];

        foreach ($personnagesData as $data) {
            $personnages[] = $this->buildPersonnageFromData($data);
        }

        return $personnages;
    }

    /**
     * Récupère un personnage par son ID avec ses relations
     *
     * @param string $id L'ID du personnage
     * @return Personnage|null Le personnage ou null
     */
    public function getPersonnageById(string $id): ?Personnage {
        $data = $this->personnageDAO->getById($id);
        if (!$data) {
            return null;
        }

        return $this->buildPersonnageFromData($data);
    }

    /**
     * Construit un objet Personnage à partir des données brutes
     *
     * @param array $data Les données du personnage
     * @return Personnage Le personnage construit
     */
    private function buildPersonnageFromData(array $data): Personnage {
        // Récupère l'élément
        $element = null;
        if ($data['element']) {
            $elementData = $this->elementDAO->getById($data['element']);
            if ($elementData) {
                $element = new Element(
                    $elementData['id'],
                    $elementData['name'],
                    $elementData['url_img']
                );
            }
        }

        // Récupère la classe
        $unitclass = null;
        if ($data['unitclass']) {
            $unitclassData = $this->unitClassDAO->getById($data['unitclass']);
            if ($unitclassData) {
                $unitclass = new UnitClass(
                    $unitclassData['id'],
                    $unitclassData['name'],
                    $unitclassData['url_img']
                );
            }
        }

        // Récupère l'origine
        $origin = null;
        if ($data['origin']) {
            $originData = $this->originDAO->getById($data['origin']);
            if ($originData) {
                $origin = new Origin(
                    $originData['id'],
                    $originData['name'],
                    $originData['url_img']
                );
            }
        }

        return new Personnage(
            $data['id'],
            $data['name'],
            $element,
            $unitclass,
            $data['rarity'],
            $origin,
            $data['url_img']
        );
    }

    /**
     * Crée un nouveau personnage
     *
     * @param array $data Données du personnage
     * @return bool True si succès
     */
    public function createPersonnage(array $data): bool {
        $id = uniqid();
        return $this->personnageDAO->create(
            $id,
            $data['name'],
            $data['element'] ?? null,
            $data['unitclass'] ?? null,
            $data['rarity'],
            $data['origin'] ?? null,
            $data['urlImg']
        );
    }

    /**
     * Met à jour un personnage
     *
     * @param array $data Données du personnage
     * @return int Nombre de lignes affectées
     */
    public function updatePersonnage(array $data): int {
        return $this->personnageDAO->update(
            $data['id'],
            $data['name'],
            $data['element'] ?? null,
            $data['unitclass'] ?? null,
            $data['rarity'],
            $data['origin'] ?? null,
            $data['urlImg']
        );
    }

    /**
     * Supprime un personnage
     *
     * @param string $id L'ID du personnage
     * @return int Nombre de lignes affectées
     */
    public function deletePersonnage(string $id): int {
        return $this->personnageDAO->delete($id);
    }
}
