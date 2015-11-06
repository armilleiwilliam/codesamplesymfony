<?php

namespace Casa\Front2Bundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SchedaCaratteristica
 */
class SchedaCaratteristica {

    /**
     * @var string
     */
    private $value;

    /**
     * @var \Casa\Front2Bundle\Entity\Caratteristica
     */
    private $gruppo;

    /**
     * @var \Casa\Front2Bundle\Entity\Scheda
     */
    private $scheda;

    /**
     * Set value
     *
     * @param string $value
     * @return SchedaCaratteristica
     */
    public function setValue($value) {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * Set gruppo
     *
     * @param \Casa\Front2Bundle\Entity\Caratteristica $gruppo
     * @return SchedaCaratteristica
     */
    public function setGruppo(\Casa\Front2Bundle\Entity\Caratteristica $gruppo) {
        $this->gruppo = $gruppo;

        return $this;
    }

    /**
     * Get gruppo
     *
     * @return \Casa\Front2Bundle\Entity\Caratteristica 
     */
    public function getGruppo() {
        return $this->gruppo;
    }

    /**
     * Set scheda
     *
     * @param \Casa\Front2Bundle\Entity\Scheda $scheda
     * @return SchedaCaratteristica
     */
    public function setScheda(\Casa\Front2Bundle\Entity\Scheda $scheda) {
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

    public function __toString() {
        return $this->value;
    }

}
