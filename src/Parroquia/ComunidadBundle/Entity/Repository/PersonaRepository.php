<?php

namespace Parroquia\ComunidadBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

class PersonaRepository extends EntityRepository
{
    public function findAll()
    {
        return $this->findBy(array(), array('apellido_p' => 'ASC', 'apellido_m' => 'ASC', 'nombres' => 'ASC'));
    }
}

?>
