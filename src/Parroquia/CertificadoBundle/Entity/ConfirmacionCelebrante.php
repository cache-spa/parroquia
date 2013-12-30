<?php

namespace Parroquia\CertificadoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="confirmacioncelebrante",uniqueConstraints={@ORM\UniqueConstraint(name="confirmacion_celebrante_idx", columns={"confirmacion_id", "celebrante_id"})})
 * @UniqueEntity(fields={"celebrante","confirmacion"}) 
 */
class ConfirmacionCelebrante
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Confirmacion", inversedBy="confirmaciones_celebrantes")
     * @ORM\JoinColumn(name="confirmacion_id", referencedColumnName="id", nullable=false)
     * */
    protected $confirmacion;
    
    /**
     * @ORM\ManyToOne(targetEntity="Parroquia\ComunidadBundle\Entity\Persona", inversedBy="confirmaciones_celebrantes")
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
     * Set confirmacion
     *
     * @param \Parroquia\CertificadoBundle\Entity\Confirmacion $confirmacion
     * @return ConfirmacionCelebrante
     */
    public function setConfirmacion(\Parroquia\CertificadoBundle\Entity\Confirmacion $confirmacion)
    {
        $this->confirmacion = $confirmacion;
    
        return $this;
    }

    /**
     * Get confirmacion
     *
     * @return \Parroquia\CertificadoBundle\Entity\Confirmacion 
     */
    public function getConfirmacion()
    {
        return $this->confirmacion;
    }

    /**
     * Set celebrante
     *
     * @param \Parroquia\ComunidadBundle\Entity\Persona $celebrante
     * @return ConfirmacionCelebrante
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