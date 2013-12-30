<?php

namespace Parroquia\CertificadoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="matrimonio")
 * @UniqueEntity(fields={"conyuge1","conyuge2"})
 */
class Matrimonio extends Sacramento
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $inscripcion_civil;
    
    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $fecha_civil;    
    
    /**
     * @ORM\ManyToOne(targetEntity="Parroquia\ComunidadBundle\Entity\Persona", inversedBy="matrimonios_conyuge1")
     * @ORM\JoinColumn(name="conyuge1_id", referencedColumnName="id")
     * */
    protected $conyuge1;
    
    /**
     * @ORM\ManyToOne(targetEntity="Parroquia\ComunidadBundle\Entity\Persona", inversedBy="matrimonios_conyuge2")
     * @ORM\JoinColumn(name="conyuge2_id", referencedColumnName="id")
     * */
    protected $conyuge2;
    
    /**
     * @ORM\OneToMany(targetEntity="MatrimonioPadrino", mappedBy="matrimonio", cascade={"all"})
     **/
    protected $matrimonios_padrinos;
        
    /**
     * @ORM\OneToMany(targetEntity="MatrimonioCelebrante", mappedBy="matrimonio", cascade={"all"})
     **/
    protected $matrimonios_celebrantes;
    
    /**
     * @ORM\OneToMany(targetEntity="MatrimonioCatequista", mappedBy="matrimonio", cascade={"all"})
     **/
    protected $matrimonios_catequistas;
    
    /**
     * @ORM\OneToMany(targetEntity="MatrimonioTestigo", mappedBy="matrimonio", cascade={"all"})
     **/
    protected $matrimonios_testigos;
    
    public function __construct() {
        $this->matrimonios_padrinos = new ArrayCollection();
        $this->matrimonios_celebrantes = new ArrayCollection();        
        $this->matrimonios_catequistas = new ArrayCollection();
        $this->matrimonios_testigos = new ArrayCollection();        
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
     * Set inscripcion_civil
     *
     * @param integer $inscripcionCivil
     * @return Matrimonio
     */
    public function setInscripcionCivil($inscripcionCivil)
    {
        $this->inscripcion_civil = $inscripcionCivil;
    
        return $this;
    }

    /**
     * Get inscripcion_civil
     *
     * @return integer 
     */
    public function getInscripcionCivil()
    {
        return $this->inscripcion_civil;
    }

    /**
     * Set fecha_civil
     *
     * @param \DateTime $fechaCivil
     * @return Matrimonio
     */
    public function setFechaCivil($fechaCivil)
    {
        $this->fecha_civil = $fechaCivil;
    
        return $this;
    }

    /**
     * Get fecha_civil
     *
     * @return \DateTime 
     */
    public function getFechaCivil()
    {
        return $this->fecha_civil;
    }

    /**
     * Set conyuge1
     *
     * @param \Parroquia\ComunidadBundle\Entity\Persona $conyuge1
     * @return Matrimonio
     */
    public function setConyuge1(\Parroquia\ComunidadBundle\Entity\Persona $conyuge1 = null)
    {
        $this->conyuge1 = $conyuge1;
    
        return $this;
    }

    /**
     * Get conyuge1
     *
     * @return \Parroquia\ComunidadBundle\Entity\Persona 
     */
    public function getConyuge1()
    {
        return $this->conyuge1;
    }

    /**
     * Set conyuge2
     *
     * @param \Parroquia\ComunidadBundle\Entity\Persona $conyuge2
     * @return Matrimonio
     */
    public function setConyuge2(\Parroquia\ComunidadBundle\Entity\Persona $conyuge2 = null)
    {
        $this->conyuge2 = $conyuge2;
    
        return $this;
    }

    /**
     * Get conyuge2
     *
     * @return \Parroquia\ComunidadBundle\Entity\Persona 
     */
    public function getConyuge2()
    {
        return $this->conyuge2;
    }    
    
    /**
     * Add matrimonios_padrinos
     *
     * @param \Parroquia\CertificadoBundle\Entity\MatrimonioPadrino $matrimoniosPadrinos
     * @return Matrimonio
     */
    public function addMatrimoniosPadrino(\Parroquia\CertificadoBundle\Entity\MatrimonioPadrino $matrimoniosPadrinos)
    {
        $matrimoniosPadrinos->setMatrimonio($this);
        $this->matrimonios_padrinos[] = $matrimoniosPadrinos;
    
        return $this;
    }

    /**
     * Remove matrimonios_padrinos
     *
     * @param \Parroquia\CertificadoBundle\Entity\MatrimonioPadrino $matrimoniosPadrinos
     */
    public function removeMatrimoniosPadrino(\Parroquia\CertificadoBundle\Entity\MatrimonioPadrino $matrimoniosPadrinos)
    {
        $this->matrimonios_padrinos->removeElement($matrimoniosPadrinos);
    }

    /**
     * Get matrimonios_padrinos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMatrimoniosPadrinos()
    {
        return $this->matrimonios_padrinos;
    }

    /**
     * Add matrimonios_celebrantes
     *
     * @param \Parroquia\CertificadoBundle\Entity\MatrimonioCelebrante $matrimoniosCelebrantes
     * @return Matrimonio
     */
    public function addMatrimoniosCelebrante(\Parroquia\CertificadoBundle\Entity\MatrimonioCelebrante $matrimoniosCelebrantes)
    {
        $matrimoniosCelebrantes->setMatrimonio($this);
        $this->matrimonios_celebrantes[] = $matrimoniosCelebrantes;
    
        return $this;
    }

    /**
     * Remove matrimonios_celebrantes
     *
     * @param \Parroquia\CertificadoBundle\Entity\MatrimonioCelebrante $matrimoniosCelebrantes
     */
    public function removeMatrimoniosCelebrante(\Parroquia\CertificadoBundle\Entity\MatrimonioCelebrante $matrimoniosCelebrantes)
    {
        $this->matrimonios_celebrantes->removeElement($matrimoniosCelebrantes);
    }

    /**
     * Get matrimonios_celebrantes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMatrimoniosCelebrantes()
    {
        return $this->matrimonios_celebrantes;
    }

    /**
     * Add matrimonios_catequistas
     *
     * @param \Parroquia\CertificadoBundle\Entity\MatrimonioCatequista $matrimoniosCatequistas
     * @return Matrimonio
     */
    public function addMatrimoniosCatequista(\Parroquia\CertificadoBundle\Entity\MatrimonioCatequista $matrimoniosCatequistas)
    {
        $matrimoniosCatequistas->setMatrimonio($this);
        $this->matrimonios_catequistas[] = $matrimoniosCatequistas;
    
        return $this;
    }

    /**
     * Remove matrimonios_catequistas
     *
     * @param \Parroquia\CertificadoBundle\Entity\MatrimonioCatequista $matrimoniosCatequistas
     */
    public function removeMatrimoniosCatequista(\Parroquia\CertificadoBundle\Entity\MatrimonioCatequista $matrimoniosCatequistas)
    {
        $this->matrimonios_catequistas->removeElement($matrimoniosCatequistas);
    }

    /**
     * Get matrimonios_catequistas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMatrimoniosCatequistas()
    {
        return $this->matrimonios_catequistas;
    }

    /**
     * Add matrimonios_testigos
     *
     * @param \Parroquia\CertificadoBundle\Entity\MatrimonioTestigo $matrimoniosTestigos
     * @return Matrimonio
     */
    public function addMatrimoniosTestigo(\Parroquia\CertificadoBundle\Entity\MatrimonioTestigo $matrimoniosTestigos)
    {
        $matrimoniosTestigos->setMatrimonio($this);
        $this->matrimonios_testigos[] = $matrimoniosTestigos;
    
        return $this;
    }

    /**
     * Remove matrimonios_testigos
     *
     * @param \Parroquia\CertificadoBundle\Entity\MatrimonioTestigo $matrimoniosTestigos
     */
    public function removeMatrimoniosTestigo(\Parroquia\CertificadoBundle\Entity\MatrimonioTestigo $matrimoniosTestigos)
    {
        $this->matrimonios_testigos->removeElement($matrimoniosTestigos);
    }

    /**
     * Get matrimonios_testigos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMatrimoniosTestigos()
    {
        return $this->matrimonios_testigos;
    }
    
}