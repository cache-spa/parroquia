<?php

namespace Parroquia\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    const ROLE_ADMIN = 'ROLE_ADMIN';
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * @ORM\OneToOne(targetEntity="Parroquia\ComunidadBundle\Entity\Persona", inversedBy="usuario")
     * @ORM\JoinColumn(name="persona_id", referencedColumnName="id", nullable=true, unique=true) 
     **/   
    protected $persona;    
    

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
     * Set persona
     *
     * @param \Parroquia\ComunidadBundle\Entity\Persona $persona
     * @return User
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
    
    public function isAdmin()
    {
        return $this->hasRole(static::ROLE_ADMIN);
    }
    
    public function setAdmin($boolean)
    {
        if (true === $boolean) {
            $this->addRole(static::ROLE_ADMIN);
        } else {
            $this->removeRole(static::ROLE_ADMIN);
        }

        return $this;
    }    
    
}