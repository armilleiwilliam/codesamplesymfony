<?php

namespace Casa\Front2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categoria
 */
class Categoria {

    /**
     * @var string
     */
    private $categoria;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $tipologie;

    /**
     * Constructor
     */
    public function __construct() {
        $this->tipologie = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set categoria
     *
     * @param string $categoria
     * @return Categoria
     */
    public function setCategoria($categoria) {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return string 
     */
    public function getCategoria() {
        return $this->categoria;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Add tipologie
     *
     * @param \Casa\Front2Bundle\Entity\Tipologia $tipologie
     * @return Categoria
     */
    public function addTipologie(\Casa\Front2Bundle\Entity\Tipologia $tipologie) {
        $this->tipologie[] = $tipologie;

        return $this;
    }

    /**
     * Remove tipologie
     *
     * @param \Casa\Front2Bundle\Entity\Tipologia $tipologie
     */
    public function removeTipologie(\Casa\Front2Bundle\Entity\Tipologia $tipologie) {
        $this->tipologie->removeElement($tipologie);
    }

    /**
     * Get tipologie
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTipologie() {
        return $this->tipologie;
    }

    public function __toString() {
        return $this->categoria;
    }

}
