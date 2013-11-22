<?php

namespace Parroquia\CertificadoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="matrimonio_celebrante_idx", columns={"matrimonio_id", "celebrante_id"})})
 * @UniqueEntity(fields={"celebrante","matrimonio"})
 */
class MatrimonioCelebrante
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Matrimonio", inversedBy="matrimonios_celebrantes")
     * @ORM\JoinColumn(name="matrimonio_id", referencedColumnName="id", nullable=false)
     * */
    protected $matrimonio;
    
    /**
     * @ORM\ManyToOne(targetEntity="Parroquia\ComunidadBundle\Entity\Persona", inversedBy="matrimonios_celebrantes")
     * @ORM\JoinColumn(name="celebrante_id", referencedColumnName="id", nullable=false) 
     * */
    protected $celebrante;
    

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
     * @return MatrimonioCelebrante
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
     * Set celebrante
     *
     * @param \Parroquia\ComunidadBundle\Entity\Persona $celebrante
     * @return MatrimonioCelebrante
     */
    public function setCelebrante(\Parroquia\ComunidadBundle\Entity\Persona $celebrante)
    {
        $this->celebrante = $celebrante;
    
        return $this;
    }

    /**
     * Get celebrante
     *
     * @return \Parroquia\ComunidadBundle\Entity\Persona 
     */
    public function getCelebrante()
    {
        return $this->celebrante;
    }
}