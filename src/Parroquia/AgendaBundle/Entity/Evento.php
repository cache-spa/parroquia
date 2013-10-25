<?php

namespace Parroquia\AgendaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table
 */
class Evento
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $nombre;
    
     /**
     * @ORM\Column(type="datetime")
     */
    protected $inicio;
    
    /**
     * @ORM\Column(type="datetime")
     */
    protected $termino;    

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $lugar;
    
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $detalle;    

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
     * Set nombre
     *
     * @param string $nombre
     * @return Evento
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set inicio
     *
     * @param \DateTime $inicio
     * @return Evento
     */
    public function setInicio($inicio)
    {
        $this->inicio = $inicio;
    
        return $this;
    }

    /**
     * Get inicio
     *
     * @return \DateTime 
     */
    public function getInicio()
    {
        return $this->inicio;
    }

    /**
     * Set termino
     *
     * @param \DateTime $termino
     * @return Evento
     */
    public function setTermino($termino)
    {
        $this->termino = $termino;
    
        return $this;
    }

    /**
     * Get termino
     *
     * @return \DateTime 
     */
    public function getTermino()
    {
        return $this->termino;
    }

    /**
     * Set lugar
     *
     * @param string $lugar
     * @return Evento
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
     * Set detalle
     *
     * @param string $detalle
     * @return Evento
     */
    public function setDetalle($detalle)
    {
        $this->detalle = $detalle;
    
        return $this;
    }

    /**
     * Get detalle
     *
     * @return string 
     */
    public function getDetalle()
    {
        return $this->detalle;
    }
}