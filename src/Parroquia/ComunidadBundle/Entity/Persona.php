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
     * @ORM\OneToMany(targetEntity="Parroquia\CertificadoBundle\Entity\Matrimonio", mappedBy="hombre")
     **/
    protected $matrimonios_hombre;

    /**
     * @ORM\OneToMany(targetEntity="Parroquia\CertificadoBundle\Entity\Matrimonio", mappedBy="mujer")
     **/
    protected $matrimonios_mujer;
    
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
    
    public function __construct() {
        $this->matrimonios_hombre = new ArrayCollection();
        $this->matrimonios_mujer = new ArrayCollection();
        $this->grupos_personas = new ArrayCollection();
        $this->certificados_emitidos = new ArrayCollection();
        $this->bautizos_padrinos = new ArrayCollection();
        $this->bautizos_celebrantes = new ArrayCollection();        
        $this->bautizos_catequistas = new ArrayCollection();
        $this->confirmaciones_padrinos = new ArrayCollection();
        $this->confirmaciones_celebrantes = new ArrayCollection();        
        $this->confirmaciones_catequistas = new ArrayCollection();         
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
     * Add matrimonios_hombre
     *
     * @param \Parroquia\CertificadoBundle\Entity\Matrimonio $matrimonioshombre
     * @return Persona
     */
    public function addMatrimoniosHombre(\Parroquia\CertificadoBundle\Entity\Matrimonio $matrimonioshombre)
    {
        $this->matrimonios_hombre[] = $matrimonioshombre;
    
        return $this;
    }

    /**
     * Remove matrimonios_hombre
     *
     * @param \Parroquia\CertificadoBundle\Entity\Matrimonio $matrimonioshombre
     */
    public function removeMatrimoniosHombre(\Parroquia\CertificadoBundle\Entity\Matrimonio $matrimonioshombre)
    {
        $this->matrimonios_hombre->removeElement($matrimonioshombre);
    }

    /**
     * Get matrimonios_hombre
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMatrimoniosHombre()
    {
        return $this->matrimonios_hombre;
    }

    /**
     * Add matrimonios_mujer
     *
     * @param \Parroquia\CertificadoBundle\Entity\Matrimonio $matrimoniosmujer
     * @return Persona
     */
    public function addMatrimoniosMujer(\Parroquia\CertificadoBundle\Entity\Matrimonio $matrimoniosmujer)
    {
        $this->matrimonios_mujer[] = $matrimoniosmujer;
    
        return $this;
    }

    /**
     * Remove matrimonios_mujer
     *
     * @param \Parroquia\CertificadoBundle\Entity\Matrimonio $matrimoniosmujer
     */
    public function removeMatrimoniosMujer(\Parroquia\CertificadoBundle\Entity\Matrimonio $matrimoniosmujer)
    {
        $this->matrimonios_mujer->removeElement($matrimoniosmujer);
    }

    /**
     * Get matrimonios_mujer
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMatrimoniosMujer()
    {
        return $this->matrimonios_mujer;
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
}