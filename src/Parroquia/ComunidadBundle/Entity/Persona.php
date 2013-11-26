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
     * @ORM\Column(type="string")
     */
    protected $sexo;
    
    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $fecha_nacimiento;
    
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
     * @ORM\OneToOne(targetEntity="Parroquia\CertificadoBundle\Entity\Bautizo", mappedBy="persona", cascade="all")
     **/
    protected $bautizo;
    
    /**
     * @ORM\OneToOne(targetEntity="Parroquia\CertificadoBundle\Entity\Confirmacion", mappedBy="persona", cascade="all")
     **/
    protected $confirmacion;
    
    /**
     * @ORM\OneToMany(targetEntity="Parroquia\CertificadoBundle\Entity\Matrimonio", mappedBy="conyuge1", cascade={"all"})
     **/
    protected $matrimonios_conyuge1;

    /**
     * @ORM\OneToMany(targetEntity="Parroquia\CertificadoBundle\Entity\Matrimonio", mappedBy="conyuge2", cascade={"all"})
     **/
    protected $matrimonios_conyuge2;
    
    /**
     * @ORM\OneToMany(targetEntity="GrupoPersona", mappedBy="persona", cascade={"all"})
     **/
    protected $grupos_personas;
    
    /**
     * @ORM\OneToMany(targetEntity="Parroquia\CertificadoBundle\Entity\Certificado", mappedBy="emisor")
     **/
    protected $certificados_emitidos;
    
    /**
     * @ORM\OneToMany(targetEntity="Parroquia\CertificadoBundle\Entity\BautizoPadrino", mappedBy="padrino", cascade={"all"})
     **/
    protected $bautizos_padrinos;
    
    /**
     * @ORM\OneToMany(targetEntity="Parroquia\CertificadoBundle\Entity\BautizoCelebrante", mappedBy="celebrante", cascade={"all"})
     **/
    protected $bautizos_celebrantes;    
    
    /**
     * @ORM\OneToMany(targetEntity="Parroquia\CertificadoBundle\Entity\BautizoCatequista", mappedBy="catequista", cascade={"all"})
     **/
    protected $bautizos_catequistas;
    
    /**
     * @ORM\OneToMany(targetEntity="Parroquia\CertificadoBundle\Entity\ConfirmacionPadrino", mappedBy="padrino", cascade={"all"})
     **/
    protected $confirmaciones_padrinos;
    
    /**
     * @ORM\OneToMany(targetEntity="Parroquia\CertificadoBundle\Entity\ConfirmacionCelebrante", mappedBy="celebrante", cascade={"all"})
     **/
    protected $confirmaciones_celebrantes;    
    
    /**
     * @ORM\OneToMany(targetEntity="Parroquia\CertificadoBundle\Entity\ConfirmacionCatequista", mappedBy="catequista", cascade={"all"})
     **/
    protected $confirmaciones_catequistas;
    
    /**
     * @ORM\OneToMany(targetEntity="Parroquia\CertificadoBundle\Entity\MatrimonioPadrino", mappedBy="padrino", cascade={"all"})
     **/
    protected $matrimonios_padrinos;
    
    /**
     * @ORM\OneToMany(targetEntity="Parroquia\CertificadoBundle\Entity\MatrimonioCelebrante", mappedBy="celebrante", cascade={"all"})
     **/
    protected $matrimonios_celebrantes;    
    
    /**
     * @ORM\OneToMany(targetEntity="Parroquia\CertificadoBundle\Entity\MatrimonioCatequista", mappedBy="catequista", cascade={"all"})
     **/
    protected $matrimonios_catequistas;    
    
    /**
     * @ORM\OneToMany(targetEntity="Parroquia\CertificadoBundle\Entity\MatrimonioTestigo", mappedBy="testigo", cascade={"all"})
     **/
    protected $matrimonios_testigos;
    
    /**
     * @ORM\OneToMany(targetEntity="Persona", mappedBy="padre", cascade={"all"})
     **/
    protected $hijos_padre;

    /**
     * @ORM\ManyToOne(targetEntity="Persona", inversedBy="hijos_padre")
     * @ORM\JoinColumn(name="padre_id", referencedColumnName="id", nullable=true)
     **/
    protected $padre;
    
    /**
     * @ORM\OneToMany(targetEntity="Persona", mappedBy="madre", cascade={"all"})
     **/
    protected $hijos_madre;

    /**
     * @ORM\ManyToOne(targetEntity="Persona", inversedBy="hijos_madre")
     * @ORM\JoinColumn(name="madre_id", referencedColumnName="id", nullable=true)
     **/
    protected $madre;
    
    protected $matrimonios;
    
    public function __construct() {
        $this->matrimonios_conyuge1 = new ArrayCollection();
        $this->matrimonios_conyuge2 = new ArrayCollection();
        $this->grupos_personas = new ArrayCollection();
        $this->certificados_emitidos = new ArrayCollection();
        $this->bautizos_padrinos = new ArrayCollection();
        $this->bautizos_celebrantes = new ArrayCollection();        
        $this->bautizos_catequistas = new ArrayCollection();
        $this->confirmaciones_padrinos = new ArrayCollection();
        $this->confirmaciones_celebrantes = new ArrayCollection();        
        $this->confirmaciones_catequistas = new ArrayCollection();         
        $this->matrimonios_padrinos = new ArrayCollection();
        $this->matrimonios_celebrantes = new ArrayCollection();        
        $this->matrimonios_catequistas = new ArrayCollection();
        $this->matrimonios_testigos = new ArrayCollection();
        $this->hijos_padre = new ArrayCollection();
        $this->hijos_madre = new ArrayCollection();
        $this->matrimonios = new ArrayCollection();
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
        $bautizo->setPersona($this);
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
        $confirmacion->setPersona($this);
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
     * Add matrimonios_conyuge1
     *
     * @param \Parroquia\CertificadoBundle\Entity\Matrimonio $matrimoniosConyuge1
     * @return Persona
     */
    public function addMatrimoniosConyuge1(\Parroquia\CertificadoBundle\Entity\Matrimonio $matrimoniosConyuge1)
    {
        $matrimoniosConyuge1->setConyuge1($this);
        $this->matrimonios_conyuge1[] = $matrimoniosConyuge1;
    
        return $this;
    }

    /**
     * Remove matrimonios_conyuge1
     *
     * @param \Parroquia\CertificadoBundle\Entity\Matrimonio $matrimoniosConyuge1
     */
    public function removeMatrimoniosConyuge1(\Parroquia\CertificadoBundle\Entity\Matrimonio $matrimoniosConyuge1)
    {
        $this->matrimonios_conyuge1->removeElement($matrimoniosConyuge1);
    }

    /**
     * Get matrimonios_conyuge1
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMatrimoniosConyuge1()
    {
        return $this->matrimonios_conyuge1;
    }

    /**
     * Add matrimonios_conyuge2
     *
     * @param \Parroquia\CertificadoBundle\Entity\Matrimonio $matrimoniosConyuge2
     * @return Persona
     */
    public function addMatrimoniosConyuge2(\Parroquia\CertificadoBundle\Entity\Matrimonio $matrimoniosConyuge2)
    {
        $matrimoniosConyuge2->setConyuge2($this);
        $this->matrimonios_conyuge2[] = $matrimoniosConyuge2;
    
        return $this;
    }

    /**
     * Remove matrimonios_conyuge2
     *
     * @param \Parroquia\CertificadoBundle\Entity\Matrimonio $matrimoniosConyuge2
     */
    public function removeMatrimoniosConyuge2(\Parroquia\CertificadoBundle\Entity\Matrimonio $matrimoniosConyuge2)
    {
        $this->matrimonios_conyuge2->removeElement($matrimoniosConyuge2);
    }

    /**
     * Get matrimonios_conyuge2
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMatrimoniosConyuge2()
    {
        return $this->matrimonios_conyuge2;
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
     * Add grupos_personas
     *
     * @param \Parroquia\ComunidadBundle\Entity\GrupoPersona $gruposPersonas
     * @return Persona
     */
    public function addGruposPersona(\Parroquia\ComunidadBundle\Entity\GrupoPersona $gruposPersonas)
    {
        $this->grupos_personas[] = $gruposPersonas;
    
        return $this;
    }

    /**
     * Remove grupos_personas
     *
     * @param \Parroquia\ComunidadBundle\Entity\GrupoPersona $gruposPersonas
     */
    public function removeGruposPersona(\Parroquia\ComunidadBundle\Entity\GrupoPersona $gruposPersonas)
    {
        $this->grupos_personas->removeElement($gruposPersonas);
    }

    /**
     * Get grupos_personas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGruposPersonas()
    {
        return $this->grupos_personas;
    }    
    
    public function __toString()
    {
        return $this->nombres.' '.$this->apellido_p.' '.$this->apellido_m;
    }    
    
    public function getGrupos()
    {
        $grupos = new ArrayCollection();
        
        foreach($this->grupos_personas as $grupo_persona)
        {
            $grupos[] = $grupo_persona->getGrupo();
        }

        return $grupos;
    }
    
    public function setGrupos($grupos)
    {
        foreach($grupos as $grupo)
        {
            if(!$this->getGrupos()->contains($grupo))
            {
                $grupo_persona = new GrupoPersona();

                $grupo_persona->setPersona($this);
                $grupo_persona->setGrupo($grupo);

                $this->addGruposPersona($grupo_persona);
            }
        }

    }

    /**
     * Add bautizos_padrinos
     *
     * @param \Parroquia\CertificadoBundle\Entity\BautizoPadrino $bautizosPadrinos
     * @return Persona
     */
    public function addBautizosPadrino(\Parroquia\CertificadoBundle\Entity\BautizoPadrino $bautizosPadrinos)
    {
        $this->bautizos_padrinos[] = $bautizosPadrinos;
    
        return $this;
    }

    /**
     * Remove bautizos_padrinos
     *
     * @param \Parroquia\CertificadoBundle\Entity\BautizoPadrino $bautizosPadrinos
     */
    public function removeBautizosPadrino(\Parroquia\CertificadoBundle\Entity\BautizoPadrino $bautizosPadrinos)
    {
        $this->bautizos_padrinos->removeElement($bautizosPadrinos);
    }

    /**
     * Get bautizos_padrinos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBautizosPadrinos()
    {
        return $this->bautizos_padrinos;
    }

    /**
     * Add bautizos_celebrantes
     *
     * @param \Parroquia\CertificadoBundle\Entity\BautizoCelebrante $bautizosCelebrantes
     * @return Persona
     */
    public function addBautizosCelebrante(\Parroquia\CertificadoBundle\Entity\BautizoCelebrante $bautizosCelebrantes)
    {
        $this->bautizos_celebrantes[] = $bautizosCelebrantes;
    
        return $this;
    }

    /**
     * Remove bautizos_celebrantes
     *
     * @param \Parroquia\CertificadoBundle\Entity\BautizoCelebrante $bautizosCelebrantes
     */
    public function removeBautizosCelebrante(\Parroquia\CertificadoBundle\Entity\BautizoCelebrante $bautizosCelebrantes)
    {
        $this->bautizos_celebrantes->removeElement($bautizosCelebrantes);
    }

    /**
     * Get bautizos_celebrantes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBautizosCelebrantes()
    {
        return $this->bautizos_celebrantes;
    }

    /**
     * Add bautizos_catequistas
     *
     * @param \Parroquia\CertificadoBundle\Entity\BautizoCatequista $bautizosCatequistas
     * @return Persona
     */
    public function addBautizosCatequista(\Parroquia\CertificadoBundle\Entity\BautizoCatequista $bautizosCatequistas)
    {
        $this->bautizos_catequistas[] = $bautizosCatequistas;
    
        return $this;
    }

    /**
     * Remove bautizos_catequistas
     *
     * @param \Parroquia\CertificadoBundle\Entity\BautizoCatequista $bautizosCatequistas
     */
    public function removeBautizosCatequista(\Parroquia\CertificadoBundle\Entity\BautizoCatequista $bautizosCatequistas)
    {
        $this->bautizos_catequistas->removeElement($bautizosCatequistas);
    }

    /**
     * Get bautizos_catequistas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBautizosCatequistas()
    {
        return $this->bautizos_catequistas;
    }

    /**
     * Add confirmaciones_padrinos
     *
     * @param \Parroquia\CertificadoBundle\Entity\ConfirmacionPadrino $confirmacionesPadrinos
     * @return Persona
     */
    public function addConfirmacionesPadrino(\Parroquia\CertificadoBundle\Entity\ConfirmacionPadrino $confirmacionesPadrinos)
    {
        $this->confirmaciones_padrinos[] = $confirmacionesPadrinos;
    
        return $this;
    }

    /**
     * Remove confirmaciones_padrinos
     *
     * @param \Parroquia\CertificadoBundle\Entity\ConfirmacionPadrino $confirmacionesPadrinos
     */
    public function removeConfirmacionesPadrino(\Parroquia\CertificadoBundle\Entity\ConfirmacionPadrino $confirmacionesPadrinos)
    {
        $this->confirmaciones_padrinos->removeElement($confirmacionesPadrinos);
    }

    /**
     * Get confirmaciones_padrinos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getConfirmacionesPadrinos()
    {
        return $this->confirmaciones_padrinos;
    }

    /**
     * Add confirmaciones_celebrantes
     *
     * @param \Parroquia\CertificadoBundle\Entity\ConfirmacionCelebrante $confirmacionesCelebrantes
     * @return Persona
     */
    public function addConfirmacionesCelebrante(\Parroquia\CertificadoBundle\Entity\ConfirmacionCelebrante $confirmacionesCelebrantes)
    {
        $this->confirmaciones_celebrantes[] = $confirmacionesCelebrantes;
    
        return $this;
    }

    /**
     * Remove confirmaciones_celebrantes
     *
     * @param \Parroquia\CertificadoBundle\Entity\ConfirmacionCelebrante $confirmacionesCelebrantes
     */
    public function removeConfirmacionesCelebrante(\Parroquia\CertificadoBundle\Entity\ConfirmacionCelebrante $confirmacionesCelebrantes)
    {
        $this->confirmaciones_celebrantes->removeElement($confirmacionesCelebrantes);
    }

    /**
     * Get confirmaciones_celebrantes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getConfirmacionesCelebrantes()
    {
        return $this->confirmaciones_celebrantes;
    }

    /**
     * Add confirmaciones_catequistas
     *
     * @param \Parroquia\CertificadoBundle\Entity\ConfirmacionCatequista $confirmacionesCatequistas
     * @return Persona
     */
    public function addConfirmacionesCatequista(\Parroquia\CertificadoBundle\Entity\ConfirmacionCatequista $confirmacionesCatequistas)
    {
        $this->confirmaciones_catequistas[] = $confirmacionesCatequistas;
    
        return $this;
    }

    /**
     * Remove confirmaciones_catequistas
     *
     * @param \Parroquia\CertificadoBundle\Entity\ConfirmacionCatequista $confirmacionesCatequistas
     */
    public function removeConfirmacionesCatequista(\Parroquia\CertificadoBundle\Entity\ConfirmacionCatequista $confirmacionesCatequistas)
    {
        $this->confirmaciones_catequistas->removeElement($confirmacionesCatequistas);
    }

    /**
     * Get confirmaciones_catequistas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getConfirmacionesCatequistas()
    {
        return $this->confirmaciones_catequistas;
    }

    /**
     * Add matrimonios_padrinos
     *
     * @param \Parroquia\CertificadoBundle\Entity\MatrimonioPadrino $matrimoniosPadrinos
     * @return Persona
     */
    public function addMatrimoniosPadrino(\Parroquia\CertificadoBundle\Entity\MatrimonioPadrino $matrimoniosPadrinos)
    {
        $this->matrimonios_padrinos[] = $matrimoniosPadrinos;
    
        return $this;
    }

    /**
     * Remove matrimonios_padrinos
     *
     * @param \Parroquia\CertificadoBundle\Entity\MatrimonioPadrino $matrimoniosPadrinos
     */
    public function removeMatrimoniosPadrino(\Parroquia\CertificadoBundle\Entity\MatrimonioPadrino $matrimoniosPadrinos)
    {
        $this->matrimonios_padrinos->removeElement($matrimoniosPadrinos);
    }

    /**
     * Get matrimonios_padrinos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMatrimoniosPadrinos()
    {
        return $this->matrimonios_padrinos;
    }

    /**
     * Add matrimonios_celebrantes
     *
     * @param \Parroquia\CertificadoBundle\Entity\MatrimonioCelebrante $matrimoniosCelebrantes
     * @return Persona
     */
    public function addMatrimoniosCelebrante(\Parroquia\CertificadoBundle\Entity\MatrimonioCelebrante $matrimoniosCelebrantes)
    {
        $this->matrimonios_celebrantes[] = $matrimoniosCelebrantes;
    
        return $this;
    }

    /**
     * Remove matrimonios_celebrantes
     *
     * @param \Parroquia\CertificadoBundle\Entity\MatrimonioCelebrante $matrimoniosCelebrantes
     */
    public function removeMatrimoniosCelebrante(\Parroquia\CertificadoBundle\Entity\MatrimonioCelebrante $matrimoniosCelebrantes)
    {
        $this->matrimonios_celebrantes->removeElement($matrimoniosCelebrantes);
    }

    /**
     * Get matrimonios_celebrantes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMatrimoniosCelebrantes()
    {
        return $this->matrimonios_celebrantes;
    }

    /**
     * Add matrimonios_catequistas
     *
     * @param \Parroquia\CertificadoBundle\Entity\MatrimonioCatequista $matrimoniosCatequistas
     * @return Persona
     */
    public function addMatrimoniosCatequista(\Parroquia\CertificadoBundle\Entity\MatrimonioCatequista $matrimoniosCatequistas)
    {
        $this->matrimonios_catequistas[] = $matrimoniosCatequistas;
    
        return $this;
    }

    /**
     * Remove matrimonios_catequistas
     *
     * @param \Parroquia\CertificadoBundle\Entity\MatrimonioCatequista $matrimoniosCatequistas
     */
    public function removeMatrimoniosCatequista(\Parroquia\CertificadoBundle\Entity\MatrimonioCatequista $matrimoniosCatequistas)
    {
        $this->matrimonios_catequistas->removeElement($matrimoniosCatequistas);
    }

    /**
     * Get matrimonios_catequistas
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMatrimoniosCatequistas()
    {
        return $this->matrimonios_catequistas;
    }

    /**
     * Add matrimonios_testigos
     *
     * @param \Parroquia\CertificadoBundle\Entity\MatrimonioTestigo $matrimoniosTestigos
     * @return Persona
     */
    public function addMatrimoniosTestigo(\Parroquia\CertificadoBundle\Entity\MatrimonioTestigo $matrimoniosTestigos)
    {
        $this->matrimonios_testigos[] = $matrimoniosTestigos;
    
        return $this;
    }

    /**
     * Remove matrimonios_testigos
     *
     * @param \Parroquia\CertificadoBundle\Entity\MatrimonioTestigo $matrimoniosTestigos
     */
    public function removeMatrimoniosTestigo(\Parroquia\CertificadoBundle\Entity\MatrimonioTestigo $matrimoniosTestigos)
    {
        $this->matrimonios_testigos->removeElement($matrimoniosTestigos);
    }

    /**
     * Get matrimonios_testigos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMatrimoniosTestigos()
    {
        return $this->matrimonios_testigos;
    }

    /**
     * Add hijos_padre
     *
     * @param \Parroquia\ComunidadBundle\Entity\Persona $hijosPadre
     * @return Persona
     */
    public function addHijosPadre(\Parroquia\ComunidadBundle\Entity\Persona $hijosPadre)
    {
        $this->hijos_padre[] = $hijosPadre;
    
        return $this;
    }

    /**
     * Remove hijos_padre
     *
     * @param \Parroquia\ComunidadBundle\Entity\Persona $hijosPadre
     */
    public function removeHijosPadre(\Parroquia\ComunidadBundle\Entity\Persona $hijosPadre)
    {
        $this->hijos_padre->removeElement($hijosPadre);
    }

    /**
     * Get hijos_padre
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getHijosPadre()
    {
        return $this->hijos_padre;
    }

    /**
     * Set padre
     *
     * @param \Parroquia\ComunidadBundle\Entity\Persona $padre
     * @return Persona
     */
    public function setPadre(\Parroquia\ComunidadBundle\Entity\Persona $padre = null)
    {
        $this->padre = $padre;
    
        return $this;
    }

    /**
     * Get padre
     *
     * @return \Parroquia\ComunidadBundle\Entity\Persona 
     */
    public function getPadre()
    {
        return $this->padre;
    }

    /**
     * Add hijos_madre
     *
     * @param \Parroquia\ComunidadBundle\Entity\Persona $hijosMadre
     * @return Persona
     */
    public function addHijosMadre(\Parroquia\ComunidadBundle\Entity\Persona $hijosMadre)
    {
        $this->hijos_madre[] = $hijosMadre;
    
        return $this;
    }

    /**
     * Remove hijos_madre
     *
     * @param \Parroquia\ComunidadBundle\Entity\Persona $hijosMadre
     */
    public function removeHijosMadre(\Parroquia\ComunidadBundle\Entity\Persona $hijosMadre)
    {
        $this->hijos_madre->removeElement($hijosMadre);
    }

    /**
     * Get hijos_madre
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getHijosMadre()
    {
        return $this->hijos_madre;
    }

    /**
     * Set madre
     *
     * @param \Parroquia\ComunidadBundle\Entity\Persona $madre
     * @return Persona
     */
    public function setMadre(\Parroquia\ComunidadBundle\Entity\Persona $madre = null)
    {
        $this->madre = $madre;
    
        return $this;
    }

    /**
     * Get madre
     *
     * @return \Parroquia\ComunidadBundle\Entity\Persona 
     */
    public function getMadre()
    {
        return $this->madre;
    }
    
    public function getNombreRut()
    {
        return $this->nombres.' '.$this->apellido_p.' '.$this->apellido_m. ' (Rut: '.$this->rut.')';
    }
    
    public function getEdad()
    {   
        if($this->fecha_nacimiento != null)
        {
            $now      = new \DateTime();
            $interval = $now->diff($this->fecha_nacimiento);
            return $interval->format('%y años');            
        }
        else
        {
            return "Fecha de nacimiento no definida";
        }
    }
    
    
    /*** Métodos necesarios para gestionar Matrimonios en formulario de Persona ***/
    public function addMatrimonio(\Parroquia\CertificadoBundle\Entity\Matrimonio $matrimonio)
    {
        $this->addMatrimoniosConyuge1($matrimonio);
    }
    
    public function removeMatrimonio(\Parroquia\CertificadoBundle\Entity\Matrimonio $matrimonio)
    {
        $this->matrimonios->removeElement($matrimonio);
    }    

    public function getMatrimonios()
    {
        $this->matrimonios = new ArrayCollection(
                array_merge($this->matrimonios_conyuge1->toArray(), $this->matrimonios_conyuge2->toArray()));
 
        return $this->matrimonios;
    }
}