<?php

namespace BAI\Domain;

class Idee 
{
    /**
     * Idee id.
     *
     * @var integer
     */
    private $id;

    /**
     * Idee texte.
     *
     * @var string
     */
    private $texte;

    /**
     * Idee valide.
     *
     * @var string
     */
    private $valide;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getTexte() {
        return $this->texte;
    }

    public function setTexte($texte) {
        $this->texte = $texte;
        return $this;
    }

    public function getValide() {
        return $this->valide;
    }

    public function setValide($valide) {
        $this->valide = $valide;
        return $this;
    }
}
