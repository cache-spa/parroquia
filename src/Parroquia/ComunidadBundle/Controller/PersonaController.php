<?php

namespace Parroquia\ComunidadBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Parroquia\ComunidadBundle\Entity\Persona;
use Parroquia\ComunidadBundle\Form\PersonaType;
use Parroquia\ComunidadBundle\Form\PersonaFilterType;

/**
 * Persona controller.
 *
 */
class PersonaController extends Controller
{

    /**
     * Lists all Persona entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ParroquiaComunidadBundle:Persona')->findAll();
       
        return $this->render('ParroquiaComunidadBundle:Persona:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Persona entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Persona();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('persona_show', array('id' => $entity->getId())));
        }

        return $this->render('ParroquiaComunidadBundle:Persona:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Persona entity.
    *
    * @param Persona $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Persona $entity)
    {
        $form = $this->createForm(new PersonaType(), $entity, array(
            'action' => $this->generateUrl('persona_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear'));

        return $form;
    }

    /**
     * Displays a form to create a new Persona entity.
     *
     */
    public function newAction()
    {
        $entity = new Persona();
        $form   = $this->createCreateForm($entity);

        return $this->render('ParroquiaComunidadBundle:Persona:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Persona entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ParroquiaComunidadBundle:Persona')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Persona entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ParroquiaComunidadBundle:Persona:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Persona entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ParroquiaComunidadBundle:Persona')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Persona entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ParroquiaComunidadBundle:Persona:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Persona entity.
    *
    * @param Persona $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Persona $entity)
    {
        $form = $this->createForm(new PersonaType(), $entity, array(
            'action' => $this->generateUrl('persona_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar'));

        return $form;
    }
    /**
     * Edits an existing Persona entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ParroquiaComunidadBundle:Persona')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Persona entity.');
        }

        $originalGrupos = array();

        foreach ($entity->getGrupos() as $grupo) {
            $originalGrupos[] = $grupo;
        }
        
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        
        if ($editForm->isValid()) {

            foreach ($editForm->get('grupos')->getData() as $grupo) {
                foreach ($originalGrupos as $key => $toDel) {
                    if ($toDel->getId() === $grupo->getId()) {
                        unset($originalGrupos[$key]);
                    }
                }
            }
            
            foreach ($originalGrupos as $grupo)
            {            
                $grupos_personas = $entity->getGruposPersonas()->filter(
                        function($entry) use ($grupo) {
                            return $entry->getGrupo() == $grupo;
                         });

                foreach($grupos_personas as $grupo_persona)
                {
                    $entity->removeGruposPersona($grupo_persona);
                    $em->remove($grupo_persona);
                }               
            }
            
            $em->flush();

            return $this->redirect($this->generateUrl('persona_edit', array('id' => $id)));
        }

        return $this->render('ParroquiaComunidadBundle:Persona:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Persona entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ParroquiaComunidadBundle:Persona')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Persona entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('persona'));
    }

    /**
     * Creates a form to delete a Persona entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('persona_delete', array('id' => $id)))
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
                ->getRepository('ParroquiaComunidadBundle:Persona')
                ->createQueryBuilder('p');

            $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form, $filterBuilder);

            $entities = $filterBuilder->getQuery()->getResult();
       
            return $this->render('ParroquiaComunidadBundle:Persona:index.html.twig', array(
                'entities' => $entities,
            ));
        }

        return $this->render('ParroquiaComunidadBundle:Persona:filter.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    private function createFilterForm()
    {
        $form = $this->createForm(new PersonaFilterType(), null, array(
            'action' => $this->generateUrl('persona_filter'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Buscar'));

        return $form;
    }    
}
