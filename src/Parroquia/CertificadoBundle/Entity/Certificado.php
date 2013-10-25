<?php

namespace Parroquia\CertificadoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table
 */
class Certificado
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $fecha_emision;
    
    /**
     * @ORM\ManyToOne(targetEntity="Parroquia\ComunidadBundle\Entity\Persona", inversedBy="certificados_emitidos")
     * @ORM\JoinColumn(name="emisor_id", referencedColumnName="id")
     * */     
    protected $emisor;

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
     * Set fecha_emision
     *
     * @param \DateTime $fechaEmision
     * @return Certificado
     */
    public function setFechaEmision($fechaEmision)
    {
        $this->fecha_emision = $fechaEmision;
    
        return $this;
    }

    /**
     * Get fecha_emision
     *
     * @return \DateTime 
     */
    public function getFechaEmision()
    {
        return $this->fecha_emision;
    }

    /**
     * Set emisor
     *
     * @param \Parroquia\ComunidadBundle\Entity\Persona $emisor
     * @return Certificado
     */
    public function setEmisor(\Parroquia\ComunidadBundle\Entity\Persona $emisor = null)
    {
        $this->emisor = $emisor;
    
        return $this;
    }

    /**
     * Get emisor
     *
     * @return \Parroquia\ComunidadBundle\Entity\Persona 
     */
    public function getEmisor()
    {
        return $this->emisor;
    }
}