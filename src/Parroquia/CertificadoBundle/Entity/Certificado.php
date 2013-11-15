<?php

namespace Parroquia\CertificadoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table
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
     * @ORM\Column(type="datetime")
     */
    protected $fecha_emision;
    
    /**
     * @ORM\ManyToOne(targetEntity="Parroquia\ComunidadBundle\Entity\Persona", inversedBy="certificados_emitidos")
     * @ORM\JoinColumn(name="emisor_id", referencedColumnName="id")
     * */     
    protected $emisor;
    
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
    


}