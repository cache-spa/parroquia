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
        $menu->addChild('Correo', array('route' => 'parroquia_correo_homepage'));
        $menu->addChild('Calendario', array('route' => 'parroquia_agenda_homepage'));   
        
        $menu['Comunidad']->addChild('Personas', array('route' => 'persona'));
        $menu['Comunidad']->addChild('Grupos', array('route' => 'grupo'));
        
        $menu['Comunidad']['Personas']->addChild('Agregar Persona',array('route' => 'persona_new'));
        
        $menu['Comunidad']['Grupos']->addChild('Crear Grupo',array('route' => 'grupo_new'));
        
        $menu['Certificados']->addChild('Generar Certificado',array('route' => 'certificado_new'));
        $menu['Certificados']->addChild('Historial de Certificados',array('route' => 'certificado'));

        $menu['Calendario']->addChild('Vista de Calendario', array('route' => 'parroquia_agenda_homepage'));
        $menu['Calendario']->addChild('Agregar Evento', array('route' => 'evento_new'));
        $menu['Calendario']->addChild('Listar Eventos', array('route' => 'evento'));        
        
        /* Temporal */
        $menu['Certificados']->addChild('Bautizos',array('route' => 'bautizo'));
        $menu['Certificados']->addChild('Confirmaciones',array('route' => 'confirmacion'));
        $menu['Certificados']->addChild('Matrimonios',array('route' => 'matrimonio'));
        
        $menu['Correo']->addChild('Redactar Correo', array('route' => 'mensaje_new'));
        $menu['Correo']->addChild('Historial de Correos', array('route' => 'mensaje'));        
        
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
            
            /*** Primer nivel: Comunidad, Certificados, Correo, Calendario ***/
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
            case 'parroquia_correo_homepage':
                $menu
                    ->addChild('Correo')
                    ->setCurrent(true)                    
                ;
            break;        
            case 'parroquia_agenda_homepage':
                $menu
                    ->addChild('Calendario')
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
            /*** Certificados/Certificado ***/
            case 'certificado':
                $menu
                    ->addChild('Certificados', array('route' => 'parroquia_certificado_homepage'))
                ;
                $menu
                    ->addChild('Historial de Certificados')
                    ->setCurrent(true);
                ;                    
            break;
            case 'certificado_show':
                $menu
                    ->addChild('Certificados', array('route' => 'parroquia_certificado_homepage'))
                ;
                $menu
                    ->addChild('Ver Certificado')
                    ->setCurrent(true);
                ;                    
            break;        
            case 'certificado_new':
                $menu
                    ->addChild('Certificados', array('route' => 'parroquia_certificado_homepage'))
                ;
                $menu
                    ->addChild('Generar Certificado')
                    ->setCurrent(true);
                ;                    
            break;
            case 'certificado_filter':
                $menu
                    ->addChild('Certificados', array('route' => 'parroquia_certificado_homepage'))
                ;
                $menu
                    ->addChild('Historial de Certificados')
                    ->setCurrent(true);
                ;                    
            break;
            /*** Correo/Mensaje ***/
            case 'mensaje':
                $menu
                    ->addChild('Correo', array('route' => 'parroquia_correo_homepage'))
                ;
                $menu
                    ->addChild('Historial de Correos')
                    ->setCurrent(true);
                ;                    
            break;
            case 'mensaje_show':
                $menu
                    ->addChild('Correo', array('route' => 'parroquia_correo_homepage'))
                ;
                $menu
                    ->addChild('Ver correo enviado')
                    ->setCurrent(true);
                ;                    
            break;        
            case 'mensaje_new':
                $menu
                    ->addChild('Correo', array('route' => 'parroquia_correo_homepage'))
                ;
                $menu
                    ->addChild('Redactar Correo')
                    ->setCurrent(true);
                ;                    
            break;        
            /*** Calendario/Evento ***/
            case 'evento':
                $menu
                    ->addChild('Calendario', array('route' => 'parroquia_agenda_homepage'))
                ;
                $menu
                    ->addChild('Eventos')
                    ->setCurrent(true);
                ;                    
            break;
            case 'evento_show':
                $menu
                    ->addChild('Calendario', array('route' => 'parroquia_agenda_homepage'))
                ;
                $menu
                    ->addChild('Ver Evento')
                    ->setCurrent(true);
                ;                    
            break;        
            case 'evento_new':
                $menu
                    ->addChild('Calendario', array('route' => 'parroquia_agenda_homepage'))
                ;
                $menu
                    ->addChild('Nuevo Evento')
                    ->setCurrent(true);
                ;                    
            break;
            case 'evento_edit':
                $menu
                    ->addChild('Calendario', array('route' => 'parroquia_agenda_homepage'))
                ;
                $menu
                    ->addChild('Editar Evento')
                    ->setCurrent(true);
                ;                    
            break;        
        }

        $menu->setChildrenAttribute('class', 'breadcrumb');
        return $menu;
    }
    
}
