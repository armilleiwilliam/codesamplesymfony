<?php

namespace Casa\Front2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DocumentoTipo
 */
class DocumentoTipo
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
    private $tipo;

    /**
     * @var string
     */
    private $reperibilita;

    /**
     * @var string
     */
    private $consegnare;


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
     * @return DocumentoTipo
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
     * Set tipo
     *
     * @param string $tipo
     * @return DocumentoTipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set reperibilita
     *
     * @param string $reperibilita
     * @return DocumentoTipo
     */
    public function setReperibilita($reperibilita)
    {
        $this->reperibilita = $reperibilita;

        return $this;
    }

    /**
     * Get reperibilita
     *
     * @return string 
     */
    public function getReperibilita()
    {
        return $this->reperibilita;
    }

    /**
     * Set consegnare
     *
     * @param string $consegnare
     * @return DocumentoTipo
     */
    public function setConsegnare($consegnare)
    {
        $this->consegnare = $consegnare;

        return $this;
    }

    /**
     * Get consegnare
     *
     * @return string 
     */
    public function getConsegnare()
    {
        return $this->consegnare;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $documenti;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->documenti = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add documenti
     *
     * @param \Casa\Front2Bundle\Entity\Documento $documenti
     * @return DocumentoTipo
     */
    public function addDocumenti(\Casa\Front2Bundle\Entity\Documento $documenti)
    {
        $this->documenti[] = $documenti;

        return $this;
    }

    /**
     * Remove documenti
     *
     * @param \Casa\Front2Bundle\Entity\Documento $documenti
     */
    public function removeDocumenti(\Casa\Front2Bundle\Entity\Documento $documenti)
    {
        $this->documenti->removeElement($documenti);
    }

    /**
     * Get documenti
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDocumenti()
    {
        return $this->documenti;
    }
}
