<?php

namespace Parroquia\ComunidadBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="grupo_persona_idx", columns={"grupo_id", "persona_id"})})
 */
class GrupoPersona
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Grupo", inversedBy="grupos_personas")
     * @ORM\JoinColumn(name="grupo_id", referencedColumnName="id", nullable=false)
     * */
    protected $grupo;
    
    /**
     * @ORM\ManyToOne(targetEntity="Persona", inversedBy="grupos_personas")
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
     * Set grupo
     *
     * @param \Parroquia\ComunidadBundle\Entity\Grupo $grupo
     * @return GrupoPersona
     */
    public function setGrupo(\Parroquia\ComunidadBundle\Entity\Grupo $grupo)
    {
        $this->grupo = $grupo;
    
        return $this;
    }

    /**
     * Get grupo
     *
     * @return \Parroquia\ComunidadBundle\Entity\Grupo 
     */
    public function getGrupo()
    {
        return $this->grupo;
    }

    /**
     * Set persona
     *
     * @param \Parroquia\ComunidadBundle\Entity\Persona $persona
     * @return GrupoPersona
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