<?php

namespace Casa\Front2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Caratteristica
 */
class Caratteristica
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $caratteristica;

    /**
     * @var string
     */
    private $tipo;

    /**
     * @var string
     */
    private $params;

    /**
     * @var string
     */
    private $js;

    /**
     * @var boolean
     */
    private $multiriga;

    /**
     * @var string
     */
    private $idTagPattern;


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
     * Set caratteristica
     *
     * @param string $caratteristica
     * @return Caratteristica
     */
    public function setCaratteristica($caratteristica)
    {
        $this->caratteristica = $caratteristica;

        return $this;
    }

    /**
     * Get caratteristica
     *
     * @return string 
     */
    public function getCaratteristica()
    {
        return $this->caratteristica;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     * @return Caratteristica
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
     * Set params
     *
     * @param string $params
     * @return Caratteristica
     */
    public function setParams($params)
    {
        $this->params = $params;

        return $this;
    }

    /**
     * Get params
     *
     * @return string 
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * Set js
     *
     * @param string $js
     * @return Caratteristica
     */
    public function setJs($js)
    {
        $this->js = $js;

        return $this;
    }

    /**
     * Get js
     *
     * @return string 
     */
    public function getJs()
    {
        return $this->js;
    }

    /**
     * Set multiriga
     *
     * @param boolean $multiriga
     * @return Caratteristica
     */
    public function setMultiriga($multiriga)
    {
        $this->multiriga = $multiriga;

        return $this;
    }

    /**
     * Get multiriga
     *
     * @return boolean 
     */
    public function getMultiriga()
    {
        return $this->multiriga;
    }

    /**
     * Set idTagPattern
     *
     * @param string $idTagPattern
     * @return Caratteristica
     */
    public function setIdTagPattern($idTagPattern)
    {
        $this->idTagPattern = $idTagPattern;

        return $this;
    }

    /**
     * Get idTagPattern
     *
     * @return string 
     */
    public function getIdTagPattern()
    {
        return $this->idTagPattern;
    }
    
    /**
     * @var \Casa\Front2Bundle\Entity\GruppoCaratteristica
     */
    private $gruppo;


    /**
     * Set gruppo
     *
     * @param \Casa\Front2Bundle\Entity\GruppoCaratteristica $gruppo
     * @return Caratteristica
     */
    public function setGruppo(\Casa\Front2Bundle\Entity\GruppoCaratteristica $gruppo = null)
    {
        $this->gruppo = $gruppo;

        return $this;
    }

    /**
     * Get gruppo
     *
     * @return \Casa\Front2Bundle\Entity\GruppoCaratteristica 
     */
    public function getGruppo()
    {
        return $this->gruppo;
    }
    /**
     * @var string
     */
    private $uumm;


    /**
     * Set uumm
     *
     * @param string $uumm
     * @return Caratteristica
     */
    public function setUumm($uumm)
    {
        $this->uumm = $uumm;

        return $this;
    }

    /**
     * Get uumm
     *
     * @return string 
     */
    public function getUumm()
    {
        return $this->uumm;
    }
    /**
     * @var boolean
     */
    private $tag;


    /**
     * Set tag
     *
     * @param boolean $tag
     * @return Caratteristica
     */
    public function setTag($tag)
    {
        $this->tag = $tag;

        return $this;
    }

    /**
     * Get tag
     *
     * @return boolean 
     */
    public function getTag()
    {
        return $this->tag;
    }
}
