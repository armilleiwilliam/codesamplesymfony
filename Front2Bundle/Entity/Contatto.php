<?php

namespace Casa\Front2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contatto
 */
class Contatto {

    /**
     * @var string
     */
    private $nome;

    /**
     * @var string
     */
    private $cognome;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $telefono;

    /**
     * @var string
     */
    private $indirizzo;

    /**
     * @var string
     */
    private $citta;

    /**
     * @var \DateTime
     */
    private $dataNascita;
    
        /**
     * @var \DateTime
     */
    private $dataInserimento;

    /**
     * @var boolean
     */
    private $cliente;

    /**
     * @var boolean
     */
    private $proprietario;
    
     /**
     * @var boolean
     */
    private $giardino;
    
        /**
     * Set giardino
     *
     * @param boolean $giardino
     * @return Contatto
     */
    public function setGiardino($giardino)
    {
        $this->giardino = $giardino;

        return $this;
    }

    /**
     * Get giardino
     *
     * @return boolean 
     */
    public function getGiardino()
    {
        return $this->giardino;
    }
    
    
    
    
    /**
     * @var integer
     */
    private $tipologia;
    /**
     * Get tipologia
     *
     * @return \Casa\Front2Bundle\Entity\tipologia 
     */
    public function getTipologia() {
        return $this->tipologia;
    }
    


    /**
     * Set tipologia
     *
     * @param integer $tipologia
     * @return \Casa\Front2Bundle\Entity\tipologia
     */
    public function setTipologia(\Casa\Front2Bundle\Entity\tipologia $tipologia) {
        $this->tipologia = $tipologia;

        return $this;
    }
    
    
    /**
     * @var boolean
     */
    private $garage;
    
    /**
     * Set garage
     *
     * @param boolean $garage
     * @return Contatto
     */
    public function setGarage($garage)
    {
        $this->garage = $garage;

        return $this;
    }

    /**
     * Get garage
     *
     * @return boolean 
     */
    public function getGarage()
    {
        return $this->garage;
    }
    
    /**
     * @var integer
     */
    private $locali;
    
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
     * @var boolean
     */
    private $balconi;
    
        /**
     * Set balconi
     *
     * @param boolean $balconi
     * @return Contatto
     */
    public function setBalconi($balconi)
    {
        $this->balconi = $balconi;

        return $this;
    }

    /**
     * Get balconi
     *
     * @return boolean 
     */
    public function getBalconi()
    {
        return $this->balconi;
    }
    
    
    /**
     * @var boolean
     */
    private $autonomo;
    
     /**
     * Set autonomo
     *
     * @param boolean $autonomo
     * @return Contatto
     */
    public function setAutonomo($autonomo)
    {
        $this->autonomo = $autonomo;

        return $this;
    }

    /**
     * Get autonomo
     *
     * @return boolean 
     */
    public function getAutonomo()
    {
        return $this->autonomo;
    }

    

    /**
     * @var string
     */
    private $note;

    /**
     * @var string
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $contratti;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contratti = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set nome
     *
     * @param string $nome
     * @return Contatto
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string 
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set cognome
     *
     * @param string $cognome
     * @return Contatto
     */
    public function setCognome($cognome)
    {
        $this->cognome = $cognome;

        return $this;
    }

    /**
     * Get cognome
     *
     * @return string 
     */
    public function getCognome()
    {
        return $this->cognome;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Contatto
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return Contatto
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set indirizzo
     *
     * @param string $indirizzo
     * @return Contatto
     */
    public function setIndirizzo($indirizzo)
    {
        $this->indirizzo = $indirizzo;

        return $this;
    }

    /**
     * Get indirizzo
     *
     * @return string 
     */
    public function getIndirizzo()
    {
        return $this->indirizzo;
    }

    /**
     * Set citta
     *
     * @param string $citta
     * @return Contatto
     */
    public function setCitta($citta)
    {
        $this->citta = $citta;

        return $this;
    }

    /**
     * Get citta
     *
     * @return string 
     */
    public function getCitta()
    {
        return $this->citta;
    }

        /**
     * Set dataInserimento
     *
     * @param \DateTime $dataInserimento
     * @return Contatto
     */
    public function setDataInserimento($dataInserimento)
    {
        $this->dataInserimento = $dataInserimento;

        return $this;
    }

    /**
     * Get dataInserimento
     *
     * @return \DateTime 
     */
    public function getDataInserimento()
    {
        return $this->dataInserimento;
    }
    
    
    /**
     * Set dataNascita
     *
     * @param \DateTime $dataNascita
     * @return Contatto
     */
    public function setDataNascita($dataNascita)
    {
        $this->dataNascita = $dataNascita;

        return $this;
    }

    /**
     * Get dataNascita
     *
     * @return \DateTime 
     */
    public function getDataNascita()
    {
        return $this->dataNascita;
    }

    /**
     * Set cliente
     *
     * @param boolean $cliente
     * @return Contatto
     */
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get cliente
     *
     * @return boolean 
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set proprietario
     *
     * @param boolean $proprietario
     * @return Contatto
     */
    public function setProprietario($proprietario)
    {
        $this->proprietario = $proprietario;

        return $this;
    }

    /**
     * Get proprietario
     *
     * @return boolean 
     */
    public function getProprietario()
    {
        return $this->proprietario;
    }

    /**
     * Set note
     *
     * @param string $note
     * @return Contatto
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string 
     */
    public function getNote()
    {
        return $this->note;
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
     * Add contratti
     *
     * @param \Casa\Front2Bundle\Entity\Contratto $contratti
     * @return Contatto
     */
    public function addContratti(\Casa\Front2Bundle\Entity\Contratto $contratti)
    {
        $this->contratti[] = $contratti;

        return $this;
    }

    /**
     * Remove contratti
     *
     * @param \Casa\Front2Bundle\Entity\Contratto $contratti
     */
    public function removeContratti(\Casa\Front2Bundle\Entity\Contratto $contratti)
    {
        $this->contratti->removeElement($contratti);
    }
    /**
     * Get contratti
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getContratti()
    {
        return $this->contratti;
    }
    
    public function __toString() {
        return "{$this->nome} {$this->cognome} ({$this->indirizzo} - {$this->citta})";
    }
}
