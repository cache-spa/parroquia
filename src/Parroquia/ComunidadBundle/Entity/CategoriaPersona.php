<?php

namespace Parroquia\ComunidadBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="categoria_persona_idx", columns={"categoria_id", "persona_id"})})
 */
class CategoriaPersona
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Categoria", inversedBy="categorias_personas")
     * @ORM\JoinColumn(name="categoria_id", referencedColumnName="id", nullable=false)
     * */
    protected $categoria;
    
    /**
     * @ORM\ManyToOne(targetEntity="Persona", inversedBy="categorias_personas")
     * @ORM\JoinColumn(name="persona_id", referencedColumnName="id", nullable=false) 
     * */
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
     * Set categoria
     *
     * @param \Parroquia\ComunidadBundle\Entity\Categoria $categoria
     * @return CategoriaPersona
     */
    public function setCategoria(\Parroquia\ComunidadBundle\Entity\Categoria $categoria)
    {
        $this->categoria = $categoria;
    
        return $this;
    }

    /**
     * Get categoria
     *
     * @return \Parroquia\ComunidadBundle\Entity\Categoria 
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set persona
     *
     * @param \Parroquia\ComunidadBundle\Entity\Persona $persona
     * @return CategoriaPersona
     */
    public function setPersona(\Parroquia\ComunidadBundle\Entity\Persona $persona)
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