<?php

namespace Models;

/**
 * Modèle UnitClass
 * Représente la classe (arme/path/speciality) d'un personnage
 */
class UnitClass {
    private ?int $id;
    private string $name;
    private string $urlImg;

    /**
     * Constructeur
     *
     * @param int|null $id
     * @param string $name
     * @param string $urlImg
     */
    public function __construct(?int $id = null, string $name = "", string $urlImg = "") {
        $this->id = $id;
        $this->name = $name;
        $this->urlImg = $urlImg;
    }

    // Getters
    public function getId(): ?int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getUrlImg(): string {
        return $this->urlImg;
    }

    // Setters
    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setUrlImg(string $urlImg): void {
        $this->urlImg = $urlImg;
    }
}
