<?php

namespace Parroquia\CorreoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="mensajedestinatario",uniqueConstraints={@ORM\UniqueConstraint(name="mensaje_destinatario_idx", columns={"mensaje_id", "destinatario_id"})})
 * @UniqueEntity(fields={"mensaje","destinatario"})
 */
class MensajeDestinatario
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Mensaje", inversedBy="mensajes_destinatarios")
     * @ORM\JoinColumn(name="mensaje_id", referencedColumnName="id", nullable=false)
     * */
    protected $mensaje;
    
    /**
     * @ORM\ManyToOne(targetEntity="Parroquia\ComunidadBundle\Entity\Persona", inversedBy="mensajes_recibidos")
     * @ORM\JoinColumn(name="destinatario_id", referencedColumnName="id", nullable=false) 
     * */
    protected $destinatario;
    
    /**
     * @ORM\ManyToOne(targetEntity="Parroquia\ComunidadBundle\Entity\Grupo")
     * @ORM\JoinColumn(name="grupo_id", referencedColumnName="id", nullable=true) 
     * */
    protected $grupo;
    
    /**
     * @ORM\Column(type="boolean")
     */
    protected $enviado;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $motivo;
    
    public function __construct()
    {
        $this->enviado = false;   
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
     * Set mensaje
     *
     * @param \Parroquia\CorreoBundle\Entity\Mensaje $mensaje
     * @return MensajeDestinatario
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
     * Set destinatario
     *
     * @param \Parroquia\ComunidadBundle\Entity\Persona $destinatario
     * @return MensajeDestinatario
     */
    public function setDestinatario(\Parroquia\ComunidadBundle\Entity\Persona $destinatario)
    {
        $this->destinatario = $destinatario;
    
        return $this;
    }

    /**
     * Get destinatario
     *
     * @return \Parroquia\ComunidadBundle\Entity\Persona 
     */
    public function getDestinatario()
    {
        return $this->destinatario;
    }
    

    /**
     * Set grupo
     *
     * @param \Parroquia\ComunidadBundle\Entity\Grupo $grupo
     * @return MensajeDestinatario
     */
    public function setGrupo(\Parroquia\ComunidadBundle\Entity\Grupo $grupo = null)
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
     * Set enviado
     *
     * @param boolean $enviado
     * @return MensajeDestinatario
     */
    public function setEnviado($enviado)
    {
        $this->enviado = $enviado;
    
        return $this;
    }

    /**
     * Get enviado
     *
     * @return boolean 
     */
    public function getEnviado()
    {
        return $this->enviado;
    }

    /**
     * Set motivo
     *
     * @param string $motivo
     * @return MensajeDestinatario
     */
    public function setMotivo($motivo)
    {
        $this->motivo = $motivo;
    
        return $this;
    }

    /**
     * Get motivo
     *
     * @return string 
     */
    public function getMotivo()
    {
        return $this->motivo;
    }
}