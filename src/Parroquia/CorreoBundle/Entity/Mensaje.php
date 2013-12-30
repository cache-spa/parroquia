<?php

namespace Parroquia\CorreoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="mensaje")
 */
class Mensaje
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Parroquia\ComunidadBundle\Entity\Persona", inversedBy="mensajes_emitidos")
     * @ORM\JoinColumn(name="emisor_id", referencedColumnName="id", nullable=false)
     * @Assert\NotNull(message="Emisor no puede ser nulo (su cuenta de usuario podría no tener una persona asociada)")
     * */     
    protected $emisor;   

    /**
     * @ORM\Column(type="string")
     */
    protected $asunto;    
    
    /**
     * @ORM\Column(type="text")
     */
    protected $cuerpo;
    
    /**
     * @ORM\OneToMany(targetEntity="MensajeDestinatario", mappedBy="mensaje", cascade={"all"})
     **/
    protected $mensajes_destinatarios;
    
    /**
     * @ORM\OneToMany(targetEntity="MensajeGrupo", mappedBy="mensaje", cascade={"all"})
     **/
    protected $mensajes_grupos;    
        
    /**
     * @ORM\Column(type="datetime")
     */
    protected $fecha_envio; 
    
    /**
     * @ORM\OneToMany(targetEntity="Adjunto", mappedBy="mensaje", cascade={"all"})
     **/
    protected $adjuntos;

    public function __construct()
    {
        $this->mensajes_destinatarios = new ArrayCollection();
        $this->mensajes_grupos = new ArrayCollection();        
        $this->fecha_envio = new \DateTime();
        $this->adjuntos = new ArrayCollection();        
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
     * Set asunto
     *
     * @param string $asunto
     * @return Mensaje
     */
    public function setAsunto($asunto)
    {
        $this->asunto = $asunto;
    
        return $this;
    }

    /**
     * Get asunto
     *
     * @return string 
     */
    public function getAsunto()
    {
        return $this->asunto;
    }

    /**
     * Set cuerpo
     *
     * @param string $cuerpo
     * @return Mensaje
     */
    public function setCuerpo($cuerpo)
    {
        $this->cuerpo = $cuerpo;
    
        return $this;
    }

    /**
     * Get cuerpo
     *
     * @return string 
     */
    public function getCuerpo()
    {
        return $this->cuerpo;
    }

    /**
     * Set fecha_envio
     *
     * @param \DateTime $fechaEnvio
     * @return Mensaje
     */
    public function setFechaEnvio($fechaEnvio)
    {
        $this->fecha_envio = $fechaEnvio;
    
        return $this;
    }

    /**
     * Get fecha_envio
     *
     * @return \DateTime 
     */
    public function getFechaEnvio()
    {
        return $this->fecha_envio;
    }

    /**
     * Set emisor
     *
     * @param \Parroquia\ComunidadBundle\Entity\Persona $emisor
     * @return Mensaje
     */
    public function setEmisor(\Parroquia\ComunidadBundle\Entity\Persona $emisor = null)
    {
        $this->emisor = $emisor;
    
        return $this;
    }

    /**
     * Get emisor
     *
     * @return \Parroquia\ComunidadBundle\Entity\Persona 
     */
    public function getEmisor()
    {
        return $this->emisor;
    }

    /**
     * Add mensajes_destinatarios
     *
     * @param \Parroquia\CorreoBundle\Entity\MensajeDestinatario $mensajesDestinatarios
     * @return Mensaje
     */
    public function addMensajesDestinatario(\Parroquia\CorreoBundle\Entity\MensajeDestinatario $mensajesDestinatarios)
    {
        $this->mensajes_destinatarios[] = $mensajesDestinatarios;
    
        return $this;
    }

    /**
     * Remove mensajes_destinatarios
     *
     * @param \Parroquia\CorreoBundle\Entity\MensajeDestinatario $mensajesDestinatarios
     */
    public function removeMensajesDestinatario(\Parroquia\CorreoBundle\Entity\MensajeDestinatario $mensajesDestinatarios)
    {
        $this->mensajes_destinatarios->removeElement($mensajesDestinatarios);
    }

    /**
     * Get mensajes_destinatarios
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMensajesDestinatarios()
    {
        return $this->mensajes_destinatarios;
    }

    /**
     * Add adjuntos
     *
     * @param \Parroquia\CorreoBundle\Entity\Adjunto $adjuntos
     * @return Mensaje
     */
    public function addAdjunto($adjuntos)
    {
        if($adjuntos instanceof \Parroquia\CorreoBundle\Entity\Adjunto)
        {
            $adjuntos->setMensaje($this);
            $this->adjuntos[] = $adjuntos;    
        }
    
        return $this;
    }

    /**
     * Remove adjuntos
     *
     * @param \Parroquia\CorreoBundle\Entity\Adjunto $adjuntos
     */
    public function removeAdjunto(\Parroquia\CorreoBundle\Entity\Adjunto $adjuntos)
    {
        $this->adjuntos->removeElement($adjuntos);
    }

    /**
     * Get adjuntos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAdjuntos()
    {
        return $this->adjuntos;
    }
    
    public function getDestinatarios()
    {
        $destinatarios = new ArrayCollection();
        
        foreach($this->mensajes_destinatarios as $mensaje_destinatario)
        {
            $destinatarios[] = $mensaje_destinatario->getDestinatario();
        }

        return $destinatarios;
    }
    
    public function setDestinatarios($destinatarios, $grupo = null)
    {
        foreach($destinatarios as $destinatario)
        {
            if(!$this->getDestinatarios()->contains($destinatario))
            {
                $mensaje_destinatario = new MensajeDestinatario();

                $mensaje_destinatario->setMensaje($this);
                $mensaje_destinatario->setDestinatario($destinatario);
                $mensaje_destinatario->setGrupo($grupo);               

                $this->addMensajesDestinatario($mensaje_destinatario);
            }
        }
    }    

    /**
     * Add mensajes_grupos
     *
     * @param \Parroquia\CorreoBundle\Entity\MensajeGrupo $mensajesGrupos
     * @return Mensaje
     */
    public function addMensajesGrupo(\Parroquia\CorreoBundle\Entity\MensajeGrupo $mensajesGrupos)
    {
        $this->mensajes_grupos[] = $mensajesGrupos;
    
        return $this;
    }

    /**
     * Remove mensajes_grupos
     *
     * @param \Parroquia\CorreoBundle\Entity\MensajeGrupo $mensajesGrupos
     */
    public function removeMensajesGrupo(\Parroquia\CorreoBundle\Entity\MensajeGrupo $mensajesGrupos)
    {
        $this->mensajes_grupos->removeElement($mensajesGrupos);
    }

    /**
     * Get mensajes_grupos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMensajesGrupos()
    {
        return $this->mensajes_grupos;
    }
    
    public function getGrupos()
    {
        $grupos = new ArrayCollection();
        
        foreach($this->mensajes_grupos as $mensaje_grupo)
        {
            $grupos[] = $mensaje_grupo->getGrupo();
        }

        return $grupos;
    }
    
    public function setGrupos($grupos)
    {
        foreach($grupos as $grupo)
        {
            if(!$this->getGrupos()->contains($grupo))
            {
                $mensaje_grupo = new MensajeGrupo();

                $mensaje_grupo->setMensaje($this);
                $mensaje_grupo->setGrupo($grupo);

                $this->addMensajesGrupo($mensaje_grupo);
                
                //Agregamos las personas del grupo como destinatarios individuales
                $this->setDestinatarios($grupo->getPersonas(), $grupo);
            }
        }
    }    
}