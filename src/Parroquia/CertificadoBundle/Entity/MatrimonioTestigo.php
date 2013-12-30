<?php

namespace Parroquia\CertificadoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="matrimoniotestigo",uniqueConstraints={@ORM\UniqueConstraint(name="matrimonio_testigo_idx", columns={"matrimonio_id", "testigo_id"})})
 * @UniqueEntity(fields={"testigo","matrimonio"})
 *
 */
class MatrimonioTestigo
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Matrimonio", inversedBy="matrimonios_testigos")
     * @ORM\JoinColumn(name="matrimonio_id", referencedColumnName="id", nullable=false)
     * */
    protected $matrimonio;
    
    /**
     * @ORM\ManyToOne(targetEntity="Parroquia\ComunidadBundle\Entity\Persona", inversedBy="matrimonios_testigos")
     * @ORM\JoinColumn(name="testigo_id", referencedColumnName="id", nullable=false) 
     * */
    protected $testigo;
    

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
     * @return MatrimonioTestigo
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
     * Set testigo
     *
     * @param \Parroquia\ComunidadBundle\Entity\Persona $testigo
     * @return MatrimonioTestigo
     */
    public function setTestigo(\Parroquia\ComunidadBundle\Entity\Persona $testigo)
    {
        $this->testigo = $testigo;
    
        return $this;
    }

    /**
     * Get testigo
     *
     * @return \Parroquia\ComunidadBundle\Entity\Persona 
     */
    public function getTestigo()
    {
        return $this->testigo;
    }
}