<?php

namespace Parroquia\CertificadoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="confirmacion_catequista_idx", columns={"confirmacion_id", "catequista_id"})})
 * @UniqueEntity(fields={"catequista","confirmacion"})
 */
class ConfirmacionCatequista
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Confirmacion", inversedBy="confirmaciones_catequistas")
     * @ORM\JoinColumn(name="confirmacion_id", referencedColumnName="id", nullable=false)
     * */
    protected $confirmacion;
    
    /**
     * @ORM\ManyToOne(targetEntity="Parroquia\ComunidadBundle\Entity\Persona", inversedBy="confirmaciones_catequistas")
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
     * Set confirmacion
     *
     * @param \Parroquia\CertificadoBundle\Entity\Confirmacion $confirmacion
     * @return ConfirmacionCatequista
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
     * Set catequista
     *
     * @param \Parroquia\ComunidadBundle\Entity\Persona $catequista
     * @return ConfirmacionCatequista
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