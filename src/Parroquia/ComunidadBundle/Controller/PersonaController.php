<?php

namespace Parroquia\ComunidadBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Parroquia\ComunidadBundle\Entity\Persona;
use Parroquia\ComunidadBundle\Form\PersonaType;

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

        $form->add('submit', 'submit', array('label' => 'Create'));

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

        $form->add('submit', 'submit', array('label' => 'Update'));

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

        $originalCategorias = array();

        foreach ($entity->getCategorias() as $categoria) {
            $originalCategorias[] = $categoria;
        }
        
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);
        
        if ($editForm->isValid()) {

            foreach ($editForm->get('categorias')->getData() as $categoria) {
                foreach ($originalCategorias as $key => $toDel) {
                    if ($toDel->getId() === $categoria->getId()) {
                        unset($originalCategorias[$key]);
                    }
                }
            }
            
            foreach ($originalCategorias as $categoria)
            {            
                $categorias_personas = $entity->getCategoriasPersonas()->filter(
                        function($entry) use ($categoria) {
                            return $entry->getCategoria() == $categoria;
                         });

                foreach($categorias_personas as $categoria_persona)
                {
                    $entity->removeCategoriasPersona($categoria_persona);
                    $em->remove($categoria_persona);
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
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
