<?php

namespace Controllers;

use League\Plates\Engine;
use Models\ElementDAO;
use Models\OriginDAO;
use Models\UnitClassDAO;
use Models\Element;
use Models\Origin;
use Models\UnitClass;
use Services\LogService;

/**
 * Contrôleur pour gérer les éléments (Element, Origin, UnitClass)
 */
class ElementController {
    private Engine $templates;
    private MainController $mainController;

    public function __construct() {
        $this->templates = new Engine('Views');
        $this->mainController = new MainController();
    }

    /**
     * Affiche le formulaire d'ajout d'élément
     *
     * @param string|null $message Message à afficher
     */
    public function displayAddElement(?string $message = null): void {
        echo $this->templates->render('add-element', [
            'message' => $message
        ]);
    }

    /**
     * Ajoute un élément (element, origin ou unitclass)
     *
     * @param string $type Le type d'élément (element, origin, unitclass)
     * @param string $name Le nom
     * @param string $img L'URL de l'image
     */
    public function addElement(string $type, string $name, string $img): void {
        try {
            $success = false;

            switch ($type) {
                case 'element':
                    $dao = new ElementDAO();
                    $element = new Element(null, $name, $img);
                    $success = $dao->create($element);
                    break;

                case 'origin':
                    $dao = new OriginDAO();
                    $origin = new Origin(null, $name, $img);
                    $success = $dao->create($origin);
                    break;

                case 'unitclass':
                    $dao = new UnitClassDAO();
                    $unitClass = new UnitClass(null, $name, $img);
                    $success = $dao->create($unitClass);
                    break;

                default:
                    $this->displayAddElement("Type d'élément invalide");
                    return;
            }

            if ($success) {
                LogService::log("Élément créé: $name (type: $type)", 'SUCCESS');
                $this->mainController->index("Élément '$name' créé avec succès !");
            } else {
                $this->displayAddElement("Erreur lors de la création de l'élément");
            }
        } catch (\Exception $e) {
            LogService::logError("Erreur création élément: " . $e->getMessage());
            $this->displayAddElement("Erreur : " . $e->getMessage());
        }
    }
}
