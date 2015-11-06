<?php

namespace Casa\Front2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Foto
 */
class Foto
{
    /**
     * @var string
     */
    private $file;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Casa\Front2Bundle\Entity\Contratto
     */
    private $contratto;

    /**
     * @var boolean
     */
    private $principale;
    /**
     * @var array
     */
    private $json;

    function getJson($json = false) {
        return $json ? json_encode($this->json) : $this->json;
    }

    function setJson($json) {
        $this->json = $json;
        return $this;
    }

        /**
     * Set file
     *
     * @param string $file
     * @return Documento
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return string 
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set note
     *
     * @param string $note
     * @return Documento
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Set contratto
     *
     * @param \Casa\Front2Bundle\Entity\Contratto $contratto
     * @return Documento
     */
    public function setContratto($contratto = null)
    {
        $this->contratto = $contratto;

        return $this;
    }

    /**
     * Get contratto
     *
     * @return \Casa\Front2Bundle\Entity\Contratto 
     */
    public function getContratto()
    {
        return $this->contratto;
    }

    /**
     * Set tipo
     *
     * @param boolean $tipo
     * @return Documento
     */
    public function setPrincipale($tipo)
    {
        $this->principale = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return boolean
     */
    public function getPrincipale()
    {
        return $this->principale;
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
}
