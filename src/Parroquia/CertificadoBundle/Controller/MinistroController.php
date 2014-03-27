<?php

namespace Parroquia\CertificadoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Parroquia\CertificadoBundle\Entity\Ministro;
use Parroquia\CertificadoBundle\Form\MinistroType;
use Parroquia\CertificadoBundle\Form\MinistroFilterType;

/**
 * Ministro controller.
 *
 */
class MinistroController extends Controller
{

    /**
     * Lists all Ministro entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ParroquiaCertificadoBundle:Ministro')->findAll(
                array(),array('fecha_vigencia_termino' => 'DESC')
            );

        return $this->render('ParroquiaCertificadoBundle:Ministro:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Ministro entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Ministro();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            
            $message = $this->container->getParameter('message_success');        
            $this->get('session')->getFlashBag()->add('success',$message);                        

            return $this->redirect($this->generateUrl('ministro_show', array('id' => $entity->getId())));
        }
        
        $message = $this->container->getParameter('message_error');
        $this->get('session')->getFlashBag()->add('error',$message);         

        return $this->render('ParroquiaCertificadoBundle:Ministro:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Ministro entity.
    *
    * @param Ministro $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Ministro $entity)
    {
        $form = $this->createForm(new MinistroType(), $entity, array(
            'action' => $this->generateUrl('ministro_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear'));

        return $form;
    }

    /**
     * Displays a form to create a new Ministro entity.
     *
     */
    public function newAction()
    {
        $entity = new Ministro();
        $form   = $this->createCreateForm($entity);

        return $this->render('ParroquiaCertificadoBundle:Ministro:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Ministro entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ParroquiaCertificadoBundle:Ministro')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ministro entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ParroquiaCertificadoBundle:Ministro:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Ministro entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ParroquiaCertificadoBundle:Ministro')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ministro entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ParroquiaCertificadoBundle:Ministro:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Ministro entity.
    *
    * @param Ministro $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Ministro $entity)
    {
        $form = $this->createForm(new MinistroType(), $entity, array(
            'action' => $this->generateUrl('ministro_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar'));

        return $form;
    }
    /**
     * Edits an existing Ministro entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ParroquiaCertificadoBundle:Ministro')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ministro entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            $message = $this->container->getParameter('message_success');        
            $this->get('session')->getFlashBag()->add('success',$message);                
            
            return $this->redirect($this->generateUrl('ministro_show', array('id' => $id)));
        }

        $message = $this->container->getParameter('message_error');
        $this->get('session')->getFlashBag()->add('error',$message);         
        
        return $this->render('ParroquiaCertificadoBundle:Ministro:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Ministro entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ParroquiaCertificadoBundle:Ministro')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Ministro entity.');
            }

            $em->remove($entity);
            $em->flush();
            
            $message = $this->container->getParameter('message_delete');
            $this->get('session')->getFlashBag()->add('success',$message);             
        }

        return $this->redirect($this->generateUrl('ministro'));
    }

    /**
     * Creates a form to delete a Ministro entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ministro_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar'))
            ->getForm()
        ;
    }
    
    /**
     * Download a Ministro certificate.
     *
     */
    public function downloadAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ParroquiaCertificadoBundle:Ministro')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Ministro entity.');
        }

        $fecha_emision = new \DateTime();
        
        $html = $this->renderView('ParroquiaCertificadoBundle:Ministro:certificado.html.twig', 
                        array('entity' => $entity, 'fecha_emision' => $fecha_emision));

        return new Response(
            $this->get('knp_snappy.pdf')->getOutputFromHtml($html, array('page-size' => 'letter')),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'filename="certificado ministro comunión.pdf"'
            )
        );
    }
    
    public function filterAction(Request $request)
    {
        $form = $this->createFilterForm();
        $form->handleRequest($request);
        
        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            
            $filterBuilder = $em
                ->getRepository('ParroquiaCertificadoBundle:Ministro')
                ->createQueryBuilder('m')
                ->orderBy('m.fecha_vigencia_termino','DESC');     

            $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form, $filterBuilder);

            $entities = $filterBuilder->getQuery()->getResult();

            $content = $this->renderView('ParroquiaCertificadoBundle:Ministro:list.html.twig', array(
                'entities' => $entities,
            ));
            
            return new Response($content);
        }
        else
        {
            if($request->isMethod('POST'))
            {
                $content = $this->renderView('ParroquiaCertificadoBundle:Ministro:list.html.twig', array(
                    'entities' => array(),
                ));

                return new Response($content);
            }
        }
        

        return $this->render('ParroquiaCertificadoBundle:Ministro:filter.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    private function createFilterForm()
    {
        $form = $this->createForm(new MinistroFilterType(), null, array(
            'action' => $this->generateUrl('ministro_filter'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Buscar'));

        return $form;
    }      
}
