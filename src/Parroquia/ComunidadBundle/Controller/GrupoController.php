<?php

namespace Parroquia\ComunidadBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Parroquia\ComunidadBundle\Entity\Grupo;
use Parroquia\ComunidadBundle\Form\GrupoType;
use Parroquia\ComunidadBundle\Form\GrupoFilterType;

/**
 * Grupo controller.
 *
 */
class GrupoController extends Controller
{

    /**
     * Lists all Grupo entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ParroquiaComunidadBundle:Grupo')->findAll();

        return $this->render('ParroquiaComunidadBundle:Grupo:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Grupo entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Grupo();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $message = $this->container->getParameter('message_success');        
            $this->get('session')->getFlashBag()->add('success',$message);            
            
            return $this->redirect($this->generateUrl('grupo_show', array('id' => $entity->getId())));
        }

        $message = $this->container->getParameter('message_error');
        $this->get('session')->getFlashBag()->add('error',$message);        
        
        return $this->render('ParroquiaComunidadBundle:Grupo:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Grupo entity.
    *
    * @param Grupo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Grupo $entity)
    {
        $form = $this->createForm(new GrupoType(), $entity, array(
            'action' => $this->generateUrl('grupo_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear'));

        return $form;
    }

    /**
     * Displays a form to create a new Grupo entity.
     *
     */
    public function newAction()
    {
        $entity = new Grupo();
        $form   = $this->createCreateForm($entity);

        return $this->render('ParroquiaComunidadBundle:Grupo:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Grupo entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ParroquiaComunidadBundle:Grupo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Grupo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ParroquiaComunidadBundle:Grupo:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Grupo entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ParroquiaComunidadBundle:Grupo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Grupo entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ParroquiaComunidadBundle:Grupo:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Grupo entity.
    *
    * @param Grupo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Grupo $entity)
    {
        $form = $this->createForm(new GrupoType(), $entity, array(
            'action' => $this->generateUrl('grupo_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar'));

        return $form;
    }
    /**
     * Edits an existing Grupo entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ParroquiaComunidadBundle:Grupo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Grupo entity.');
        }

        $originalPersonas = array();

        foreach ($entity->getPersonas() as $persona) {
            $originalPersonas[] = $persona;
        }        
        
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            
            foreach ($editForm->get('personas')->getData() as $persona) {
                foreach ($originalPersonas as $key => $toDel) {
                    if ($toDel->getId() === $persona->getId()) {
                        unset($originalPersonas[$key]);
                    }
                }
            }
            
            foreach ($originalPersonas as $persona)
            {            
                $grupos_personas = $entity->getGruposPersonas()->filter(
                        function($entry) use ($persona) {
                            return $entry->getPersona() == $persona;
                         });

                foreach($grupos_personas as $grupo_persona)
                {
                    $entity->removeGruposPersona($grupo_persona);
                    $em->remove($grupo_persona);
                }               
            }
            
            $em->flush();
            
            $message = $this->container->getParameter('message_success');        
            $this->get('session')->getFlashBag()->add('success',$message);            

            return $this->redirect($this->generateUrl('grupo_show', array('id' => $id)));
        }

        $message = $this->container->getParameter('message_error');
        $this->get('session')->getFlashBag()->add('error',$message);
        
        return $this->render('ParroquiaComunidadBundle:Grupo:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Grupo entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ParroquiaComunidadBundle:Grupo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Grupo entity.');
            }

            $em->remove($entity);
            $em->flush();
            
            $message = $this->container->getParameter('message_delete');
            $this->get('session')->getFlashBag()->add('success',$message);            
        }

        return $this->redirect($this->generateUrl('grupo'));
    }

    /**
     * Creates a form to delete a Grupo entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('grupo_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar'))
            ->getForm()
        ;
    }
    
    public function filterAction(Request $request)
    {
        $form = $this->createFilterForm();
        $form->handleRequest($request);
        
        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            
            $filterBuilder = $em
                ->getRepository('ParroquiaComunidadBundle:Grupo')
                ->createQueryBuilder('g');     

            $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form, $filterBuilder);

            $entities = $filterBuilder->getQuery()->getResult();
       
            return $this->render('ParroquiaComunidadBundle:Grupo:index.html.twig', array(
                'entities' => $entities,
            ));
        }

        return $this->render('ParroquiaComunidadBundle:Grupo:filter.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    private function createFilterForm()
    {
        $form = $this->createForm(new GrupoFilterType(), null, array(
            'action' => $this->generateUrl('grupo_filter'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Buscar'));

        return $form;
    }        
}
