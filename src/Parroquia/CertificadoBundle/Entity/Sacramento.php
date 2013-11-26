<?php

namespace Parroquia\CertificadoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\MappedSuperclass */
class Sacramento
{
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $libro;
    
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $hoja;
    
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $inscripcion;
    
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
     * Set inscripcion
     *
     * @param integer $inscripcion
     * @return Bautizo
     */
    public function setInscripcion($inscripcion)
    {
        $this->inscripcion = $inscripcion;
    
        return $this;
    }

    /**
     * Get inscripcion
     *
     * @return integer 
     */
    public function getInscripcion()
    {
        return $this->inscripcion;
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
}
