<?php

namespace Parroquia\CertificadoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table
 * @UniqueEntity("persona")
 */
class Bautizo extends Sacramento
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;     
  
    /**
     * @ORM\OneToOne(targetEntity="Parroquia\ComunidadBundle\Entity\Persona", inversedBy="bautizo")
     * @ORM\JoinColumn(name="persona_id", referencedColumnName="id", nullable=false, unique=true) 
     **/   
    protected $persona;
    
    /**
     * @ORM\OneToMany(targetEntity="BautizoPadrino", mappedBy="bautizo", cascade={"all"})
     **/
    protected $bautizos_padrinos;
        
    /**
     * @ORM\OneToMany(targetEntity="BautizoCelebrante", mappedBy="bautizo", cascade={"all"})
     **/
    protected $bautizos_celebrantes;
    
    /**
     * @ORM\OneToMany(targetEntity="BautizoCatequista", mappedBy="bautizo", cascade={"all"})
     **/
    protected $bautizos_catequistas;
    
    public function __construct() {
        $this->bautizos_padrinos = new ArrayCollection();
        $this->bautizos_celebrantes = new ArrayCollection();        
        $this->bautizos_catequistas = new ArrayCollection();      
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
     * @return Bautizo
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
     * Add bautizos_padrinos
     *
     * @param \Parroquia\CertificadoBundle\Entity\BautizoPadrino $bautizosPadrinos
     * @return Bautizo
     */
    public function addBautizosPadrino(\Parroquia\CertificadoBundle\Entity\BautizoPadrino $bautizosPadrinos)
    {
        $bautizosPadrinos->setBautizo($this);
        $this->bautizos_padrinos[] = $bautizosPadrinos;
    
        return $this;
    }

    /**
     * Remove bautizos_padrinos
     *
     * @param \Parroquia\CertificadoBundle\Entity\BautizoPadrino $bautizosPadrinos
     */
    public function removeBautizosPadrino(\Parroquia\CertificadoBundle\Entity\BautizoPadrino $bautizosPadrinos)
    {
        $this->bautizos_padrinos->removeElement($bautizosPadrinos);
    }

    /**
     * Get bautizos_padrinos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBautizosPadrinos()
    {
        return $this->bautizos_padrinos;
    }

    /**
     * Add bautizos_celebrantes
     *
     * @param \Parroquia\CertificadoBundle\Entity\BautizoCelebrante $bautizosCelebrantes
     * @return Bautizo
     */
    public function addBautizosCelebrante(\Parroquia\CertificadoBundle\Entity\BautizoCelebrante $bautizosCelebrantes)
    {
        $bautizosCelebrantes->setBautizo($this);
        $this->bautizos_celebrantes[] = $bautizosCelebrantes;
    
        return $this;
    }

    /**
     * Remove bautizos_celebrantes
     *
     * @param \Parroquia\CertificadoBundle\Entity\BautizoCelebrante $bautizosCelebrantes
     */
    public function removeBautizosCelebrante(\Parroquia\CertificadoBundle\Entity\BautizoCelebrante $bautizosCelebrantes)
    {
        $this->bautizos_celebrantes->removeElement($bautizosCelebrantes);
    }

    /**
     * Get bautizos_celebrantes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBautizosCelebrantes()
    {
        return $this->bautizos_celebrantes;
    }

    /**
     * Add bautizos_catequistas
     *
     * @param \Parroquia\CertificadoBundle\Entity\BautizoCatequista $bautizosCatequistas
     * @return Bautizo
     */
    public function addBautizosCatequista(\Parroquia\CertificadoBundle\Entity\BautizoCatequista $bautizosCatequistas)
    {
        $bautizosCatequistas->setBautizo($this);
        $this->bautizos_catequistas[] = $bautizosCatequistas;
    
        return $this;
    }

    /**
     * Remove bautizos_catequistas
     *
     * @param \Parroquia\CertificadoBundle\Entity\BautizoCatequista $bautizosCatequistas
     */
    public function removeBautizosCatequista(\Parroquia\CertificadoBundle\Entity\BautizoCatequista $bautizosCatequistas)
    {
        $this->bautizos_catequistas->removeElement($bautizosCatequistas);
    }

    /**
     * Get bautizos_catequistas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBautizosCatequistas()
    {
        return $this->bautizos_catequistas;
    } 
    
    public function __toString()
    {
        return '';
    }
    
}