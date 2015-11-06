<?php

namespace Casa\Front2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Criteria;

/**
 * Contratto
 */
class Contratto {

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $dataFirma;

    /**
     * @var \Casa\UserBundle\Entity\Agenzia
     */
    private $agenzia;

    /**
     * @var Contatto
     */
    private $proprietario;

    /**
     * @var boolean
     */
    private $esclusivita;

    /**
     * @var boolean
     */
    private $pullicazioneFoto;

    /**
     * @var boolean
     */
    private $collaborazioni;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set dataFirma
     *
     * @param \DateTime $dataFirma
     * @return Contratto
     */
    public function setDataFirma($dataFirma) {
        $this->dataFirma = $dataFirma;

        return $this;
    }

    /**
     * Get dataFirma
     *
     * @return \DateTime 
     */
    public function getDataFirma() {
        return $this->dataFirma;
    }

    /**
     * get agenzia
     * 
     * @return \Casa\UserBundle\Entity\Agenzia
     */
    public function getAgenzia() {
        return $this->agenzia;
    }

    /**
     * set agenzia
     * 
     * @param \Casa\UserBundle\Entity\Agenzia $agenzia
     * @return Contratto
     */
    public function setAgenzia(\Casa\UserBundle\Entity\Agenzia $agenzia) {
        $this->agenzia = $agenzia;

        return $this;
    }

    /**
     * Set proprietario
     *
     * @param Contatto $proprietario
     * @return Contratto
     */
    public function setProprietario($proprietario) {
        $this->proprietario = $proprietario;

        return $this;
    }

    /**
     * Get proprietario
     *
     * @return Contatto 
     */
    public function getProprietario() {
        return $this->proprietario;
    }

    /**
     * Set esclusivita
     *
     * @param boolean $esclusivita
     * @return Contratto
     */
    public function setEsclusivita($esclusivita) {
        $this->esclusivita = $esclusivita;

        return $this;
    }

    /**
     * Get esclusivita
     *
     * @return boolean 
     */
    public function getEsclusivita() {
        return $this->esclusivita;
    }

    /**
     * Set pullicazioneFoto
     *
     * @param boolean $pullicazioneFoto
     * @return Contratto
     */
    public function setPullicazioneFoto($pullicazioneFoto) {
        $this->pullicazioneFoto = $pullicazioneFoto;

        return $this;
    }

    /**
     * Get pullicazioneFoto
     *
     * @return boolean 
     */
    public function getPullicazioneFoto() {
        return $this->pullicazioneFoto;
    }

    /**
     * Set collaborazioni
     *
     * @param boolean $collaborazioni
     * @return Contratto
     */
    public function setCollaborazioni($collaborazioni) {
        $this->collaborazioni = $collaborazioni;

        return $this;
    }

    /**
     * Get collaborazioni
     *
     * @return boolean 
     */
    public function getCollaborazioni() {
        return $this->collaborazioni;
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $prezzi;

    /**
     * @var \Casa\Front2Bundle\Entity\Scheda
     */
    private $scheda;

    /**
     * Constructor
     */
    public function __construct() {
        $this->prezzi = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add prezzi
     *
     * @param \Casa\Front2Bundle\Entity\Prezzo $prezzi
     * @return Contratto
     */
    public function addPrezzi(\Casa\Front2Bundle\Entity\Prezzo $prezzi) {
        $this->prezzi[] = $prezzi;

        return $this;
    }
/**
     * Remove prezzi
     *
     * @param \Casa\Front2Bundle\Entity\Prezzo $prezzi
     */
    public function removePrezzi(\Casa\Front2Bundle\Entity\Prezzo $prezzi) {
        $this->prezzi->removeElement($prezzi);
    }
  

    /**
     * Get prezzi
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPrezzi() {
        return $this->prezzi;
    }

    /**
     * Set scheda
     *
     * @param \Casa\Front2Bundle\Entity\Scheda $scheda
     * @return Contratto
     */
    public function setScheda(\Casa\Front2Bundle\Entity\Scheda $scheda = null) {
        $this->scheda = $scheda;

        return $this;
    }

    /**
     * Get scheda
     *
     * @return \Casa\Front2Bundle\Entity\Scheda 
     */
    public function getScheda() {
        return $this->scheda;
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $documenti;

    /**
     * Add documenti
     *
     * @param \Casa\Front2Bundle\Entity\Documento $documenti
     * @return Contratto
     */
    public function addDocumenti(\Casa\Front2Bundle\Entity\Documento $documenti) {
        $this->documenti[] = $documenti;

        return $this;
    }

    /**
     * Remove documenti
     *
     * @param \Casa\Front2Bundle\Entity\Documento $documenti
     */
    public function removeDocumenti(\Casa\Front2Bundle\Entity\Documento $documenti) {
        $this->documenti->removeElement($documenti);
    }

    /**
     * Get documenti
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getDocumenti() {
        return $this->documenti;
    }

    public function getDoc($tipo) {
        try {
            $criteria = Criteria::create()
                    ->where(Criteria::expr()->eq("tipo", $tipo));
            $out = $this->documenti->matching($criteria);
            /* @var $out \Doctrine\Common\Collections\ArrayCollection */
            if (count($out) == 0) {
                return false;
            }
            return $out->first();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * 
     * @return Foto
     * @throws \Casa\Front2Bundle\Entity\Exception
     */
    public function getFotoPrincipale() {
        try {
            $criteria = Criteria::create()
                    ->where(Criteria::expr()->eq("principale", true));
            $out = $this->foto->matching($criteria);
            /* @var $out \Doctrine\Common\Collections\ArrayCollection */
            if (count($out) == 0) {
                return false;
            }
            return $out->first();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $foto;


    /**
     * Add foto
     *
     * @param \Casa\Front2Bundle\Entity\Foto $foto
     * @return Contratto
     */
    public function addFoto(\Casa\Front2Bundle\Entity\Foto $foto)
    {
        $this->foto[] = $foto;

        return $this;
    }

    /**
     * Remove foto
     *
     * @param \Casa\Front2Bundle\Entity\Foto $foto
     */
    public function removeFoto(\Casa\Front2Bundle\Entity\Foto $foto)
    {
        $this->foto->removeElement($foto);
    }

    /**
     * Get foto
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFoto()
    {
        return $this->foto;
    }
    /**
     * @var \Casa\Front2Bundle\Entity\Prezzo
     */
    private $prezzo;


    /**
     * Set prezzo
     *
     * @param \Casa\Front2Bundle\Entity\Prezzo $prezzo
     * @return Contratto
     */
    public function setPrezzo(\Casa\Front2Bundle\Entity\Prezzo $prezzo = null)
    {
        $this->prezzo = $prezzo;

        $this->addPrezzi($prezzo);
        
        return $this;
    }

    /**
     * Get prezzo
     *
     * @return \Casa\Front2Bundle\Entity\Prezzo 
     */
    public function getPrezzo()
    {
        return $this->prezzo;
    }
    
    public function __toString() {
        $str = $this->getScheda()->__toString();
        if($this->getPrezzo()->getVendita()) {
            // $str .= " per vendita ({$this->getPrezzo()->getPrezzoVendita()} €)";
        }
        if($this->getPrezzo()->getAffitto()) {
            // $str .= " per affitto ({$this->getPrezzo()->getPrezzoAffitto()} €)";
        }
        if($this->getPrezzo()->getTrattabili()) {
            $str .= " - prezzo trattabile";
        }
        return $str;
    }
}
