<?php

namespace Parroquia\CorreoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="mensajegrupo",uniqueConstraints={@ORM\UniqueConstraint(name="mensaje_grupo_idx", columns={"mensaje_id", "grupo_id"})})
 * @UniqueEntity(fields={"mensaje","grupo"})
 */
class MensajeGrupo
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Mensaje", inversedBy="mensajes_grupos")
     * @ORM\JoinColumn(name="mensaje_id", referencedColumnName="id", nullable=false)
     * */
    protected $mensaje;
    
    /**
     * @ORM\ManyToOne(targetEntity="Parroquia\ComunidadBundle\Entity\Grupo", inversedBy="mensajes_grupo")
     * @ORM\JoinColumn(name="grupo_id", referencedColumnName="id", nullable=false) 
     * */
    protected $grupo;
    

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
     * Set mensaje
     *
     * @param \Parroquia\CorreoBundle\Entity\Mensaje $mensaje
     * @return MensajeGrupo
     */
    public function setMensaje(\Parroquia\CorreoBundle\Entity\Mensaje $mensaje)
    {
        $this->mensaje = $mensaje;
    
        return $this;
    }

    /**
     * Get mensaje
     *
     * @return \Parroquia\CorreoBundle\Entity\Mensaje 
     */
    public function getMensaje()
    {
        return $this->mensaje;
    }

    /**
     * Set grupo
     *
     * @param \Parroquia\ComunidadBundle\Entity\Grupo $grupo
     * @return MensajeGrupo
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
}