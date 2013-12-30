<?php

namespace Parroquia\CertificadoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="confirmacion")
 * @UniqueEntity("persona")
 */
class Confirmacion extends Sacramento
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\OneToOne(targetEntity="Parroquia\ComunidadBundle\Entity\Persona", inversedBy="confirmacion")
     * @ORM\JoinColumn(name="persona_id", referencedColumnName="id", nullable=false, unique=true) 
     * 
     **/   
    protected $persona;
    
    /**
     * @ORM\OneToMany(targetEntity="ConfirmacionPadrino", mappedBy="confirmacion", cascade={"all"})
     **/
    protected $confirmaciones_padrinos;
        
    /**
     * @ORM\OneToMany(targetEntity="ConfirmacionCelebrante", mappedBy="confirmacion", cascade={"all"})
     **/
    protected $confirmaciones_celebrantes;
    
    /**
     * @ORM\OneToMany(targetEntity="ConfirmacionCatequista", mappedBy="confirmacion", cascade={"all"})
     **/
    protected $confirmaciones_catequistas;    

    public function __construct() {
        $this->confirmaciones_padrinos = new ArrayCollection();
        $this->confirmaciones_celebrantes = new ArrayCollection();        
        $this->confirmaciones_catequistas = new ArrayCollection();         
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
     * Set persona
     *
     * @param \Parroquia\ComunidadBundle\Entity\Persona $persona
     * @return Confirmacion
     */
    public function setPersona(\Parroquia\ComunidadBundle\Entity\Persona $persona = null)
    {
        $this->persona = $persona;
    
        return $this;
    }

    /**
     * Get persona
     *
     * @return \Parroquia\ComunidadBundle\Entity\Persona 
     */
    public function getPersona()
    {
        return $this->persona;
    }

    /**
     * Add confirmaciones_padrinos
     *
     * @param \Parroquia\CertificadoBundle\Entity\ConfirmacionPadrino $confirmacionesPadrinos
     * @return Confirmacion
     */
    public function addConfirmacionesPadrino(\Parroquia\CertificadoBundle\Entity\ConfirmacionPadrino $confirmacionesPadrinos)
    {
        $confirmacionesPadrinos->setConfirmacion($this);
        $this->confirmaciones_padrinos[] = $confirmacionesPadrinos;
    
        return $this;
    }

    /**
     * Remove confirmaciones_padrinos
     *
     * @param \Parroquia\CertificadoBundle\Entity\ConfirmacionPadrino $confirmacionesPadrinos
     */
    public function removeConfirmacionesPadrino(\Parroquia\CertificadoBundle\Entity\ConfirmacionPadrino $confirmacionesPadrinos)
    {
        $this->confirmaciones_padrinos->removeElement($confirmacionesPadrinos);
    }

    /**
     * Get confirmaciones_padrinos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getConfirmacionesPadrinos()
    {
        return $this->confirmaciones_padrinos;
    }

    /**
     * Add confirmaciones_celebrantes
     *
     * @param \Parroquia\CertificadoBundle\Entity\ConfirmacionCelebrante $confirmacionesCelebrantes
     * @return Confirmacion
     */
    public function addConfirmacionesCelebrante(\Parroquia\CertificadoBundle\Entity\ConfirmacionCelebrante $confirmacionesCelebrantes)
    {
        $confirmacionesCelebrantes->setConfirmacion($this);
        $this->confirmaciones_celebrantes[] = $confirmacionesCelebrantes;
    
        return $this;
    }

    /**
     * Remove confirmaciones_celebrantes
     *
     * @param \Parroquia\CertificadoBundle\Entity\ConfirmacionCelebrante $confirmacionesCelebrantes
     */
    public function removeConfirmacionesCelebrante(\Parroquia\CertificadoBundle\Entity\ConfirmacionCelebrante $confirmacionesCelebrantes)
    {
        $this->confirmaciones_celebrantes->removeElement($confirmacionesCelebrantes);
    }

    /**
     * Get confirmaciones_celebrantes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getConfirmacionesCelebrantes()
    {
        return $this->confirmaciones_celebrantes;
    }

    /**
     * Add confirmaciones_catequistas
     *
     * @param \Parroquia\CertificadoBundle\Entity\ConfirmacionCatequista $confirmacionesCatequistas
     * @return Confirmacion
     */
    public function addConfirmacionesCatequista(\Parroquia\CertificadoBundle\Entity\ConfirmacionCatequista $confirmacionesCatequistas)
    {
        $confirmacionesCatequistas->setConfirmacion($this);
        $this->confirmaciones_catequistas[] = $confirmacionesCatequistas;
    
        return $this;
    }

    /**
     * Remove confirmaciones_catequistas
     *
     * @param \Parroquia\CertificadoBundle\Entity\ConfirmacionCatequista $confirmacionesCatequistas
     */
    public function removeConfirmacionesCatequista(\Parroquia\CertificadoBundle\Entity\ConfirmacionCatequista $confirmacionesCatequistas)
    {
        $this->confirmaciones_catequistas->removeElement($confirmacionesCatequistas);
    }

    /**
     * Get confirmaciones_catequistas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getConfirmacionesCatequistas()
    {
        return $this->confirmaciones_catequistas;
    }
    
}