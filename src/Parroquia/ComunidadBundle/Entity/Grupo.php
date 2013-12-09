<?php

namespace Parroquia\ComunidadBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table
 */
class Grupo
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
     * @ORM\OneToMany(targetEntity="GrupoPersona", mappedBy="grupo", cascade={"all"})
     **/
    protected $grupos_personas;

    /**
     * @ORM\OneToMany(targetEntity="Grupo", mappedBy="padre", cascade={"all"})
     **/
    protected $hijos;

    /**
     * @ORM\ManyToOne(targetEntity="Grupo", inversedBy="hijos")
     * @ORM\JoinColumn(name="padre_id", referencedColumnName="id")
     **/
    protected $padre;
    
    /**
     * @ORM\OneToMany(targetEntity="Parroquia\CorreoBundle\Entity\MensajeGrupo", mappedBy="grupo")
     **/
    protected $mensajes_recibidos;    
    
    public function __construct() {
        $this->grupos_personas = new ArrayCollection();
        $this->hijos = new ArrayCollection();
        $this->mensajes_recibidos = new ArrayCollection();        
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
     * @return Grupo
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
     * Add grupos_personas
     *
     * @param \Parroquia\ComunidadBundle\Entity\GrupoPersona $gruposPersonas
     * @return Grupo
     */
    public function addGruposPersona(\Parroquia\ComunidadBundle\Entity\GrupoPersona $gruposPersonas)
    {
        $this->grupos_personas[] = $gruposPersonas;
    
        return $this;
    }

    /**
     * Remove grupos_personas
     *
     * @param \Parroquia\ComunidadBundle\Entity\GrupoPersona $gruposPersonas
     */
    public function removeGruposPersona(\Parroquia\ComunidadBundle\Entity\GrupoPersona $gruposPersonas)
    {
        $this->grupos_personas->removeElement($gruposPersonas);
    }

    /**
     * Get grupos_personas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGruposPersonas()
    {
        return $this->grupos_personas;
    }
    
    public function __toString()
    {
        return $this->nombre;
    }

    public function getPersonas()
    {
        $personas = new ArrayCollection();
        
        foreach($this->grupos_personas as $grupo_persona)
        {
            $personas[] = $grupo_persona->getPersona();
        }

        return $personas;
    }
    
    public function setPersonas($personas)
    {
        foreach($personas as $persona)
        {
            if(!$this->getPersonas()->contains($persona))
            {
                $grupo_persona = new GrupoPersona();

                $grupo_persona->setGrupo($this);
                $grupo_persona->setPersona($persona);

                $this->addGruposPersona($grupo_persona);
            }
        }

    }    
    

    /**
     * Add hijos
     *
     * @param \Parroquia\ComunidadBundle\Entity\Grupo $hijos
     * @return Grupo
     */
    public function addHijo(\Parroquia\ComunidadBundle\Entity\Grupo $hijos)
    {
        $this->hijos[] = $hijos;
    
        return $this;
    }

    /**
     * Remove hijos
     *
     * @param \Parroquia\ComunidadBundle\Entity\Grupo $hijos
     */
    public function removeHijo(\Parroquia\ComunidadBundle\Entity\Grupo $hijos)
    {
        $this->hijos->removeElement($hijos);
    }

    /**
     * Get hijos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getHijos()
    {
        return $this->hijos;
    }

    /**
     * Set padre
     *
     * @param \Parroquia\ComunidadBundle\Entity\Grupo $padre
     * @return Grupo
     */
    public function setPadre(\Parroquia\ComunidadBundle\Entity\Grupo $padre = null)
    {
        $this->padre = $padre;
    
        return $this;
    }

    /**
     * Get padre
     *
     * @return \Parroquia\ComunidadBundle\Entity\Grupo 
     */
    public function getPadre()
    {
        return $this->padre;
    }

    /**
     * Retorna nombre del padre para agrupar en campos select (group_by)
     *
     * @return string 
     */   
    public function getPadreNombre()
    {
        if (null === $this->getPadre()) {
            return null;
        }

        return $this->getPadre()->getNombre();
    }


    /**
     * Add mensajes_recibidos
     *
     * @param \Parroquia\CorreoBundle\Entity\MensajeGrupo $mensajesRecibidos
     * @return Grupo
     */
    public function addMensajesRecibido(\Parroquia\CorreoBundle\Entity\MensajeGrupo $mensajesRecibidos)
    {
        $this->mensajes_recibidos[] = $mensajesRecibidos;
    
        return $this;
    }

    /**
     * Remove mensajes_recibidos
     *
     * @param \Parroquia\CorreoBundle\Entity\MensajeGrupo $mensajesRecibidos
     */
    public function removeMensajesRecibido(\Parroquia\CorreoBundle\Entity\MensajeGrupo $mensajesRecibidos)
    {
        $this->mensajes_recibidos->removeElement($mensajesRecibidos);
    }

    /**
     * Get mensajes_recibidos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMensajesRecibidos()
    {
        return $this->mensajes_recibidos;
    }
}