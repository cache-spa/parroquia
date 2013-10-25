<?php

namespace Parroquia\ComunidadBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class MenuBuilder
{
    private $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Home', array(
                                'route' => 'parroquia_comunidad_homepage',
                                'routeParameters' => array('name' => 'hola')
            ));
        // ... add more children

        return $menu;
    }
}
