<?php

namespace Casa\Front2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Criteria;

/**
 * Scheda
 */
class Scheda {

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $indirizzo;
    
      /**
     * @var integer
     */
    private $locali;

    /**
     * @var string
     */
    private $localita;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $cap;

    /**
     * @var string
     */
    private $descrizione;

    /**
     * @var string
     */
    private $difformita;
    
    /**
     * @var boolean
     */
    private $evidenza;
        
    /**
     * @var boolean
     */
    private $asta;
    
        /**
     * @var boolean
     */
    private $pubblicazione;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }
    


    /**
     * Set indirizzo
     *
     * @param string $indirizzo
     * @return Scheda
     */
    public function setIndirizzo($indirizzo) {
        $this->indirizzo = $indirizzo;

        return $this;
    }

    /**
     * Get indirizzo
     *
     * @return string 
     */
    public function getIndirizzo() {
        return $this->indirizzo;
    }

    
    
        /**
     * Get locali
     *
     * @return integer 
     */
    public function getLocali() {
        return $this->locali;
    }
    


    /**
     * Set locali
     *
     * @param integer $locali
     * @return Scheda
     */
    public function setLocali($locali) {
        $this->locali = $locali;

        return $this;
    }
    /**
     * Set localita
     *
     * @param string $localita
     * @return Scheda
     */
    public function setLocalita($localita) {
        $this->localita = $localita;

        return $this;
    }

    /**
     * Get localita
     *
     * @return string 
     */
    public function getLocalita() {
        return $this->localita;
    }

    /**
     * Set comune
     *
     * @param string $status
     * @return Scheda
     */
    public function setStatus($status) {
        $this->status = $status;

        return $this;
    }

    /**
     * Get comune
     *
     * @return string 
     */
    public function getStatus() {
        return $this->status;
    }

    /**
     * Set cap
     *
     * @param string $cap
     * @return Scheda
     */
    public function setCap($cap) {
        $this->cap = $cap;

        return $this;
    }

    /**
     * Get cap
     *
     * @return string 
     */
    public function getCap() {
        return $this->cap;
    }

    /**
     * Set descrizione
     *
     * @param string $descrizione
     * @return Scheda
     */
    public function setDescrizione($descrizione) {
        $this->descrizione = $descrizione;

        return $this;
    }

    /**
     * Get descrizione
     *
     * @return string 
     */
    public function getDescrizione() {
        return $this->descrizione;
    }

    /**
     * Set difformita
     *
     * @param string $difformita
     * @return Scheda
     */
    public function setDifformita($difformita) {
        $this->difformita = $difformita;

        return $this;
    }

    /**
     * Get difformita
     *
     * @return string 
     */
    public function getDifformita() {
        return $this->difformita;
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $contratti;

    /**
     * Constructor
     */
    public function __construct() {
        $this->contratti = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add contratti
     *
     * @param \Casa\Front2Bundle\Entity\Contratto $contratti
     * @return Scheda
     */
    public function addContratti(\Casa\Front2Bundle\Entity\Contratto $contratti) {
        $this->contratti[] = $contratti;

        return $this;
    }

    /**
     * Remove contratti
     *
     * @param \Casa\Front2Bundle\Entity\Contratto $contratti
     */
    public function removeContratti(\Casa\Front2Bundle\Entity\Contratto $contratti) {
        $this->contratti->removeElement($contratti);
    }

    /**
     * Get contratti
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContratti() {
        return $this->contratti;
    }

    /**
     * @var string
     */
    private $lat;

    /**
     * @var string
     */
    private $lon;

    /**
     * Set lat
     *
     * @param string $lat
     * @return Scheda
     */
    public function setLat($lat) {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lat
     *
     * @return string 
     */
    public function getLat() {
        return $this->lat;
    }

    /**
     * Set lon
     *
     * @param string $lon
     * @return Scheda
     */
    public function setLon($lon) {
        $this->lon = $lon;

        return $this;
    }

    /**
     * Get lon
     *
     * @return string 
     */
    public function getLon() {
        return $this->lon;
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $agenzie;

    /**
     * Add agenzie
     *
     * @param \Casa\UserBundle\Entity\Agenzia $agenzie
     * @return Scheda
     */
    public function addAgenzie(\Casa\UserBundle\Entity\Agenzia $agenzie) {
        $this->agenzie[] = $agenzie;

        return $this;
    }

    /**
     * Remove agenzie
     *
     * @param \Casa\UserBundle\Entity\Agenzia $agenzie
     */
    public function removeAgenzie(\Casa\UserBundle\Entity\Agenzia $agenzie) {
        $this->agenzie->removeElement($agenzie);
    }

    /**
     * Get agenzie
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAgenzie() {
        return $this->agenzie;
    }

    /**
     * @var \Casa\Front2Bundle\Entity\Tipologia
     */
    private $tipologia;

    /**
     * Set tipologia
     *
     * @param \Casa\Front2Bundle\Entity\Tipologia $tipologia
     * @return Scheda
     */
    public function setTipologia(\Casa\Front2Bundle\Entity\Tipologia $tipologia = null) {
        $this->tipologia = $tipologia;

        return $this;
    }

    /**
     * Get tipologia
     *
     * @return \Casa\Front2Bundle\Entity\Tipologia 
     */
    public function getTipologia() {
        return $this->tipologia;
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $caratteristiche;

    /**
     * Add caratteristiche
     *
     * @param \Casa\Front2Bundle\Entity\SchedaCaratteristica $caratteristiche
     * @return Scheda
     */
    public function addCaratteristiche(\Casa\Front2Bundle\Entity\SchedaCaratteristica $caratteristiche) {
        $this->caratteristiche[] = $caratteristiche;

        return $this;
    }

    /**
     * Remove caratteristiche
     *
     * @param \Casa\Front2Bundle\Entity\SchedaCaratteristica $caratteristiche
     */
    public function removeCaratteristiche(\Casa\Front2Bundle\Entity\SchedaCaratteristica $caratteristiche) {
        $this->caratteristiche->removeElement($caratteristiche);
    }

    /**
     * Get caratteristiche
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCaratteristiche() {
        return $this->caratteristiche;
    }

    public function getCaratteristica($caratteristica) {
        try {
            $criteria = Criteria::create()
                    ->where(Criteria::expr()->eq("gruppo", $caratteristica));
            $out = $this->caratteristiche->matching($criteria);
            /* @var $out \Doctrine\Common\Collections\ArrayCollection */
            if (count($out) == 0) {
                $scheda = new SchedaCaratteristica();
                $scheda->setValue('');
                return $scheda;
            }
            return $out->first();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $prezzi;

    /**
     * Add prezzi
     *
     * @param \Casa\Front2Bundle\Entity\Prezzo $prezzi
     * @return Scheda
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

    public function getTitoloPubblico() {
        return "{$this->getTipologia()->getTipologia()} a {$this->getLocalita()}";
    }

    public function getTags() {
        $tags = array();
        foreach ($this->caratteristiche as $caratteristica) {
            /* @var $caratteristica SchedaCaratteristica */
            if ($caratteristica->getGruppo()->getTag() && $caratteristica->getValue()) {
                $tags[] = trim("{$caratteristica->getGruppo()->getCaratteristica()}: {$caratteristica->getValue()} {$caratteristica->getGruppo()->getUumm()}");
            }
        }
        return implode(', ', $tags);
    }

    public function __toString() {
        $str = $this->getTitoloPubblico();
        $str .= " in {$this->getIndirizzo()} - {$this->getCap()} {$this->getLocalita()}";
        return $str;
    }


    /**
     * Set evidenza
     *
     * @param boolean $evidenza
     * @return Scheda
     */
    public function setEvidenza($evidenza)
    {
        $this->evidenza = $evidenza;

        return $this;
    }

    /**
     * Get evidenza
     *
     * @return boolean 
     */
    public function getEvidenza()
    {
        return $this->evidenza;
    }
    
    
      /**
     * Set asta
     *
     * @param boolean $asta
     * @return Scheda
     */
    public function setAsta($asta)
    {
        $this->asta = $asta;

        return $this;
    }

    /**
     * Get asta
     * @return boolean 
     */
    public function getAsta()
    {
        return $this->asta;
    }
    
    
    
        /**
     * Set pubblicazione
     *
     * @param boolean $pubblicazione
     * @return Scheda
     */
    public function setPubblicazione($pubblicazione)
    {
        $this->pubblicazione = $pubblicazione;

        return $this;
    }

    /**
     * Get pubblicazione
     *
     * @return boolean 
     */
    public function getPubblicazione()
    {
        return $this->pubblicazione;
    }
}
