<?php

namespace Parroquia\CertificadoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="bautizopadrino",uniqueConstraints={@ORM\UniqueConstraint(name="bautizo_padrino_idx", columns={"bautizo_id", "padrino_id"})})
 * @UniqueEntity(fields={"padrino","bautizo"})
 */
class BautizoPadrino
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Bautizo", inversedBy="bautizos_padrinos")
     * @ORM\JoinColumn(name="bautizo_id", referencedColumnName="id", nullable=false)
     * */
    protected $bautizo;
    
    /**
     * @ORM\ManyToOne(targetEntity="Parroquia\ComunidadBundle\Entity\Persona", inversedBy="bautizos_padrinos")
     * @ORM\JoinColumn(name="padrino_id", referencedColumnName="id", nullable=false) 
     * */
    protected $padrino;
    

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
     * Set bautizo
     *
     * @param \Parroquia\CertificadoBundle\Entity\Bautizo $bautizo
     * @return BautizoPadrino
     */
    public function setBautizo(\Parroquia\CertificadoBundle\Entity\Bautizo $bautizo)
    {
        $this->bautizo = $bautizo;
    
        return $this;
    }

    /**
     * Get bautizo
     *
     * @return \Parroquia\CertificadoBundle\Entity\Bautizo 
     */
    public function getBautizo()
    {
        return $this->bautizo;
    }

    /**
     * Set padrino
     *
     * @param \Parroquia\ComunidadBundle\Entity\Persona $padrino
     * @return BautizoPadrino
     */
    public function setPadrino(\Parroquia\ComunidadBundle\Entity\Persona $padrino)
    {
        $this->padrino = $padrino;
    
        return $this;
    }

    /**
     * Get padrino
     *
     * @return \Parroquia\ComunidadBundle\Entity\Persona 
     */
    public function getPadrino()
    {
        return $this->padrino;
    }
    
    public function __toString()
    {
        return $this->getPadrino()->__toString();
    }
}