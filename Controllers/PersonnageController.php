<?php

namespace Controllers;

use League\Plates\Engine;
use Services\PersonnageService;
use Services\LogService;
use Models\ElementDAO;
use Models\OriginDAO;
use Models\UnitClassDAO;

/**
 * Contrôleur pour gérer les personnages
 */
class PersonnageController {
    private Engine $templates;
    private MainController $mainController;
    private PersonnageService $personnageService;

    public function __construct() {
        $this->templates = new Engine('Views');
        $this->mainController = new MainController();
        $this->personnageService = new PersonnageService();
    }

    /**
     * Affiche le formulaire d'ajout de personnage
     *
     * @param string|null $message Message à afficher
     */
    public function displayAddPerso(?string $message = null): void {
        // Récupère les listes pour les selects
        $elementDAO = new ElementDAO();
        $originDAO = new OriginDAO();
        $unitClassDAO = new UnitClassDAO();

        $elements = $elementDAO->getAll();
        $origins = $originDAO->getAll();
        $unitClasses = $unitClassDAO->getAll();

        echo $this->templates->render('add-perso', [
            'message' => $message,
            'elements' => $elements,
            'origins' => $origins,
            'unitclasses' => $unitClasses,
            'personnage' => null,
            'isEdit' => false
        ]);
    }

    /**
     * Ajoute un nouveau personnage
     *
     * @param array $data Données du personnage
     */
    public function addPerso(array $data): void {
        try {
            $success = $this->personnageService->createPersonnage($data);

            if ($success) {
                LogService::logPersonnageCreated($data['name']);
                $this->mainController->index("Personnage '" . $data['name'] . "' créé avec succès !");
            } else {
                $this->displayAddPerso("Erreur lors de la création du personnage");
            }
        } catch (\Exception $e) {
            LogService::logError("Erreur création personnage: " . $e->getMessage());
            $this->displayAddPerso("Erreur : " . $e->getMessage());
        }
    }

    /**
     * Affiche le formulaire d'édition de personnage
     *
     * @param string $id ID du personnage
     * @param string|null $message Message à afficher
     */
    public function displayEditPerso(string $id, ?string $message = null): void {
        $personnage = $this->personnageService->getPersonnageById($id);

        if (!$personnage) {
            $this->mainController->index("Personnage non trouvé");
            return;
        }

        // Récupère les listes pour les selects
        $elementDAO = new ElementDAO();
        $originDAO = new OriginDAO();
        $unitClassDAO = new UnitClassDAO();

        $elements = $elementDAO->getAll();
        $origins = $originDAO->getAll();
        $unitClasses = $unitClassDAO->getAll();

        echo $this->templates->render('add-perso', [
            'message' => $message,
            'elements' => $elements,
            'origins' => $origins,
            'unitclasses' => $unitClasses,
            'personnage' => $personnage,
            'isEdit' => true
        ]);
    }

    /**
     * Met à jour un personnage et redirige vers l'index
     *
     * @param array $data Données du personnage
     */
    public function editPersoAndIndex(array $data): void {
        try {
            $rowCount = $this->personnageService->updatePersonnage($data);

            if ($rowCount > 0) {
                LogService::logPersonnageUpdated($data['id'], $data['name']);
                $this->mainController->index("Personnage '" . $data['name'] . "' mis à jour avec succès !");
            } else {
                $this->displayEditPerso($data['id'], "Aucune modification effectuée");
            }
        } catch (\Exception $e) {
            LogService::logError("Erreur modification personnage: " . $e->getMessage());
            $this->displayEditPerso($data['id'], "Erreur : " . $e->getMessage());
        }
    }

    /**
     * Supprime un personnage et redirige vers l'index
     *
     * @param string|null $id ID du personnage
     * @param string|null $errorMessage Message d'erreur si ID manquant
     */
    public function deletePersoAndIndex(?string $id = null, ?string $errorMessage = null): void {
        if ($id === null) {
            $this->mainController->index($errorMessage ?? "ID de personnage manquant");
            return;
        }

        try {
            $rowCount = $this->personnageService->deletePersonnage($id);

            if ($rowCount > 0) {
                LogService::logPersonnageDeleted($id);
                $this->mainController->index("Personnage supprimé avec succès !");
            } else {
                $this->mainController->index("Aucun personnage supprimé");
            }
        } catch (\Exception $e) {
            LogService::logError("Erreur suppression personnage: " . $e->getMessage());
            $this->mainController->index("Erreur : " . $e->getMessage());
        }
    }
}
