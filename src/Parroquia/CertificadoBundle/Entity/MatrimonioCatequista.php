<?php

namespace Parroquia\CertificadoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="matrimonio_catequista_idx", columns={"matrimonio_id", "catequista_id"})})
 * @UniqueEntity(fields={"catequista","matrimonio"})
 */
class MatrimonioCatequista
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Matrimonio", inversedBy="matrimonios_catequistas")
     * @ORM\JoinColumn(name="matrimonio_id", referencedColumnName="id", nullable=false)
     * */
    protected $matrimonio;
    
    /**
     * @ORM\ManyToOne(targetEntity="Parroquia\ComunidadBundle\Entity\Persona", inversedBy="matrimonios_catequistas")
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
     * Set matrimonio
     *
     * @param \Parroquia\CertificadoBundle\Entity\Matrimonio $matrimonio
     * @return MatrimonioCatequista
     */
    public function setMatrimonio(\Parroquia\CertificadoBundle\Entity\Matrimonio $matrimonio)
    {
        $this->matrimonio = $matrimonio;
    
        return $this;
    }

    /**
     * Get matrimonio
     *
     * @return \Parroquia\CertificadoBundle\Entity\Matrimonio 
     */
    public function getMatrimonio()
    {
        return $this->matrimonio;
    }

    /**
     * Set catequista
     *
     * @param \Parroquia\ComunidadBundle\Entity\Persona $catequista
     * @return MatrimonioCatequista
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