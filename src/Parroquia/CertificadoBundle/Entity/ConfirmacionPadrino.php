<?php

namespace Parroquia\CertificadoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="confirmacion_padrino_idx", columns={"confirmacion_id", "padrino_id"})})
 */
class ConfirmacionPadrino
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Confirmacion", inversedBy="confirmaciones_padrinos")
     * @ORM\JoinColumn(name="confirmacion_id", referencedColumnName="id", nullable=false)
     * */
    protected $confirmacion;
    
    /**
     * @ORM\ManyToOne(targetEntity="Parroquia\ComunidadBundle\Entity\Persona", inversedBy="confirmaciones_padrinos")
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
     * Set confirmacion
     *
     * @param \Parroquia\CertificadoBundle\Entity\Confirmacion $confirmacion
     * @return ConfirmacionPadrino
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
     * Set padrino
     *
     * @param \Parroquia\ComunidadBundle\Entity\Persona $padrino
     * @return ConfirmacionPadrino
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
}