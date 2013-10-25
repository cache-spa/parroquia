<?php

namespace Parroquia\CertificadoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table
 */
class Bautizo
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
    protected $padrinos;    
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $ministro;
    
    /**
     * @ORM\OneToOne(targetEntity="Parroquia\ComunidadBundle\Entity\Persona", inversedBy="bautizo")
     **/   
    protected $persona;

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
     * @return Bautizo
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
     * @return Bautizo
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
     * @return Bautizo
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
     * @return Bautizo
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
     * @return Bautizo
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
     * @return Bautizo
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
     * Set padrinos
     *
     * @param string $padrinos
     * @return Bautizo
     */
    public function setPadrinos($padrinos)
    {
        $this->padrinos = $padrinos;
    
        return $this;
    }

    /**
     * Get padrinos
     *
     * @return string 
     */
    public function getPadrinos()
    {
        return $this->padrinos;
    }

    /**
     * Set ministro
     *
     * @param string $ministro
     * @return Bautizo
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
}