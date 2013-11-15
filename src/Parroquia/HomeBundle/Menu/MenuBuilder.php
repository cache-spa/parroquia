<?php

namespace Parroquia\HomeBundle\Menu;

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

        $menu = $this->factory->createItem('Home',array('route' => 'parroquia_home_homepage'));
        
        $menu->addChild('Comunidad', array('route' => 'parroquia_comunidad_homepage'));
        $menu->addChild('Certificados', array('route' => 'parroquia_certificado_homepage'));
        $menu->addChild('Correo', array('uri' => '#'));
        $menu->addChild('Calendario', array('uri' => '#'));   
        
        $menu['Comunidad']->addChild('Personas', array('route' => 'persona'));
        $menu['Comunidad']->addChild('Grupos', array('route' => 'grupo'));
        
        $menu['Comunidad']['Personas']->addChild('Agregar Persona',array('route' => 'persona_new'));
        
        $menu['Comunidad']['Grupos']->addChild('Crear Grupo',array('route' => 'grupo_new'));
        
        $menu['Certificados']->addChild('Generar Certificado',array('uri' => '#'));
        $menu['Certificados']->addChild('Historial de Certificados',array('uri' => '#'));        
        
        /* Temporal */
        $menu['Certificados']->addChild('Bautizos',array('route' => 'bautizo'));
        $menu['Certificados']->addChild('Confirmaciones',array('route' => 'confirmacion'));
        $menu['Certificados']->addChild('Matrimonios',array('route' => 'matrimonio'));
        
        $menu->setChildrenAttribute('id', 'main-menu');
        
        return $menu;
    }
    
    public function createUserMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');
        
        $menu->addChild('Administración de Usuarios', array(
                                'uri' => '#'
            ));
        $menu->addChild('Cerrar Sesión', array(
                                'uri' => '#'
            ));
        
        $menu->setChildrenAttribute('id', 'user-menu');
                
        return $menu;
    }
    
    public function createBreadcrumbMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Home', array('route' => 'parroquia_home_homepage'));

        switch($request->get('_route')){
            
            /*** Primer nivel: Comunidad, Certificados ***/
            case 'parroquia_comunidad_homepage':
                $menu
                    ->addChild('Comunidad')
                    ->setCurrent(true)                    
                ;
            break;
            case 'parroquia_certificado_homepage':
                $menu
                    ->addChild('Certificados')
                    ->setCurrent(true)                    
                ;
            break;        
        
            /*** Comunidad/Personas ***/
            case 'persona':
                $menu
                    ->addChild('Comunidad', array('route' => 'parroquia_comunidad_homepage'))
                ;
                $menu
                    ->addChild('Personas')
                    ->setCurrent(true)
                ;
            break;
            case 'persona_show':
                $menu
                    ->addChild('Comunidad', array('route' => 'parroquia_comunidad_homepage'))
                ;
                $menu
                    ->addChild('Personas', array('route' => 'persona'))
                ;
                $menu
                    ->addChild('Ver Persona')
                    ->setCurrent(true)
                ;                
            break;
            case 'persona_new':
                $menu
                    ->addChild('Comunidad', array('route' => 'parroquia_comunidad_homepage'))
                ;
                $menu
                    ->addChild('Personas', array('route' => 'persona'))
                ;
                $menu
                    ->addChild('Nueva Persona')
                    ->setCurrent(true)
                ;                    
            break;
            case 'persona_edit':
                $menu
                    ->addChild('Comunidad', array('route' => 'parroquia_comunidad_homepage'))
                ;
                $menu
                    ->addChild('Personas', array('route' => 'persona'))
                ;
                $menu
                    ->addChild('Editar Persona')
                    ->setCurrent(true)
                ;                    
            break;
            /*** Comunidad/Grupos ***/
            case 'grupo':
                $menu
                    ->addChild('Comunidad', array('route' => 'parroquia_comunidad_homepage'))
                ;
                $menu
                    ->addChild('Grupos')
                    ->setCurrent(true)
                ;
            break;
            case 'grupo_show':
                $menu
                    ->addChild('Comunidad', array('route' => 'parroquia_comunidad_homepage'))
                ;
                $menu
                    ->addChild('Grupos', array('route' => 'grupo'))
                ;
                $menu
                    ->addChild('Ver Grupo')
                    ->setCurrent(true)
                ;                
            break;
            case 'grupo_new':
                $menu
                    ->addChild('Comunidad', array('route' => 'parroquia_comunidad_homepage'))
                ;
                $menu
                    ->addChild('Grupos', array('route' => 'grupo'))
                ;
                $menu
                    ->addChild('Nueva Grupo')
                    ->setCurrent(true)
                ;                    
            break;
            case 'grupo_edit':
                $menu
                    ->addChild('Comunidad', array('route' => 'parroquia_comunidad_homepage'))
                ;
                $menu
                    ->addChild('Grupos', array('route' => 'grupo'))
                ;
                $menu
                    ->addChild('Editar Grupo')
                    ->setCurrent(true)
                ;                    
            break;
        }

        $menu->setChildrenAttribute('class', 'breadcrumb');
        return $menu;
    }
    
}
