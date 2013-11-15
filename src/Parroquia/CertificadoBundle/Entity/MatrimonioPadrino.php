<?php

namespace Parroquia\CertificadoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(uniqueConstraints={@ORM\UniqueConstraint(name="matrimonio_padrino_idx", columns={"matrimonio_id", "padrino_id"})})
 */
class MatrimonioPadrino
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Matrimonio", inversedBy="matrimonios_padrinos")
     * @ORM\JoinColumn(name="matrimonio_id", referencedColumnName="id", nullable=false)
     * */
    protected $matrimonio;
    
    /**
     * @ORM\ManyToOne(targetEntity="Parroquia\ComunidadBundle\Entity\Persona", inversedBy="matrimonios_padrinos")
     * @ORM\JoinColumn(name="padrino_id", referencedColumnName="id", nullable=false) 
     * */
    protected $padrino;
    

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
     * Set matrimonio
     *
     * @param \Parroquia\CertificadoBundle\Entity\Matrimonio $matrimonio
     * @return MatrimonioPadrino
     */
    public function setMatrimonio(\Parroquia\CertificadoBundle\Entity\Matrimonio $matrimonio)
    {
        $this->matrimonio = $matrimonio;
    
        return $this;
    }

    /**
     * Get matrimonio
     *
     * @return \Parroquia\CertificadoBundle\Entity\Matrimonio 
     */
    public function getMatrimonio()
    {
        return $this->matrimonio;
    }

    /**
     * Set padrino
     *
     * @param \Parroquia\ComunidadBundle\Entity\Persona $padrino
     * @return MatrimonioPadrino
     */
    public function setPadrino(\Parroquia\ComunidadBundle\Entity\Persona $padrino)
    {
        $this->padrino = $padrino;
    
        return $this;
    }

    /**
     * Get padrino
     *
     * @return \Parroquia\ComunidadBundle\Entity\Persona 
     */
    public function getPadrino()
    {
        return $this->padrino;
    }
}