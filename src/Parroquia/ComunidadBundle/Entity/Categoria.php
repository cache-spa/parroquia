<?php

namespace Parroquia\ComunidadBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table
 */
class Categoria
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    protected $nombre;
    
    /**
     * @ORM\OneToMany(targetEntity="CategoriaPersona", mappedBy="categoria", cascade={"all"})
     **/
    protected $categorias_personas;
    
    public function __construct() {
        $this->categorias_personas = new ArrayCollection();  
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
     * @return Categoria
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
     * Add categorias_personas
     *
     * @param \Parroquia\ComunidadBundle\Entity\CategoriaPersona $categoriasPersonas
     * @return Categoria
     */
    public function addCategoriasPersona(\Parroquia\ComunidadBundle\Entity\CategoriaPersona $categoriasPersonas)
    {
        $this->categorias_personas[] = $categoriasPersonas;
    
        return $this;
    }

    /**
     * Remove categorias_personas
     *
     * @param \Parroquia\ComunidadBundle\Entity\CategoriaPersona $categoriasPersonas
     */
    public function removeCategoriasPersona(\Parroquia\ComunidadBundle\Entity\CategoriaPersona $categoriasPersonas)
    {
        $this->categorias_personas->removeElement($categoriasPersonas);
    }

    /**
     * Get categorias_personas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategoriasPersonas()
    {
        return $this->categorias_personas;
    }
    
    public function __toString()
    {
        return $this->nombre;
    }

    public function getPersonas()
    {
        $personas = new ArrayCollection();
        
        foreach($this->categorias_personas as $categoria_persona)
        {
            $personas[] = $categoria_persona->getPersona();
        }

        return $personas;
    }
    
    public function setPersonas($personas)
    {
        foreach($personas as $persona)
        {
            if(!$this->getPersonas()->contains($persona))
            {
                $categoria_persona = new CategoriaPersona();

                $categoria_persona->setCategoria($this);
                $categoria_persona->setPersona($persona);

                $this->addCategoriasPersona($categoria_persona);
            }
        }

    }    
    
}