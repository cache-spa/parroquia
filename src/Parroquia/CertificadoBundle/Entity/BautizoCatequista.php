<?php

namespace Parroquia\CertificadoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="bautizocatequista",uniqueConstraints={@ORM\UniqueConstraint(name="bautizo_catequista_idx", columns={"bautizo_id", "catequista_id"})})
 * @UniqueEntity(fields={"catequista","bautizo"})
 */
class BautizoCatequista
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Bautizo", inversedBy="bautizos_catequistas")
     * @ORM\JoinColumn(name="bautizo_id", referencedColumnName="id", nullable=false)
     * */
    protected $bautizo;
    
    /**
     * @ORM\ManyToOne(targetEntity="Parroquia\ComunidadBundle\Entity\Persona", inversedBy="bautizos_catequistas")
     * @ORM\JoinColumn(name="catequista_id", referencedColumnName="id", nullable=false) 
     * */
    protected $catequista;
    

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
     * @return BautizoCatequista
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
     * Set catequista
     *
     * @param \Parroquia\ComunidadBundle\Entity\Persona $catequista
     * @return BautizoCatequista
     */
    public function setCatequista(\Parroquia\ComunidadBundle\Entity\Persona $catequista)
    {
        $this->catequista = $catequista;
    
        return $this;
    }

    /**
     * Get catequista
     *
     * @return \Parroquia\ComunidadBundle\Entity\Persona 
     */
    public function getCatequista()
    {
        return $this->catequista;
    }
}