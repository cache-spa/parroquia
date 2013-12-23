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
        $user->setEmail("cache@cache.cl");
        $user->setPlainPassword("admin_cache_01");
        $user->setEnabled(true);
        $user->setAdmin(true);
        $user->setSuperAdmin(true);
        
        $manager->persist($user);
        
        $user2 = new User();        
        $user2->setUsername("admin_parroquia");
        $user2->setEmail("parroquia@cache.cl");
        $user2->setPlainPassword("admin_parroquia_01");
        $user2->setEnabled(true);
        $user2->setAdmin(true);
        $user2->setSuperAdmin(true);
        
        $manager->persist($user2);
        
        
        $manager->flush();
    }
}
