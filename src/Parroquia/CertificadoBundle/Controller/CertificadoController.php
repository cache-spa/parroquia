<?php

namespace Parroquia\CertificadoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Parroquia\CertificadoBundle\Entity\Certificado;
use Parroquia\CertificadoBundle\Form\CertificadoType;
use Parroquia\CertificadoBundle\Form\CertificadoFilterType;

/**
 * Certificado controller.
 *
 */
class CertificadoController extends Controller
{

    /**
     * Lists all Certificado entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $entities = $em->getRepository('ParroquiaCertificadoBundle:Certificado')->findAll(array(),array('fecha_emision' => 'DESC'));

        return $this->render('ParroquiaCertificadoBundle:Certificado:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Certificado entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Certificado();
        
        $fechaemision = new \DateTime();
        $filename = 'certificado'.sha1(uniqid(mt_rand(), true)).'.pdf'; //uso interno

        $entity->setName('certificado '.date_format($fechaemision,'Y-m-d His'));  
        $entity->setFechaEmision($fechaemision);        
        $entity->setPath($filename);
        
        //Asignación de emisor. Debe ser el usuario en línea.
        if($this->getUser() && $this->getUser()->getPersona())
        {
            $entity->setEmisor($this->getUser()->getPersona());
        }
        
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);        
        
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $tipo = $entity->getTipo();
            $persona =$entity->getPersona();
            if($request->query->get('matrimonio-id'))
            {
                $matrimonio_id = $request->query->get('matrimonio-id');
            }
            
            if($tipo == 'Bautizo')
            {
                $html = $this->renderView('ParroquiaCertificadoBundle:Bautizo:certificado.html.twig', array(
                    'entity'      => $persona->getBautizo(),
                    'fecha_emision' => $entity->getFechaEmision()
                    ));
            }
            elseif($tipo == 'Confirmación')
            {
                $html = $this->renderView('ParroquiaCertificadoBundle:Confirmacion:certificado.html.twig', array(
                        'entity'      => $persona->getConfirmacion(),
                        'fecha_emision' => $entity->getFechaEmision()
                    ));
            }
            elseif($tipo == 'Matrimonio')
            {
                if($persona->getMatrimonios()->count() > 1)
                {
                    foreach($persona->getMatrimonios() as $matrimonio)
                    {
                        if(isset($matrimonio_id) && $matrimonio->getId() == $matrimonio_id)
                        {
                            $html = $this->renderView('ParroquiaCertificadoBundle:Matrimonio:certificado.html.twig', array(
                                'entity'      => $matrimonio,
                                'fecha_emision' => $entity->getFechaEmision()                                
                            ));
                        }
                    }
                }
                elseif($persona->getMatrimonios()->count() == 1)
                {
                    $matrimonio = $persona->getMatrimonios()->first();
                    
                    $html = $this->renderView('ParroquiaCertificadoBundle:Matrimonio:certificado.html.twig', array(
                        'entity'      => $matrimonio,
                        'fecha_emision' => $entity->getFechaEmision()
                    ));                    
                }
            }
            
            if(isset($html))
            {
                $this->get('knp_snappy.pdf')->generateFromHtml($html,$entity->getAbsolutePath(),array('page-size' => 'letter'));

                $em->persist($entity);
                $em->flush();

                $message = $this->container->getParameter('certificado_success');        
                $this->get('session')->getFlashBag()->add('success',$message);            

                return $this->redirect($this->generateUrl('certificado_show', array('id' => $entity->getId())));               
            }
        }

        $message = $this->container->getParameter('certificado_error');
        $this->get('session')->getFlashBag()->add('error',$message);
        
        return $this->render('ParroquiaCertificadoBundle:Certificado:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Certificado entity.
    *
    * @param Certificado $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Certificado $entity)
    {
        $form = $this->createForm(new CertificadoType(), $entity, array(
            'action' => $this->generateUrl('certificado_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Generar Certificado'));

        return $form;
    }

    /**
     * Displays a form to create a new Certificado entity.
     *
     */
    public function newAction()
    {
        $entity = new Certificado();
        $form   = $this->createCreateForm($entity);

        return $this->render('ParroquiaCertificadoBundle:Certificado:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Certificado entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ParroquiaCertificadoBundle:Certificado')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Certificado entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ParroquiaCertificadoBundle:Certificado:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Deletes a Certificado entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ParroquiaCertificadoBundle:Certificado')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Certificado entity.');
            }

            $em->remove($entity);
            $em->flush();
            
            $message = $this->container->getParameter('message_delete');
            $this->get('session')->getFlashBag()->add('success',$message);            
        }

        return $this->redirect($this->generateUrl('certificado'));
    }

    /**
     * Creates a form to delete a Certificado entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('certificado_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar'))
            ->getForm()
        ;
    }
    
    /**
     * Retorna valores del sacramento asociado a la persona seleccionada, vía ajax
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ajaxAction(Request $request){
        
        $tipo = $request->query->get('tipo');
        $persona_id = $request->query->get('persona_id');        
        
        $em = $this->getDoctrine()->getManager();

        $persona = $em->getRepository('ParroquiaComunidadBundle:Persona')->find($persona_id);

        if (!$persona) {
            return $this->render('ParroquiaCertificadoBundle:Certificado:error.html.twig');
        }
        else
        {
            if($tipo == 'Bautizo')
            {
                if($persona->getBautizo())
                {
                    return $this->render('ParroquiaCertificadoBundle:Bautizo:show_content.html.twig', array(
                        'entity'      => $persona->getBautizo(),
                        ));                    
                }
            }
            elseif($tipo == 'Confirmación')
            {
                if($persona->getConfirmacion())
                {
                    return $this->render('ParroquiaCertificadoBundle:Confirmacion:show_content.html.twig', array(
                            'entity'      => $persona->getConfirmacion(),
                        ));                    
                }
            }
            elseif($tipo == 'Matrimonio')
            {
                if($persona->getMatrimonios()->count() > 0)
                {
                    $content = '';
                    
                    foreach($persona->getMatrimonios() as $matrimonio)
                    {
                        $content .= '<div id="matrimonio-'.$matrimonio->getId().'" class="matrimonio">';
                        $content .= $this->renderView('ParroquiaCertificadoBundle:Matrimonio:show_content.html.twig', array(
                                                'entity'      => $matrimonio,
                                            ));
                        if($persona->getMatrimonios()->count() > 1)
                        {
                            $content .= '<input type="button" value="Seleccionar" class="button_seleccionar" onclick="seleccionarMatrimonio('.$matrimonio->getId().')" />';   
                        }
                        
                        $content .= '</div>';
                        $content .= '<div class="separador"></div>';
                    }
                    
                    return new Response($content);                    
                }                
            }
            
            return $this->render('ParroquiaCertificadoBundle:Certificado:error.html.twig', array(
                    'persona' => $persona,
                    'tipo' => $tipo
                ));
        }
        
        return $this->render('ParroquiaCertificadoBundle:Certificado:error.html.twig');
    }
    
    public function filterAction(Request $request)
    {
        $form = $this->createFilterForm();
        $form->handleRequest($request);
        
        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            
            $filterBuilder = $em
                ->getRepository('ParroquiaCertificadoBundle:Certificado')
                ->createQueryBuilder('c')
                ->orderBy('c.fecha_emision','DESC');     

            $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form, $filterBuilder);

            $entities = $filterBuilder->getQuery()->getResult();

            $content = $this->renderView('ParroquiaCertificadoBundle:Certificado:list.html.twig', array(
                'entities' => $entities,
            ));
            
            return new Response($content);
        }
        else
        {
            if($request->isMethod('POST'))
            {
                $content = $this->renderView('ParroquiaCertificadoBundle:Certificado:list.html.twig', array(
                    'entities' => array(),
                ));

                return new Response($content);
            }
        }

        return $this->render('ParroquiaCertificadoBundle:Certificado:filter.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    private function createFilterForm()
    {
        $form = $this->createForm(new CertificadoFilterType(), null, array(
            'action' => $this->generateUrl('certificado_filter'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Buscar'));

        return $form;
    }    
    
}
