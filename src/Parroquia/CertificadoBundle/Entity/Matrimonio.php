<?php

namespace Parroquia\CertificadoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table
 */
class Matrimonio
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $libro;
    
    /**
     * @ORM\Column(type="integer")
     */
    protected $hoja;
    
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $insc;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $lugar;
    
    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $fecha;
    
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $notas;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $testigos;    
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $ministro;
    
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $insc_civil;
    
    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $fecha_civil;    
    
    /**
     * @ORM\ManyToOne(targetEntity="Parroquia\ComunidadBundle\Entity\Persona", inversedBy="matrimonios_1")
     * @ORM\JoinColumn(name="persona_1_id", referencedColumnName="id")
     * */
    protected $persona_1;
    
    /**
     * @ORM\ManyToOne(targetEntity="Parroquia\ComunidadBundle\Entity\Persona", inversedBy="matrimonios_2")
     * @ORM\JoinColumn(name="persona_2_id", referencedColumnName="id")
     * */
    protected $persona_2;    
    

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
     * Set libro
     *
     * @param integer $libro
     * @return Matrimonio
     */
    public function setLibro($libro)
    {
        $this->libro = $libro;
    
        return $this;
    }

    /**
     * Get libro
     *
     * @return integer 
     */
    public function getLibro()
    {
        return $this->libro;
    }

    /**
     * Set hoja
     *
     * @param integer $hoja
     * @return Matrimonio
     */
    public function setHoja($hoja)
    {
        $this->hoja = $hoja;
    
        return $this;
    }

    /**
     * Get hoja
     *
     * @return integer 
     */
    public function getHoja()
    {
        return $this->hoja;
    }

    /**
     * Set insc
     *
     * @param integer $insc
     * @return Matrimonio
     */
    public function setInsc($insc)
    {
        $this->insc = $insc;
    
        return $this;
    }

    /**
     * Get insc
     *
     * @return integer 
     */
    public function getInsc()
    {
        return $this->insc;
    }

    /**
     * Set lugar
     *
     * @param string $lugar
     * @return Matrimonio
     */
    public function setLugar($lugar)
    {
        $this->lugar = $lugar;
    
        return $this;
    }

    /**
     * Get lugar
     *
     * @return string 
     */
    public function getLugar()
    {
        return $this->lugar;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Matrimonio
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    
        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set notas
     *
     * @param string $notas
     * @return Matrimonio
     */
    public function setNotas($notas)
    {
        $this->notas = $notas;
    
        return $this;
    }

    /**
     * Get notas
     *
     * @return string 
     */
    public function getNotas()
    {
        return $this->notas;
    }

    /**
     * Set testigos
     *
     * @param string $testigos
     * @return Matrimonio
     */
    public function setTestigos($testigos)
    {
        $this->testigos = $testigos;
    
        return $this;
    }

    /**
     * Get testigos
     *
     * @return string 
     */
    public function getTestigos()
    {
        return $this->testigos;
    }

    /**
     * Set ministro
     *
     * @param string $ministro
     * @return Matrimonio
     */
    public function setMinistro($ministro)
    {
        $this->ministro = $ministro;
    
        return $this;
    }

    /**
     * Get ministro
     *
     * @return string 
     */
    public function getMinistro()
    {
        return $this->ministro;
    }

    /**
     * Set insc_civil
     *
     * @param integer $inscCivil
     * @return Matrimonio
     */
    public function setInscCivil($inscCivil)
    {
        $this->insc_civil = $inscCivil;
    
        return $this;
    }

    /**
     * Get insc_civil
     *
     * @return integer 
     */
    public function getInscCivil()
    {
        return $this->insc_civil;
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
     * Set persona_1
     *
     * @param \Parroquia\ComunidadBundle\Entity\Persona $persona1
     * @return Matrimonio
     */
    public function setPersona1(\Parroquia\ComunidadBundle\Entity\Persona $persona1 = null)
    {
        $this->persona_1 = $persona1;
    
        return $this;
    }

    /**
     * Get persona_1
     *
     * @return \Parroquia\ComunidadBundle\Entity\Persona 
     */
    public function getPersona1()
    {
        return $this->persona_1;
    }

    /**
     * Set persona_2
     *
     * @param \Parroquia\ComunidadBundle\Entity\Persona $persona2
     * @return Matrimonio
     */
    public function setPersona2(\Parroquia\ComunidadBundle\Entity\Persona $persona2 = null)
    {
        $this->persona_2 = $persona2;
    
        return $this;
    }

    /**
     * Get persona_2
     *
     * @return \Parroquia\ComunidadBundle\Entity\Persona 
     */
    public function getPersona2()
    {
        return $this->persona_2;
    }
}