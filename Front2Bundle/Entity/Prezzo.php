<?php

namespace Casa\Front2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Prezzo
 */
class Prezzo {

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $prezzo;

    /**
     * @var boolean
     */
    private $trattabili;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set prezzo
     *
     * @param string $prezzo
     * @return Prezzo
     */
    public function setPrezzo($prezzo) {
        $this->prezzo = $prezzo;

        return $this;
    }

    /**
     * Get prezzo
     *
     * @return string 
     */
    public function getPrezzo() {
        return $this->prezzo;
    }

    /**
     * Set trattabili
     *
     * @param boolean $trattabili
     * @return Prezzo
     */
    public function setTrattabili($trattabili) {
        $this->trattabili = $trattabili;

        return $this;
    }

    /**
     * Get trattabili
     *
     * @return boolean 
     */
    public function getTrattabili() {
        return $this->trattabili;
    }

    /**
     * @var integer
     */
    private $scheda;

    /**
     * @var \Casa\Front2Bundle\Entity\Contratto
     */
    private $contratto;

    /**
     * Set scheda
     *
     * @param integer $scheda
     * @return Prezzo
     */
    public function setScheda(\Casa\Front2Bundle\Entity\Scheda $scheda) {
        $this->scheda = $scheda;

        return $this;
    }

    /**
     * Get scheda
     *
     * @return integer 
     */
    public function getScheda() {
        return $this->scheda;
    }

    /**
     * Set prezzi
     *
     * @param \Casa\Front2Bundle\Entity\Contratto $contratto
     * @return Prezzo
     */
    public function setContratto(\Casa\Front2Bundle\Entity\Contratto $contratto = null) {
        $this->contratto = $contratto;

        return $this;
    }

    /**
     * Get prezzi
     *
     * @return \Casa\Front2Bundle\Entity\Contratto 
     */
    public function getContratto() {
        return $this->contratto;
    }

    /**
     * @var \DateTime
     */
    private $dataPrezzo;


    /**
     * Set dataPrezzo
     *
     * @param \DateTime $dataPrezzo
     * @return Prezzo
     */
    public function setDataPrezzo($dataPrezzo)
    {
        $this->dataPrezzo = $dataPrezzo;

        return $this;
    }

    /**
     * Get dataPrezzo
     *
     * @return \DateTime 
     */
    public function getDataPrezzo()
    {
        return $this->dataPrezzo;
    }
    /**
     * @var boolean
     */
    private $vendita;

    /**
     * @var boolean
     */
    private $affitto;

    /**
     * @var string
     */
    private $prezzoVendita;

    /**
     * @var string
     */
    private $prezzoAffitto;


    /**
     * Set vendita
     *
     * @param boolean $vendita
     * @return Prezzo
     */
    public function setVendita($vendita)
    {
        $this->vendita = $vendita;

        return $this;
    }

    /**
     * Get vendita
     *
     * @return boolean 
     */
    public function getVendita()
    {
        return $this->vendita;
    }

    /**
     * Set affitto
     *
     * @param boolean $affitto
     * @return Prezzo
     */
    public function setAffitto($affitto)
    {
        $this->affitto = $affitto;

        return $this;
    }

    /**
     * Get affitto
     *
     * @return boolean 
     */
    public function getAffitto()
    {
        return $this->affitto;
    }

    /**
     * Set prezzoVendita
     *
     * @param string $prezzoVendita
     * @return Prezzo
     */
    public function setPrezzoVendita($prezzoVendita)
    {
        $this->prezzoVendita = $prezzoVendita;

        return $this;
    }

    /**
     * Get prezzoVendita
     *
     * @return string 
     */
    public function getPrezzoVendita()
    {
        return $this->prezzoVendita;
    }

    /**
     * Set prezzoAffitto
     *
     * @param string $prezzoAffitto
     * @return Prezzo
     */
    public function setPrezzoAffitto($prezzoAffitto)
    {
        $this->prezzoAffitto = $prezzoAffitto;

        return $this;
    }

    /**
     * Get prezzoAffitto
     *
     * @return string 
     */
    public function getPrezzoAffitto()
    {
        return $this->prezzoAffitto;
    }
    
    function __construct() {
        $this->dataPrezzo = new \DateTime();
    }

}
