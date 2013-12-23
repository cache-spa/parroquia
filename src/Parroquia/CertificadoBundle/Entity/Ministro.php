<?php

namespace Parroquia\CertificadoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table
 * @UniqueEntity(fields={"persona","fecha_vigencia_termino"})
 * @Assert\Callback(methods={
 *     { "Parroquia\CertificadoBundle\Validator\MinistroValidator", "isMinistroValid"}
 * })
 */
class Ministro
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;       
    
    /**
     * @ORM\ManyToOne(targetEntity="Parroquia\ComunidadBundle\Entity\Persona", inversedBy="ministros")
     * @ORM\JoinColumn(name="persona_id", referencedColumnName="id")
     * */
    protected $persona;

    /**
     * @ORM\Column(type="date")
     */
    protected $fecha_curso_inicio;
    
    /**
     * @ORM\Column(type="date")
     */
    protected $fecha_curso_termino;
    
    /**
     * @ORM\Column(type="date")
     */
    protected $fecha_vigencia_inicio;
    
    /**
     * @ORM\Column(type="date")
     */
    protected $fecha_vigencia_termino;    
    

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
     * Set fecha_curso_inicio
     *
     * @param \DateTime $fechaCursoInicio
     * @return Ministro
     */
    public function setFechaCursoInicio($fechaCursoInicio)
    {
        $this->fecha_curso_inicio = $fechaCursoInicio;
    
        return $this;
    }

    /**
     * Get fecha_curso_inicio
     *
     * @return \DateTime 
     */
    public function getFechaCursoInicio()
    {
        return $this->fecha_curso_inicio;
    }

    /**
     * Set fecha_curso_termino
     *
     * @param \DateTime $fechaCursoTermino
     * @return Ministro
     */
    public function setFechaCursoTermino($fechaCursoTermino)
    {
        $this->fecha_curso_termino = $fechaCursoTermino;
    
        return $this;
    }

    /**
     * Get fecha_curso_termino
     *
     * @return \DateTime 
     */
    public function getFechaCursoTermino()
    {
        return $this->fecha_curso_termino;
    }

    /**
     * Set fecha_vigencia_inicio
     *
     * @param \DateTime $fechaVigenciaInicio
     * @return Ministro
     */
    public function setFechaVigenciaInicio($fechaVigenciaInicio)
    {
        $this->fecha_vigencia_inicio = $fechaVigenciaInicio;
    
        return $this;
    }

    /**
     * Get fecha_vigencia_inicio
     *
     * @return \DateTime 
     */
    public function getFechaVigenciaInicio()
    {
        return $this->fecha_vigencia_inicio;
    }

    /**
     * Set fecha_vigencia_termino
     *
     * @param \DateTime $fechaVigenciaTermino
     * @return Ministro
     */
    public function setFechaVigenciaTermino($fechaVigenciaTermino)
    {
        $this->fecha_vigencia_termino = $fechaVigenciaTermino;
    
        return $this;
    }

    /**
     * Get fecha_vigencia_termino
     *
     * @return \DateTime 
     */
    public function getFechaVigenciaTermino()
    {
        return $this->fecha_vigencia_termino;
    }

    /**
     * Set persona
     *
     * @param \Parroquia\ComunidadBundle\Entity\Persona $persona
     * @return Ministro
     */
    public function setPersona(\Parroquia\ComunidadBundle\Entity\Persona $persona = null)
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
    
    public function getVigencia()
    {
        $today = new \DateTime("now");
        $today = new \DateTime($today->format('Y-m-d'));
        return ($this->fecha_vigencia_termino >= $today);
    }
    
    public function getCaducaEn()
    {
        $today = new \DateTime("now");
        $today = new \DateTime($today->format('Y-m-d'));
        $interval = $today->diff($this->fecha_vigencia_termino);
        return $interval->format('%r%a');
    }
}