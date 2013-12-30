<?php

namespace Parroquia\CertificadoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="certificado")
 * @ORM\HasLifecycleCallbacks
 * @Assert\Callback(methods={
 *     { "Parroquia\CertificadoBundle\Validator\CertificadoValidator", "isCertificadoValid"}
 * })
 */
class Certificado
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string")
     * @Assert\Choice(
     *     choices = { "Bautizo", "Confirmación", "Matrimonio" },
     *     message = "Elija un tipo de certificado válido."
     * )
     */
    protected $tipo;
    
    /**
     * @ORM\ManyToOne(targetEntity="Parroquia\ComunidadBundle\Entity\Persona", inversedBy="certificados_asociados")
     * @ORM\JoinColumn(name="persona_id", referencedColumnName="id", nullable=false)
     * */     
    protected $persona;    
    
    /**
     * @ORM\ManyToOne(targetEntity="Parroquia\ComunidadBundle\Entity\Persona", inversedBy="certificados_emitidos")
     * @ORM\JoinColumn(name="emisor_id", referencedColumnName="id", nullable=false)
     * @Assert\NotNull(message="Emisor no puede ser nulo (su cuenta de usuario podría no tener una persona asociada)")
     * */     
    protected $emisor;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $fecha_emision;    
    
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    public $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $path;    

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
     * Set fecha_emision
     *
     * @param \DateTime $fechaEmision
     * @return Certificado
     */
    public function setFechaEmision($fechaEmision)
    {
        $this->fecha_emision = $fechaEmision;
    
        return $this;
    }

    /**
     * Get fecha_emision
     *
     * @return \DateTime 
     */
    public function getFechaEmision()
    {
        return $this->fecha_emision;
    }
    
    /**
     * Set tipo
     *
     * @param string $tipo
     * @return Certificado
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set persona
     *
     * @param \Parroquia\ComunidadBundle\Entity\Persona $persona
     * @return Certificado
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
    
    /**
     * Set emisor
     *
     * @param \Parroquia\ComunidadBundle\Entity\Persona $emisor
     * @return Certificado
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
     * Set name
     *
     * @param string $name
     * @return Certificado
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Certificado
     */
    public function setPath($path)
    {
        $this->path = $path;
    
        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }    
    
    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'certificados';
    }
    
    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }    
}