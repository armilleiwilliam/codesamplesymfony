<?php

namespace Casa\Front2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Documenti
 */
class Documento
{
    /**
     * @var string
     */
    private $file;

    /**
     * @var string
     */
    private $note;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \Casa\Front2Bundle\Entity\Contratto
     */
    private $contratto;

    /**
     * @var \Casa\Front2Bundle\Entity\DocumentoTipo
     */
    private $tipo;
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
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
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
     * @param \Casa\Front2Bundle\Entity\DocumentoTipo $tipo
     * @return Documento
     */
    public function setTipo($tipo = null)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return \Casa\Front2Bundle\Entity\DocumentoTipo 
     */
    public function getTipo()
    {
        return $this->tipo;
    }
}
