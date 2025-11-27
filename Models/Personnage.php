<?php

namespace Models;

/**
 * Modèle Personnage
 * Représente un personnage de jeu Mihoyo
 */
class Personnage {
    private ?string $id;
    private string $name;
    private ?Element $element;
    private ?UnitClass $unitclass;
    private int $rarity;
    private ?Origin $origin;
    private string $urlImg;

    /**
     * Constructeur
     *
     * @param string|null $id
     * @param string $name
     * @param Element|null $element
     * @param UnitClass|null $unitclass
     * @param int $rarity
     * @param Origin|null $origin
     * @param string $urlImg
     */
    public function __construct(
        ?string $id = null,
        string $name = "",
        ?Element $element = null,
        ?UnitClass $unitclass = null,
        int $rarity = 1,
        ?Origin $origin = null,
        string $urlImg = ""
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->element = $element;
        $this->unitclass = $unitclass;
        $this->rarity = $rarity;
        $this->origin = $origin;
        $this->urlImg = $urlImg;
    }

    // Getters
    public function getId(): ?string {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getElement(): ?Element {
        return $this->element;
    }

    public function getUnitclass(): ?UnitClass {
        return $this->unitclass;
    }

    public function getRarity(): int {
        return $this->rarity;
    }

    public function getOrigin(): ?Origin {
        return $this->origin;
    }

    public function getUrlImg(): string {
        return $this->urlImg;
    }

    // Setters
    public function setId(?string $id): void {
        $this->id = $id;
    }

    public function setName(string $name): void {
        $this->name = $name;
    }

    public function setElement(?Element $element): void {
        $this->element = $element;
    }

    public function setUnitclass(?UnitClass $unitclass): void {
        $this->unitclass = $unitclass;
    }

    public function setRarity(int $rarity): void {
        $this->rarity = $rarity;
    }

    public function setOrigin(?Origin $origin): void {
        $this->origin = $origin;
    }

    public function setUrlImg(string $urlImg): void {
        $this->urlImg = $urlImg;
    }
}
