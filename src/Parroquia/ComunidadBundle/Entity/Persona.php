<?php

namespace Parroquia\ComunidadBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Parroquia\ComunidadBundle\Validator\Constraints as ParroquiaAssert;

/**
 * @ORM\Entity
 * @ORM\Table
 */
class Persona
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $nombres;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $apellido_p;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $apellido_m;
    
    /**
     * @ORM\Column(type="string", nullable=true, unique=true)
     * @ParroquiaAssert\Rut
     */
    protected $rut;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $sexo;
    
    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $fecha_nacimiento;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $padre;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $madre;
    
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $telefono;
    
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $celular;     

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $email;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $direccion;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $estado_civil; 
    
    /**
     * @ORM\OneToOne(targetEntity="Parroquia\CertificadoBundle\Entity\Bautizo", mappedBy="persona")
     **/
    protected $bautizo;
    
    /**
     * @ORM\OneToOne(targetEntity="Parroquia\CertificadoBundle\Entity\Confirmacion", mappedBy="persona")
     **/
    protected $confirmacion;
    
    /**
     * @ORM\OneToMany(targetEntity="Parroquia\CertificadoBundle\Entity\Matrimonio", mappedBy="persona_1")
     **/
    protected $matrimonios_1;

    /**
     * @ORM\OneToMany(targetEntity="Parroquia\CertificadoBundle\Entity\Matrimonio", mappedBy="persona_2")
     **/
    protected $matrimonios_2;
    
    /**
     * @ORM\OneToMany(targetEntity="CategoriaPersona", mappedBy="persona", cascade={"all"})
     **/
    protected $categorias_personas;
    
    /**
     * @ORM\OneToMany(targetEntity="Parroquia\CertificadoBundle\Entity\Certificado", mappedBy="emisor")
     **/
    protected $certificados_emitidos; 
    
    public function __construct() {
        $this->matrimonios_1 = new ArrayCollection();
        $this->matrimonios_2 = new ArrayCollection();
        $this->categorias_personas = new ArrayCollection();
        $this->certificados_emitidos = new ArrayCollection();
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
     * Set nombres
     *
     * @param string $nombres
     * @return Persona
     */
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;
    
        return $this;
    }

    /**
     * Get nombres
     *
     * @return string 
     */
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * Set apellido_p
     *
     * @param string $apellidoP
     * @return Persona
     */
    public function setApellidoP($apellidoP)
    {
        $this->apellido_p = $apellidoP;
    
        return $this;
    }

    /**
     * Get apellido_p
     *
     * @return string 
     */
    public function getApellidoP()
    {
        return $this->apellido_p;
    }

    /**
     * Set apellido_m
     *
     * @param string $apellidoM
     * @return Persona
     */
    public function setApellidoM($apellidoM)
    {
        $this->apellido_m = $apellidoM;
    
        return $this;
    }

    /**
     * Get apellido_m
     *
     * @return string 
     */
    public function getApellidoM()
    {
        return $this->apellido_m;
    }

    /**
     * Set rut
     *
     * @param string $rut
     * @return Persona
     */
    public function setRut($rut)
    {
        $this->rut = $rut;
    
        return $this;
    }

    /**
     * Get rut
     *
     * @return string 
     */
    public function getRut()
    {
        return $this->rut;
    }

    /**
     * Set sexo
     *
     * @param string $sexo
     * @return Persona
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    
        return $this;
    }

    /**
     * Get sexo
     *
     * @return string 
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set fecha_nacimiento
     *
     * @param \DateTime $fechaNacimiento
     * @return Persona
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fecha_nacimiento = $fechaNacimiento;
    
        return $this;
    }

    /**
     * Get fecha_nacimiento
     *
     * @return \DateTime 
     */
    public function getFechaNacimiento()
    {
        return $this->fecha_nacimiento;
    }

    /**
     * Set padre
     *
     * @param string $padre
     * @return Persona
     */
    public function setPadre($padre)
    {
        $this->padre = $padre;
    
        return $this;
    }

    /**
     * Get padre
     *
     * @return string 
     */
    public function getPadre()
    {
        return $this->padre;
    }

    /**
     * Set madre
     *
     * @param string $madre
     * @return Persona
     */
    public function setMadre($madre)
    {
        $this->madre = $madre;
    
        return $this;
    }

    /**
     * Get madre
     *
     * @return string 
     */
    public function getMadre()
    {
        return $this->madre;
    }

    /**
     * Set telefono
     *
     * @param integer $telefono
     * @return Persona
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    
        return $this;
    }

    /**
     * Get telefono
     *
     * @return integer 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set celular
     *
     * @param integer $celular
     * @return Persona
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;
    
        return $this;
    }

    /**
     * Get celular
     *
     * @return integer 
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Persona
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Persona
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    
        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set estado_civil
     *
     * @param string $estadoCivil
     * @return Persona
     */
    public function setEstadoCivil($estadoCivil)
    {
        $this->estado_civil = $estadoCivil;
    
        return $this;
    }

    /**
     * Get estado_civil
     *
     * @return string 
     */
    public function getEstadoCivil()
    {
        return $this->estado_civil;
    }

    /**
     * Set bautizo
     *
     * @param \Parroquia\CertificadoBundle\Entity\Bautizo $bautizo
     * @return Persona
     */
    public function setBautizo(\Parroquia\CertificadoBundle\Entity\Bautizo $bautizo = null)
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
     * Set confirmacion
     *
     * @param \Parroquia\CertificadoBundle\Entity\Confirmacion $confirmacion
     * @return Persona
     */
    public function setConfirmacion(\Parroquia\CertificadoBundle\Entity\Confirmacion $confirmacion = null)
    {
        $this->confirmacion = $confirmacion;
    
        return $this;
    }

    /**
     * Get confirmacion
     *
     * @return \Parroquia\CertificadoBundle\Entity\Confirmacion 
     */
    public function getConfirmacion()
    {
        return $this->confirmacion;
    }

    /**
     * Add matrimonios_1
     *
     * @param \Parroquia\CertificadoBundle\Entity\Matrimonio $matrimonios1
     * @return Persona
     */
    public function addMatrimonios1(\Parroquia\CertificadoBundle\Entity\Matrimonio $matrimonios1)
    {
        $this->matrimonios_1[] = $matrimonios1;
    
        return $this;
    }

    /**
     * Remove matrimonios_1
     *
     * @param \Parroquia\CertificadoBundle\Entity\Matrimonio $matrimonios1
     */
    public function removeMatrimonios1(\Parroquia\CertificadoBundle\Entity\Matrimonio $matrimonios1)
    {
        $this->matrimonios_1->removeElement($matrimonios1);
    }

    /**
     * Get matrimonios_1
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMatrimonios1()
    {
        return $this->matrimonios_1;
    }

    /**
     * Add matrimonios_2
     *
     * @param \Parroquia\CertificadoBundle\Entity\Matrimonio $matrimonios2
     * @return Persona
     */
    public function addMatrimonios2(\Parroquia\CertificadoBundle\Entity\Matrimonio $matrimonios2)
    {
        $this->matrimonios_2[] = $matrimonios2;
    
        return $this;
    }

    /**
     * Remove matrimonios_2
     *
     * @param \Parroquia\CertificadoBundle\Entity\Matrimonio $matrimonios2
     */
    public function removeMatrimonios2(\Parroquia\CertificadoBundle\Entity\Matrimonio $matrimonios2)
    {
        $this->matrimonios_2->removeElement($matrimonios2);
    }

    /**
     * Get matrimonios_2
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMatrimonios2()
    {
        return $this->matrimonios_2;
    }
        
    /**
     * Add certificados_emitidos
     *
     * @param \Parroquia\CertificadoBundle\Entity\Certificados $certificadosEmitidos
     * @return Persona
     */
    public function addCertificadosEmitido(\Parroquia\CertificadoBundle\Entity\Certificado $certificadosEmitidos)
    {
        $this->certificados_emitidos[] = $certificadosEmitidos;
    
        return $this;
    }

    /**
     * Remove certificados_emitidos
     *
     * @param \Parroquia\CertificadoBundle\Entity\Certificado $certificadosEmitidos
     */
    public function removeCertificadosEmitido(\Parroquia\CertificadoBundle\Entity\Certificado $certificadosEmitidos)
    {
        $this->certificados_emitidos->removeElement($certificadosEmitidos);
    }

    /**
     * Get certificados_emitidos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCertificadosEmitidos()
    {
        return $this->certificados_emitidos;
    }    

    /**
     * Add categorias_personas
     *
     * @param \Parroquia\ComunidadBundle\Entity\CategoriaPersona $categoriasPersonas
     * @return Persona
     */
    public function addCategoriasPersona(\Parroquia\ComunidadBundle\Entity\CategoriaPersona $categoriasPersonas)
    {
        $this->categorias_personas[] = $categoriasPersonas;
    
        return $this;
    }

    /**
     * Remove categorias_personas
     *
     * @param \Parroquia\ComunidadBundle\Entity\CategoriaPersona $categoriasPersonas
     */
    public function removeCategoriasPersona(\Parroquia\ComunidadBundle\Entity\CategoriaPersona $categoriasPersonas)
    {
        $this->categorias_personas->removeElement($categoriasPersonas);
    }

    /**
     * Get categorias_personas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategoriasPersonas()
    {
        return $this->categorias_personas;
    }    
    
    public function __toString()
    {
        return $this->nombres.' '.$this->apellido_p.' '.$this->apellido_m;
    }    
    
    public function getCategorias()
    {
        $categorias = new ArrayCollection();
        
        foreach($this->categorias_personas as $categoria_persona)
        {
            $categorias[] = $categoria_persona->getCategoria();
        }

        return $categorias;
    }
    
    public function setCategorias($categorias)
    {
        foreach($categorias as $categoria)
        {
            if(!$this->getCategorias()->contains($categoria))
            {
                $categoria_persona = new CategoriaPersona();

                $categoria_persona->setPersona($this);
                $categoria_persona->setCategoria($categoria);

                $this->addCategoriasPersona($categoria_persona);
            }
        }

    }
}