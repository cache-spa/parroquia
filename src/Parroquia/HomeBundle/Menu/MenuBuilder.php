<?php

namespace Parroquia\HomeBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class MenuBuilder
{
    private $factory;
    private $security_context;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory, SecurityContext $security_context)
    {
        $this->factory = $factory;
        $this->security_context = $security_context;
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
        
        $menu['Certificados']->addChild('Bautizos',array('route' => 'bautizo'));
        $menu['Certificados']->addChild('Confirmaciones',array('route' => 'confirmacion'));
        $menu['Certificados']->addChild('Matrimonios',array('route' => 'matrimonio'));
        $menu['Certificados']->addChild('Ministros de Comunión',array('route' => 'ministro'));        
        
        $menu['Correo']->addChild('Redactar Correo', array('route' => 'mensaje_new'));
        $menu['Correo']->addChild('Historial de Correos', array('route' => 'mensaje'));        
        
        $menu->setChildrenAttribute('id', 'main-menu');
        
        
        switch($request->get('_route')){
            /*** Comunidad ***/
            case 'persona':
            case 'persona_show':        
            case 'persona_new':
            case 'persona_create':
            case 'grupo':
            case 'grupo_show':        
            case 'grupo_new':
            case 'grupo_create':                
                $menu['Comunidad']->setCurrent(true);      
            break;
        
            /*** Certificados***/
            case 'certificado':
            case 'certificado_show':        
            case 'certificado_new':
            case 'certificado_create':
            case 'bautizo':
            case 'bautizo_show':        
            case 'bautizo_new':
            case 'bautizo_create':
            case 'confirmacion':
            case 'confirmacion_show':        
            case 'confirmacion_new':
            case 'confirmacion_create':
            case 'matrimonio':
            case 'matrimonio_show':        
            case 'matrimonio_new':
            case 'matrimonio_create':
            case 'ministro':
            case 'ministro_show':
            case 'ministro_new':
            case 'ministro_create':
                $menu['Certificados']->setCurrent(true);      
            break;        
            
            /*** Correo ***/
            case 'mensaje':
            case 'mensaje_show':        
            case 'mensaje_new':
            case 'mensaje_create':
                $menu['Correo']->setCurrent(true);      
            break;
        
            /*** Calendario ***/
            case 'evento':
            case 'evento_show':        
            case 'evento_new':
            case 'evento_create':
                $menu['Calendario']->setCurrent(true);      
            break;        
        }        
        
        return $menu;
    }
    
    public function createUserMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');
        
        if($this->security_context->isGranted(array('ROLE_ADMIN'))) {
            $menu->addChild('Admin_Usuarios', array(
                                'route' => 'user',
                                'label' => 'Administración de Usuarios'
            ));
            
            $menu['Admin_Usuarios']->addChild('Lista de Usuarios', array('route' => 'user'));
            $menu['Admin_Usuarios']->addChild('Agregar Usuario', array('route' => 'user_new'));            
        }        
        
        if($this->security_context->isGranted(array('ROLE_ADMIN', 'ROLE_USER'))) {
            $username = $this->security_context->getToken()->getUser()->getUsername();
            $menu->addChild('Usuario', array(            
                                'route' => 'fos_user_profile_show',
                                'label' => $username
            ));
            
            $menu['Usuario']->addChild('Ver Perfil', array('route' => 'fos_user_profile_show'));
            $menu['Usuario']->addChild('Editar Perfil', array('route' => 'fos_user_profile_edit'));
            $menu['Usuario']->addChild('Cambiar contraseña', array('route' => 'fos_user_change_password'));
        }
        
        $menu->addChild('Cerrar Sesión', array(
                                'route' => 'fos_user_security_logout'
            ));
        
        $menu->setChildrenAttribute('id', 'user-menu');
                
        return $menu;
    }
    
    public function createBreadcrumbMenu(Request $request)
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Home', array('route' => 'parroquia_home_homepage'));

        switch($request->get('_route')){
            
            /*** FOS_USER ***/
            case 'fos_user_profile_show':
                $menu                    
                    ->addChild('Ver Perfil')
                    ->setCurrent(true)                    
                ;
            break;
            case 'fos_user_profile_edit':
                $menu
                    ->addChild('Editar Perfil')
                    ->setCurrent(true)                    
                ;
            break;
            case 'fos_user_change_password':
                $menu
                    ->addChild('Cambiar contraseña')
                    ->setCurrent(true)                    
                ;
            break;
        
            /*** Administración ***/
            case 'user':
                $menu                    
                    ->addChild('Lista de Usuarios')
                    ->setCurrent(true)                    
                ;
            break;
            case 'user_show':
                $menu                    
                    ->addChild('Ver Usuario')
                    ->setCurrent(true)                    
                ;
            break;
            case 'user_new':
            case 'user_create':
                $menu                    
                    ->addChild('Nuevo Usuario')
                    ->setCurrent(true)                    
                ;
            break;
            case 'user_edit':
                $menu                    
                    ->addChild('Editar Usuario')
                    ->setCurrent(true)                    
                ;
            break;        
        
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
            case 'persona_filter':
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
            case 'persona_create':
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
            case 'grupo_create':
                $menu
                    ->addChild('Comunidad', array('route' => 'parroquia_comunidad_homepage'))
                ;
                $menu
                    ->addChild('Grupos', array('route' => 'grupo'))
                ;
                $menu
                    ->addChild('Nuevo Grupo')
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
            case 'certificado_filter':
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
            case 'certificado_create':
                $menu
                    ->addChild('Certificados', array('route' => 'parroquia_certificado_homepage'))
                ;
                $menu
                    ->addChild('Generar Certificado')
                    ->setCurrent(true);
                ;                    
            break;
            /*** Certificados/Ministros ***/
            case 'ministro':
            case 'ministro_filter':
                $menu
                    ->addChild('Certificados', array('route' => 'parroquia_certificado_homepage'))
                ;
                $menu
                    ->addChild('Ministros de Comunión')
                    ->setCurrent(true);
                ;                    
            break;
            case 'ministro_show':
                $menu
                    ->addChild('Certificados', array('route' => 'parroquia_certificado_homepage'))
                ;
                $menu
                    ->addChild('Ministros de Comunión', array('route' => 'ministro'));                
                $menu
                    ->addChild('Ver Ministro de Comunión')
                    ->setCurrent(true);
                ;                    
            break;        
            case 'ministro_new':
            case 'ministro_create':
                $menu
                    ->addChild('Certificados', array('route' => 'parroquia_certificado_homepage'))
                ;
                $menu
                    ->addChild('Ministros de Comunión', array('route' => 'ministro'));                 
                $menu
                    ->addChild('Nuevo Ministro de Comunión')
                    ->setCurrent(true);
                ;                    
            break;
            case 'ministro_edit':
                $menu
                    ->addChild('Certificados', array('route' => 'parroquia_certificado_homepage'))
                ;
                $menu
                    ->addChild('Ministros de Comunión', array('route' => 'ministro'));                 
                $menu
                    ->addChild('Editar Ministro de Comunión')
                    ->setCurrent(true);
                ;                    
            break;
            /*** Certificados/Bautizos ***/
            case 'bautizo':
                $menu
                    ->addChild('Certificados', array('route' => 'parroquia_certificado_homepage'))
                ;
                $menu
                    ->addChild('Bautizos')
                    ->setCurrent(true);
                ;                    
            break;
            case 'bautizo_show':
                $menu
                    ->addChild('Certificados', array('route' => 'parroquia_certificado_homepage'))
                ;
                $menu
                    ->addChild('Bautizos', array('route' => 'bautizo'));                
                $menu
                    ->addChild('Ver Bautizo')
                    ->setCurrent(true);
                ;                    
            break;        
            case 'bautizo_new':
            case 'bautizo_create':
                $menu
                    ->addChild('Certificados', array('route' => 'parroquia_certificado_homepage'))
                ;
                $menu
                    ->addChild('Bautizos', array('route' => 'bautizo'));                 
                $menu
                    ->addChild('Nuevo Bautizo')
                    ->setCurrent(true);
                ;                    
            break;
            case 'bautizo_edit':
                $menu
                    ->addChild('Certificados', array('route' => 'parroquia_certificado_homepage'))
                ;
                $menu
                    ->addChild('Bautizos', array('route' => 'bautizo'));                 
                $menu
                    ->addChild('Editar Bautizo')
                    ->setCurrent(true);
                ;                    
            break;
            /*** Certificados/Confirmaciones ***/
            case 'confirmacion':
                $menu
                    ->addChild('Certificados', array('route' => 'parroquia_certificado_homepage'))
                ;
                $menu
                    ->addChild('Confirmaciones')
                    ->setCurrent(true);
                ;                    
            break;
            case 'confirmacion_show':
                $menu
                    ->addChild('Certificados', array('route' => 'parroquia_certificado_homepage'))
                ;
                $menu
                    ->addChild('Confirmaciones', array('route' => 'confirmacion'));                
                $menu
                    ->addChild('Ver Confirmación')
                    ->setCurrent(true);
                ;                    
            break;        
            case 'confirmacion_new':
            case 'confirmacion_create':
                $menu
                    ->addChild('Certificados', array('route' => 'parroquia_certificado_homepage'))
                ;
                $menu
                    ->addChild('Confirmaciones', array('route' => 'confirmacion'));                 
                $menu
                    ->addChild('Nueva Confirmación')
                    ->setCurrent(true);
                ;                    
            break;
            case 'confirmacion_edit':
                $menu
                    ->addChild('Certificados', array('route' => 'parroquia_certificado_homepage'))
                ;
                $menu
                    ->addChild('Confirmaciones', array('route' => 'confirmacion'));                 
                $menu
                    ->addChild('Editar Confirmación')
                    ->setCurrent(true);
                ;                    
            break;        
            /*** Certificados/Matrimonios ***/
            case 'matrimonio':
                $menu
                    ->addChild('Certificados', array('route' => 'parroquia_certificado_homepage'))
                ;
                $menu
                    ->addChild('Matrimonios')
                    ->setCurrent(true);
                ;                    
            break;
            case 'matrimonio_show':
                $menu
                    ->addChild('Certificados', array('route' => 'parroquia_certificado_homepage'))
                ;
                $menu
                    ->addChild('Matrimonios', array('route' => 'matrimonio'));                
                $menu
                    ->addChild('Ver Matrimonio')
                    ->setCurrent(true);
                ;                    
            break;        
            case 'matrimonio_new':
            case 'matrimonio_create':
                $menu
                    ->addChild('Certificados', array('route' => 'parroquia_certificado_homepage'))
                ;
                $menu
                    ->addChild('Matrimonios', array('route' => 'matrimonio'));                 
                $menu
                    ->addChild('Nuevo Matrimonio')
                    ->setCurrent(true);
                ;                    
            break;
            case 'matrimonio_edit':
                $menu
                    ->addChild('Certificados', array('route' => 'parroquia_certificado_homepage'))
                ;
                $menu
                    ->addChild('Matrimonios', array('route' => 'matrimonio'));                 
                $menu
                    ->addChild('Editar Matrimonio')
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
            case 'mensaje_create':
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
            case 'evento_create':
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
