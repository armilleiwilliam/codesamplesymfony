<?php

namespace Casa\Front2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tipologia
 */
class Tipologia {

    /**
     * @var string
     */
    private $tipologia;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $gruppi;
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $contatti;


    /**
     * Add contatti
     *
     * @param \Casa\Front2Bundle\Entity\Contatto $contatti
     * @return Tipologia
     */
    public function addContatti(\Casa\Front2Bundle\Entity\Contatto $contatti) {
        $this->agenzie[] = $agenzie;

        return $this;
    }

    /**
     * Remove contatti
     *
     * @param \Casa\Front2Bundle\Entity\Contatto $contatti
     */
    public function removeContatti(\Casa\Front2Bundle\Entity\Contatto $contatti) {
        $this->agenzie->removeElement($agenzie);
    }

    /**
     * Get contatti
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContatti() {
        return $this->contatti;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->gruppi = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set tipologia
     *
     * @param string $tipologia
     * @return Tipologia
     */
    public function setTipologia($tipologia)
    {
        $this->tipologia = $tipologia;

        return $this;
    }

    /**
     * Get tipologia
     *
     * @return string 
     */
    public function getTipologia()
    {
        return $this->tipologia;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add gruppi
     *
     * @param \Casa\Front2Bundle\Entity\GruppoCaratteristica $gruppi
     * @return Tipologia
     */
    public function addGruppi(\Casa\Front2Bundle\Entity\GruppoCaratteristica $gruppi)
    {
        $this->gruppi[] = $gruppi;

        return $this;
    }

    /**
     * Remove gruppi
     *
     * @param \Casa\Front2Bundle\Entity\GruppoCaratteristica $gruppi
     */
    public function removeGruppi(\Casa\Front2Bundle\Entity\GruppoCaratteristica $gruppi)
    {
        $this->gruppi->removeElement($gruppi);
    }

    /**
     * Get gruppi
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGruppi()
    {
        return $this->gruppi;
    }
    
    public function __toString() {
        return $this->tipologia.' ('.$this->categoria.')';
    }
    /**
     * @var \Casa\Front2Bundle\Entity\Categoria
     */
    private $categoria;


    /**
     * Set categoria
     *
     * @param \Casa\Front2Bundle\Entity\Categoria $categoria
     * @return Tipologia
     */
    public function setCategoria(\Casa\Front2Bundle\Entity\Categoria $categoria = null)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return \Casa\Front2Bundle\Entity\Categoria 
     */
    public function getCategoria()
    {
        return $this->categoria;
    }
}
