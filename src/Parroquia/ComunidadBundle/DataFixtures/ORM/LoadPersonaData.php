<?php

namespace Parroquia\ComunidadBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Parroquia\ComunidadBundle\Entity\Persona;

class LoadPersonaData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        for($i=1; $i<=10; $i++)
        {
            $persona = new Persona();
            $persona->setNombres('Persona'.$i);
            $persona->setApellidoP('ApellidoP'.$i);
            if($i%2==0)
            {
                $persona->setSexo('M');
            }
            else
            {
                $persona->setSexo('F');
            }            
            
            $manager->persist($persona);
        }        
        
        $manager->flush();
    }
}
