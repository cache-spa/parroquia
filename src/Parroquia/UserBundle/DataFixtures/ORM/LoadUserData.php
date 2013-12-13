<?php

namespace Parroquia\UserBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Parroquia\UserBundle\Entity\User;

class LoadUserData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();        
        $user->setUsername("admin_cache");
        $user->setEmail("nicolas.torres@cache.cl");
        $user->setPlainPassword("admin_cache_01");
        $user->setEnabled(true);
        $user->setSuperAdmin(true);
        
        $manager->persist($user);
        
        $manager->flush();
    }
}
