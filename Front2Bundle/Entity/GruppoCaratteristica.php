<?php

namespace Casa\Front2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GruppoCaratteristica
 */
class GruppoCaratteristica
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $gruppo;

    /**
     * @var string
     */
    private $icona;


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
     * Set gruppo
     *
     * @param string $gruppo
     * @return GruppoCaratteristica
     */
    public function setGruppo($gruppo)
    {
        $this->gruppo = $gruppo;

        return $this;
    }

    /**
     * Get gruppo
     *
     * @return string 
     */
    public function getGruppo()
    {
        return $this->gruppo;
    }

    /**
     * Set icona
     *
     * @param string $icona
     * @return GruppoCaratteristica
     */
    public function setIcona($icona)
    {
        $this->icona = $icona;

        return $this;
    }

    /**
     * Get icona
     *
     * @return string 
     */
    public function getIcona()
    {
        return $this->icona;
    }
    
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $caratteristiche;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->caratteristiche = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add caratteristiche
     *
     * @param \Casa\Front2Bundle\Entity\Caratteristica $caratteristiche
     * @return GruppoCaratteristica
     */
    public function addCaratteristiche(\Casa\Front2Bundle\Entity\Caratteristica $caratteristiche)
    {
        $this->caratteristiche[] = $caratteristiche;

        return $this;
    }

    /**
     * Remove caratteristiche
     *
     * @param \Casa\Front2Bundle\Entity\Caratteristica $caratteristiche
     */
    public function removeCaratteristiche(\Casa\Front2Bundle\Entity\Caratteristica $caratteristiche)
    {
        $this->caratteristiche->removeElement($caratteristiche);
    }

    /**
     * Get caratteristiche
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCaratteristiche()
    {
        return $this->caratteristiche;
    }
    
    public function __toString() {
        return $this->gruppo;
    }
}
