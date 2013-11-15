<?php

namespace Parroquia\CertificadoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="bautizo_celebrante_idx", columns={"bautizo_id", "celebrante_id"})})
 */
class BautizoCelebrante
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Bautizo", inversedBy="bautizos_celebrantes")
     * @ORM\JoinColumn(name="bautizo_id", referencedColumnName="id", nullable=false)
     * */
    protected $bautizo;
    
    /**
     * @ORM\ManyToOne(targetEntity="Parroquia\ComunidadBundle\Entity\Persona", inversedBy="bautizos_celebrantes")
     * @ORM\JoinColumn(name="celebrante_id", referencedColumnName="id", nullable=false) 
     * */
    protected $celebrante;
    

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
     * Set bautizo
     *
     * @param \Parroquia\CertificadoBundle\Entity\Bautizo $bautizo
     * @return BautizoCelebrante
     */
    public function setBautizo(\Parroquia\CertificadoBundle\Entity\Bautizo $bautizo)
    {
        $this->bautizo = $bautizo;
    
        return $this;
    }

    /**
     * Get bautizo
     *
     * @return \Parroquia\CertificadoBundle\Entity\Bautizo 
     */
    public function getBautizo()
    {
        return $this->bautizo;
    }

    /**
     * Set celebrante
     *
     * @param \Parroquia\ComunidadBundle\Entity\Persona $celebrante
     * @return BautizoCelebrante
     */
    public function setCelebrante(\Parroquia\ComunidadBundle\Entity\Persona $celebrante)
    {
        $this->celebrante = $celebrante;
    
        return $this;
    }

    /**
     * Get celebrante
     *
     * @return \Parroquia\ComunidadBundle\Entity\Persona 
     */
    public function getCelebrante()
    {
        return $this->celebrante;
    }
}