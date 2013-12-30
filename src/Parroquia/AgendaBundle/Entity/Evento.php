<?php

namespace Parroquia\AgendaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="evento")
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
    protected $descripcion;
    
    /**
     * @ORM\Column(type="datetime")
     */
    protected $creacion;
    
    /**
     * @ORM\Column(type="boolean")
     */
    protected $liturgico;
    
    /**
     * @ORM\Column(type="boolean")
     */
    protected $todo_el_dia;    
    
    /**
     * @ORM\OneToMany(targetEntity="Archivo", mappedBy="evento", cascade={"all"})
     **/
    protected $archivos;
    
    /**
     * @ORM\OneToMany(targetEntity="Imagen", mappedBy="evento", cascade={"all"})
     **/
    protected $imagenes;    

    public function __construct()
    {
        $this->creacion = new \DateTime();
        $this->archivos = new ArrayCollection();
        $this->imagenes = new ArrayCollection();        
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
        if($this->inicio)
        {
            return clone $this->inicio;
        }
        else
        {
            return $this->inicio;
        }
        
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
        if($this->termino)
        {
            return clone $this->termino;
        }
        else
        {
            return $this->termino;
        }
        
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return Evento
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set creacion
     *
     * @param \DateTime $creacion
     * @return Evento
     */
    public function setCreacion($creacion)
    {
        $this->creacion = $creacion;
    
        return $this;
    }

    /**
     * Get creacion
     *
     * @return \DateTime 
     */
    public function getCreacion()
    {
        return $this->creacion;
    }

    /**
     * Set todo_el_dia
     *
     * @param boolean $todo_el_dia
     * @return Evento
     */
    public function setTodoElDia($todo_el_dia)
    {
        $this->todo_el_dia = $todo_el_dia;
    
        return $this;
    }

    /**
     * Get todo_el_dia
     *
     * @return boolean 
     */
    public function getTodoElDia()
    {
        return $this->todo_el_dia;
    }
    
    /**
     * Set liturgico
     *
     * @param boolean $liturgico
     * @return Evento
     */
    public function setLiturgico($liturgico)
    {
        $this->liturgico = $liturgico;
    
        return $this;
    }

    /**
     * Get liturgico
     *
     * @return boolean 
     */
    public function getLiturgico()
    {
        return $this->liturgico;
    }    

    /**
     * Add archivos
     *
     * @param \Parroquia\AgendaBundle\Entity\Archivo $archivos
     * @return Evento
     */
    public function addArchivo($archivos)
    {
        if($archivos instanceof \Parroquia\AgendaBundle\Entity\Archivo)
        {
            $archivos->setEvento($this);
            $this->archivos[] = $archivos;    
        }
        
        return $this;
    }

    /**
     * Remove archivos
     *
     * @param \Parroquia\AgendaBundle\Entity\Archivo $archivos
     */
    public function removeArchivo(\Parroquia\AgendaBundle\Entity\Archivo $archivos)
    {
        $this->archivos->removeElement($archivos);
    }

    /**
     * Get archivos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArchivos()
    {
        return $this->archivos;
    }

    /**
     * Add imagenes
     *
     * @param \Parroquia\AgendaBundle\Entity\Imagen $imagenes
     * @return Evento
     */
    public function addImagene($imagenes)
    {
        if($imagenes instanceof \Parroquia\AgendaBundle\Entity\Imagen)
        {
            $imagenes->setEvento($this);
            $this->imagenes[] = $imagenes;    
        }
        
        return $this;
    }

    /**
     * Remove imagenes
     *
     * @param \Parroquia\AgendaBundle\Entity\Imagen $imagenes
     */
    public function removeImagene(\Parroquia\AgendaBundle\Entity\Imagen $imagenes)
    {
        $this->imagenes->removeElement($imagenes);
    }

    /**
     * Get imagenes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getImagenes()
    {
        return $this->imagenes;
    }
}