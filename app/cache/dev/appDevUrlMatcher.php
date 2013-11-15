<?php

use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\RequestContext;

/**
 * appDevUrlMatcher
 *
 * This class has been auto-generated
 * by the Symfony Routing Component.
 */
class appDevUrlMatcher extends Symfony\Bundle\FrameworkBundle\Routing\RedirectableUrlMatcher
{
    /**
     * Constructor.
     */
    public function __construct(RequestContext $context)
    {
        $this->context = $context;
    }

    public function match($pathinfo)
    {
        $allow = array();
        $pathinfo = rawurldecode($pathinfo);

        if (0 === strpos($pathinfo, '/js/jquery')) {
            // _assetic_jquery
            if ($pathinfo === '/js/jquery.js') {
                return array (  '_controller' => 'assetic.controller:render',  'name' => 'jquery',  'pos' => NULL,  '_format' => 'js',  '_route' => '_assetic_jquery',);
            }

            // _assetic_jquery_0
            if ($pathinfo === '/js/jquery_jquery-1.9.1_1.js') {
                return array (  '_controller' => 'assetic.controller:render',  'name' => 'jquery',  'pos' => 0,  '_format' => 'js',  '_route' => '_assetic_jquery_0',);
            }

        }

        if (0 === strpos($pathinfo, '/_')) {
            // _wdt
            if (0 === strpos($pathinfo, '/_wdt') && preg_match('#^/_wdt/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                return $this->mergeDefaults(array_replace($matches, array('_route' => '_wdt')), array (  '_controller' => 'web_profiler.controller.profiler:toolbarAction',));
            }

            if (0 === strpos($pathinfo, '/_profiler')) {
                // _profiler_home
                if (rtrim($pathinfo, '/') === '/_profiler') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_profiler_home');
                    }

                    return array (  '_controller' => 'web_profiler.controller.profiler:homeAction',  '_route' => '_profiler_home',);
                }

                if (0 === strpos($pathinfo, '/_profiler/search')) {
                    // _profiler_search
                    if ($pathinfo === '/_profiler/search') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchAction',  '_route' => '_profiler_search',);
                    }

                    // _profiler_search_bar
                    if ($pathinfo === '/_profiler/search_bar') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:searchBarAction',  '_route' => '_profiler_search_bar',);
                    }

                }

                // _profiler_purge
                if ($pathinfo === '/_profiler/purge') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:purgeAction',  '_route' => '_profiler_purge',);
                }

                if (0 === strpos($pathinfo, '/_profiler/i')) {
                    // _profiler_info
                    if (0 === strpos($pathinfo, '/_profiler/info') && preg_match('#^/_profiler/info/(?P<about>[^/]++)$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_info')), array (  '_controller' => 'web_profiler.controller.profiler:infoAction',));
                    }

                    // _profiler_import
                    if ($pathinfo === '/_profiler/import') {
                        return array (  '_controller' => 'web_profiler.controller.profiler:importAction',  '_route' => '_profiler_import',);
                    }

                }

                // _profiler_export
                if (0 === strpos($pathinfo, '/_profiler/export') && preg_match('#^/_profiler/export/(?P<token>[^/\\.]++)\\.txt$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_export')), array (  '_controller' => 'web_profiler.controller.profiler:exportAction',));
                }

                // _profiler_phpinfo
                if ($pathinfo === '/_profiler/phpinfo') {
                    return array (  '_controller' => 'web_profiler.controller.profiler:phpinfoAction',  '_route' => '_profiler_phpinfo',);
                }

                // _profiler_search_results
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/search/results$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_search_results')), array (  '_controller' => 'web_profiler.controller.profiler:searchResultsAction',));
                }

                // _profiler
                if (preg_match('#^/_profiler/(?P<token>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler')), array (  '_controller' => 'web_profiler.controller.profiler:panelAction',));
                }

                // _profiler_router
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/router$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_router')), array (  '_controller' => 'web_profiler.controller.router:panelAction',));
                }

                // _profiler_exception
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception')), array (  '_controller' => 'web_profiler.controller.exception:showAction',));
                }

                // _profiler_exception_css
                if (preg_match('#^/_profiler/(?P<token>[^/]++)/exception\\.css$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_profiler_exception_css')), array (  '_controller' => 'web_profiler.controller.exception:cssAction',));
                }

            }

            if (0 === strpos($pathinfo, '/_configurator')) {
                // _configurator_home
                if (rtrim($pathinfo, '/') === '/_configurator') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_configurator_home');
                    }

                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::checkAction',  '_route' => '_configurator_home',);
                }

                // _configurator_step
                if (0 === strpos($pathinfo, '/_configurator/step') && preg_match('#^/_configurator/step/(?P<index>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_configurator_step')), array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::stepAction',));
                }

                // _configurator_final
                if ($pathinfo === '/_configurator/final') {
                    return array (  '_controller' => 'Sensio\\Bundle\\DistributionBundle\\Controller\\ConfiguratorController::finalAction',  '_route' => '_configurator_final',);
                }

            }

        }

        // parroquia_home_homepage
        if (rtrim($pathinfo, '/') === '') {
            if (substr($pathinfo, -1) !== '/') {
                return $this->redirect($pathinfo.'/', 'parroquia_home_homepage');
            }

            return array (  '_controller' => 'Parroquia\\HomeBundle\\Controller\\DefaultController::indexAction',  '_route' => 'parroquia_home_homepage',);
        }

        // parroquia_agenda_homepage
        if (0 === strpos($pathinfo, '/agenda/hello') && preg_match('#^/agenda/hello/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
            return $this->mergeDefaults(array_replace($matches, array('_route' => 'parroquia_agenda_homepage')), array (  '_controller' => 'Parroquia\\AgendaBundle\\Controller\\DefaultController::indexAction',));
        }

        if (0 === strpos($pathinfo, '/c')) {
            if (0 === strpos($pathinfo, '/certificados')) {
                // parroquia_certificado_homepage
                if (rtrim($pathinfo, '/') === '/certificados') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'parroquia_certificado_homepage');
                    }

                    return array (  '_controller' => 'Parroquia\\CertificadoBundle\\Controller\\DefaultController::indexAction',  '_route' => 'parroquia_certificado_homepage',);
                }

                // parroquia_certificado_test
                if ($pathinfo === '/certificados/test') {
                    return array (  '_controller' => 'Parroquia\\CertificadoBundle\\Controller\\DefaultController::testAction',  '_route' => 'parroquia_certificado_test',);
                }

                if (0 === strpos($pathinfo, '/certificados/bautizo')) {
                    // bautizo
                    if (rtrim($pathinfo, '/') === '/certificados/bautizo') {
                        if (substr($pathinfo, -1) !== '/') {
                            return $this->redirect($pathinfo.'/', 'bautizo');
                        }

                        return array (  '_controller' => 'Parroquia\\CertificadoBundle\\Controller\\BautizoController::indexAction',  '_route' => 'bautizo',);
                    }

                    // bautizo_show
                    if (preg_match('#^/certificados/bautizo/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'bautizo_show')), array (  '_controller' => 'Parroquia\\CertificadoBundle\\Controller\\BautizoController::showAction',));
                    }

                    // bautizo_new
                    if ($pathinfo === '/certificados/bautizo/new') {
                        return array (  '_controller' => 'Parroquia\\CertificadoBundle\\Controller\\BautizoController::newAction',  '_route' => 'bautizo_new',);
                    }

                    // bautizo_create
                    if ($pathinfo === '/certificados/bautizo/create') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_bautizo_create;
                        }

                        return array (  '_controller' => 'Parroquia\\CertificadoBundle\\Controller\\BautizoController::createAction',  '_route' => 'bautizo_create',);
                    }
                    not_bautizo_create:

                    // bautizo_edit
                    if (preg_match('#^/certificados/bautizo/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'bautizo_edit')), array (  '_controller' => 'Parroquia\\CertificadoBundle\\Controller\\BautizoController::editAction',));
                    }

                    // bautizo_update
                    if (preg_match('#^/certificados/bautizo/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                            $allow = array_merge($allow, array('POST', 'PUT'));
                            goto not_bautizo_update;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'bautizo_update')), array (  '_controller' => 'Parroquia\\CertificadoBundle\\Controller\\BautizoController::updateAction',));
                    }
                    not_bautizo_update:

                    // bautizo_delete
                    if (preg_match('#^/certificados/bautizo/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('POST', 'DELETE'))) {
                            $allow = array_merge($allow, array('POST', 'DELETE'));
                            goto not_bautizo_delete;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'bautizo_delete')), array (  '_controller' => 'Parroquia\\CertificadoBundle\\Controller\\BautizoController::deleteAction',));
                    }
                    not_bautizo_delete:

                }

                if (0 === strpos($pathinfo, '/certificados/confirmacion')) {
                    // confirmacion
                    if (rtrim($pathinfo, '/') === '/certificados/confirmacion') {
                        if (substr($pathinfo, -1) !== '/') {
                            return $this->redirect($pathinfo.'/', 'confirmacion');
                        }

                        return array (  '_controller' => 'Parroquia\\CertificadoBundle\\Controller\\ConfirmacionController::indexAction',  '_route' => 'confirmacion',);
                    }

                    // confirmacion_show
                    if (preg_match('#^/certificados/confirmacion/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'confirmacion_show')), array (  '_controller' => 'Parroquia\\CertificadoBundle\\Controller\\ConfirmacionController::showAction',));
                    }

                    // confirmacion_new
                    if ($pathinfo === '/certificados/confirmacion/new') {
                        return array (  '_controller' => 'Parroquia\\CertificadoBundle\\Controller\\ConfirmacionController::newAction',  '_route' => 'confirmacion_new',);
                    }

                    // confirmacion_create
                    if ($pathinfo === '/certificados/confirmacion/create') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_confirmacion_create;
                        }

                        return array (  '_controller' => 'Parroquia\\CertificadoBundle\\Controller\\ConfirmacionController::createAction',  '_route' => 'confirmacion_create',);
                    }
                    not_confirmacion_create:

                    // confirmacion_edit
                    if (preg_match('#^/certificados/confirmacion/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'confirmacion_edit')), array (  '_controller' => 'Parroquia\\CertificadoBundle\\Controller\\ConfirmacionController::editAction',));
                    }

                    // confirmacion_update
                    if (preg_match('#^/certificados/confirmacion/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                            $allow = array_merge($allow, array('POST', 'PUT'));
                            goto not_confirmacion_update;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'confirmacion_update')), array (  '_controller' => 'Parroquia\\CertificadoBundle\\Controller\\ConfirmacionController::updateAction',));
                    }
                    not_confirmacion_update:

                    // confirmacion_delete
                    if (preg_match('#^/certificados/confirmacion/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('POST', 'DELETE'))) {
                            $allow = array_merge($allow, array('POST', 'DELETE'));
                            goto not_confirmacion_delete;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'confirmacion_delete')), array (  '_controller' => 'Parroquia\\CertificadoBundle\\Controller\\ConfirmacionController::deleteAction',));
                    }
                    not_confirmacion_delete:

                }

                if (0 === strpos($pathinfo, '/certificados/matrimonio')) {
                    // matrimonio
                    if (rtrim($pathinfo, '/') === '/certificados/matrimonio') {
                        if (substr($pathinfo, -1) !== '/') {
                            return $this->redirect($pathinfo.'/', 'matrimonio');
                        }

                        return array (  '_controller' => 'Parroquia\\CertificadoBundle\\Controller\\MatrimonioController::indexAction',  '_route' => 'matrimonio',);
                    }

                    // matrimonio_show
                    if (preg_match('#^/certificados/matrimonio/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'matrimonio_show')), array (  '_controller' => 'Parroquia\\CertificadoBundle\\Controller\\MatrimonioController::showAction',));
                    }

                    // matrimonio_new
                    if ($pathinfo === '/certificados/matrimonio/new') {
                        return array (  '_controller' => 'Parroquia\\CertificadoBundle\\Controller\\MatrimonioController::newAction',  '_route' => 'matrimonio_new',);
                    }

                    // matrimonio_create
                    if ($pathinfo === '/certificados/matrimonio/create') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_matrimonio_create;
                        }

                        return array (  '_controller' => 'Parroquia\\CertificadoBundle\\Controller\\MatrimonioController::createAction',  '_route' => 'matrimonio_create',);
                    }
                    not_matrimonio_create:

                    // matrimonio_edit
                    if (preg_match('#^/certificados/matrimonio/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'matrimonio_edit')), array (  '_controller' => 'Parroquia\\CertificadoBundle\\Controller\\MatrimonioController::editAction',));
                    }

                    // matrimonio_update
                    if (preg_match('#^/certificados/matrimonio/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                            $allow = array_merge($allow, array('POST', 'PUT'));
                            goto not_matrimonio_update;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'matrimonio_update')), array (  '_controller' => 'Parroquia\\CertificadoBundle\\Controller\\MatrimonioController::updateAction',));
                    }
                    not_matrimonio_update:

                    // matrimonio_delete
                    if (preg_match('#^/certificados/matrimonio/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('POST', 'DELETE'))) {
                            $allow = array_merge($allow, array('POST', 'DELETE'));
                            goto not_matrimonio_delete;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'matrimonio_delete')), array (  '_controller' => 'Parroquia\\CertificadoBundle\\Controller\\MatrimonioController::deleteAction',));
                    }
                    not_matrimonio_delete:

                }

            }

            if (0 === strpos($pathinfo, '/comunidad')) {
                // parroquia_comunidad_homepage
                if (rtrim($pathinfo, '/') === '/comunidad') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', 'parroquia_comunidad_homepage');
                    }

                    return array (  '_controller' => 'Parroquia\\ComunidadBundle\\Controller\\DefaultController::indexAction',  '_route' => 'parroquia_comunidad_homepage',);
                }

                if (0 === strpos($pathinfo, '/comunidad/personas')) {
                    // persona
                    if (rtrim($pathinfo, '/') === '/comunidad/personas') {
                        if (substr($pathinfo, -1) !== '/') {
                            return $this->redirect($pathinfo.'/', 'persona');
                        }

                        return array (  '_controller' => 'Parroquia\\ComunidadBundle\\Controller\\PersonaController::indexAction',  '_route' => 'persona',);
                    }

                    // persona_show
                    if (preg_match('#^/comunidad/personas/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'persona_show')), array (  '_controller' => 'Parroquia\\ComunidadBundle\\Controller\\PersonaController::showAction',));
                    }

                    // persona_new
                    if ($pathinfo === '/comunidad/personas/new') {
                        return array (  '_controller' => 'Parroquia\\ComunidadBundle\\Controller\\PersonaController::newAction',  '_route' => 'persona_new',);
                    }

                    // persona_create
                    if ($pathinfo === '/comunidad/personas/create') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_persona_create;
                        }

                        return array (  '_controller' => 'Parroquia\\ComunidadBundle\\Controller\\PersonaController::createAction',  '_route' => 'persona_create',);
                    }
                    not_persona_create:

                    // persona_edit
                    if (preg_match('#^/comunidad/personas/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'persona_edit')), array (  '_controller' => 'Parroquia\\ComunidadBundle\\Controller\\PersonaController::editAction',));
                    }

                    // persona_update
                    if (preg_match('#^/comunidad/personas/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                            $allow = array_merge($allow, array('POST', 'PUT'));
                            goto not_persona_update;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'persona_update')), array (  '_controller' => 'Parroquia\\ComunidadBundle\\Controller\\PersonaController::updateAction',));
                    }
                    not_persona_update:

                    // persona_delete
                    if (preg_match('#^/comunidad/personas/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('POST', 'DELETE'))) {
                            $allow = array_merge($allow, array('POST', 'DELETE'));
                            goto not_persona_delete;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'persona_delete')), array (  '_controller' => 'Parroquia\\ComunidadBundle\\Controller\\PersonaController::deleteAction',));
                    }
                    not_persona_delete:

                }

                if (0 === strpos($pathinfo, '/comunidad/grupos')) {
                    // grupo
                    if (rtrim($pathinfo, '/') === '/comunidad/grupos') {
                        if (substr($pathinfo, -1) !== '/') {
                            return $this->redirect($pathinfo.'/', 'grupo');
                        }

                        return array (  '_controller' => 'Parroquia\\ComunidadBundle\\Controller\\GrupoController::indexAction',  '_route' => 'grupo',);
                    }

                    // grupo_show
                    if (preg_match('#^/comunidad/grupos/(?P<id>[^/]++)/show$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'grupo_show')), array (  '_controller' => 'Parroquia\\ComunidadBundle\\Controller\\GrupoController::showAction',));
                    }

                    // grupo_new
                    if ($pathinfo === '/comunidad/grupos/new') {
                        return array (  '_controller' => 'Parroquia\\ComunidadBundle\\Controller\\GrupoController::newAction',  '_route' => 'grupo_new',);
                    }

                    // grupo_create
                    if ($pathinfo === '/comunidad/grupos/create') {
                        if ($this->context->getMethod() != 'POST') {
                            $allow[] = 'POST';
                            goto not_grupo_create;
                        }

                        return array (  '_controller' => 'Parroquia\\ComunidadBundle\\Controller\\GrupoController::createAction',  '_route' => 'grupo_create',);
                    }
                    not_grupo_create:

                    // grupo_edit
                    if (preg_match('#^/comunidad/grupos/(?P<id>[^/]++)/edit$#s', $pathinfo, $matches)) {
                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'grupo_edit')), array (  '_controller' => 'Parroquia\\ComunidadBundle\\Controller\\GrupoController::editAction',));
                    }

                    // grupo_update
                    if (preg_match('#^/comunidad/grupos/(?P<id>[^/]++)/update$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('POST', 'PUT'))) {
                            $allow = array_merge($allow, array('POST', 'PUT'));
                            goto not_grupo_update;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'grupo_update')), array (  '_controller' => 'Parroquia\\ComunidadBundle\\Controller\\GrupoController::updateAction',));
                    }
                    not_grupo_update:

                    // grupo_delete
                    if (preg_match('#^/comunidad/grupos/(?P<id>[^/]++)/delete$#s', $pathinfo, $matches)) {
                        if (!in_array($this->context->getMethod(), array('POST', 'DELETE'))) {
                            $allow = array_merge($allow, array('POST', 'DELETE'));
                            goto not_grupo_delete;
                        }

                        return $this->mergeDefaults(array_replace($matches, array('_route' => 'grupo_delete')), array (  '_controller' => 'Parroquia\\ComunidadBundle\\Controller\\GrupoController::deleteAction',));
                    }
                    not_grupo_delete:

                }

            }

        }

        if (0 === strpos($pathinfo, '/acme')) {
            // _welcome
            if (rtrim($pathinfo, '/') === '/acme') {
                if (substr($pathinfo, -1) !== '/') {
                    return $this->redirect($pathinfo.'/', '_welcome');
                }

                return array (  '_controller' => 'Acme\\DemoBundle\\Controller\\WelcomeController::indexAction',  '_route' => '_welcome',);
            }

            if (0 === strpos($pathinfo, '/acme/demo')) {
                if (0 === strpos($pathinfo, '/acme/demo/secured')) {
                    if (0 === strpos($pathinfo, '/acme/demo/secured/log')) {
                        if (0 === strpos($pathinfo, '/acme/demo/secured/login')) {
                            // _demo_login
                            if ($pathinfo === '/acme/demo/secured/login') {
                                return array (  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::loginAction',  '_route' => '_demo_login',);
                            }

                            // _security_check
                            if ($pathinfo === '/acme/demo/secured/login_check') {
                                return array (  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::securityCheckAction',  '_route' => '_security_check',);
                            }

                        }

                        // _demo_logout
                        if ($pathinfo === '/acme/demo/secured/logout') {
                            return array (  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::logoutAction',  '_route' => '_demo_logout',);
                        }

                    }

                    if (0 === strpos($pathinfo, '/acme/demo/secured/hello')) {
                        // acme_demo_secured_hello
                        if ($pathinfo === '/acme/demo/secured/hello') {
                            return array (  'name' => 'World',  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::helloAction',  '_route' => 'acme_demo_secured_hello',);
                        }

                        // _demo_secured_hello
                        if (preg_match('#^/acme/demo/secured/hello/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => '_demo_secured_hello')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::helloAction',));
                        }

                        // _demo_secured_hello_admin
                        if (0 === strpos($pathinfo, '/acme/demo/secured/hello/admin') && preg_match('#^/acme/demo/secured/hello/admin/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
                            return $this->mergeDefaults(array_replace($matches, array('_route' => '_demo_secured_hello_admin')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\SecuredController::helloadminAction',));
                        }

                    }

                }

                // _demo
                if (rtrim($pathinfo, '/') === '/acme/demo') {
                    if (substr($pathinfo, -1) !== '/') {
                        return $this->redirect($pathinfo.'/', '_demo');
                    }

                    return array (  '_controller' => 'Acme\\DemoBundle\\Controller\\DemoController::indexAction',  '_route' => '_demo',);
                }

                // _demo_hello
                if (0 === strpos($pathinfo, '/acme/demo/hello') && preg_match('#^/acme/demo/hello/(?P<name>[^/]++)$#s', $pathinfo, $matches)) {
                    return $this->mergeDefaults(array_replace($matches, array('_route' => '_demo_hello')), array (  '_controller' => 'Acme\\DemoBundle\\Controller\\DemoController::helloAction',));
                }

                // _demo_contact
                if ($pathinfo === '/acme/demo/contact') {
                    return array (  '_controller' => 'Acme\\DemoBundle\\Controller\\DemoController::contactAction',  '_route' => '_demo_contact',);
                }

            }

        }

        throw 0 < count($allow) ? new MethodNotAllowedException(array_unique($allow)) : new ResourceNotFoundException();
    }
}
