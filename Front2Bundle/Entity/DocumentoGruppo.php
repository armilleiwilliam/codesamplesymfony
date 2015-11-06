<?php

namespace Casa\Front2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentoGruppo
 */
class DocumentoGruppo {
    
    /**
     * @var string
     */
    private $gruppo;

    /**
     * @var string
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $documentiTipo;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->documentiTipo = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set gruppo
     *
     * @param string $gruppo
     * @return DocumentoGruppo
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
     * Get id
     *
     * @return string 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add documentiTipo
     *
     * @param \Casa\Front2Bundle\Entity\DocumentoTipo $documentiTipo
     * @return DocumentoGruppo
     */
    public function addDocumentiTipo(\Casa\Front2Bundle\Entity\DocumentoTipo $documentiTipo)
    {
        $this->documentiTipo[] = $documentiTipo;

        return $this;
    }

    /**
     * Remove documentiTipo
     *
     * @param \Casa\Front2Bundle\Entity\DocumentoTipo $documentiTipo
     */
    public function removeDocumentiTipo(\Casa\Front2Bundle\Entity\DocumentoTipo $documentiTipo)
    {
        $this->documentiTipo->removeElement($documentiTipo);
    }

    /**
     * Get documentiTipo
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDocumentiTipo()
    {
        return $this->documentiTipo;
    }
    
    public function __toString() {
        return $this->gruppo;
    }
}
