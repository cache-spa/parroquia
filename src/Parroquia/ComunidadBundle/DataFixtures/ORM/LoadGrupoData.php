<?php

namespace Parroquia\ComunidadBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Parroquia\ComunidadBundle\Entity\Grupo;

class LoadGrupoData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $grupo = new Grupo();
        $grupo->setNombre('Acólitos');
        $manager->persist($grupo);
        
        $grupo = new Grupo();
        $grupo->setNombre('Voluntarios');
        $manager->persist($grupo);

        $grupo = new Grupo();
        $grupo->setNombre('Sacerdotes');
        $manager->persist($grupo);
        
        $manager->flush();
    }
}
