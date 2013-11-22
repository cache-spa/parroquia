<?php

namespace Parroquia\CertificadoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Parroquia\CertificadoBundle\Entity\Confirmacion;
use Parroquia\CertificadoBundle\Form\ConfirmacionType;

/**
 * Confirmacion controller.
 *
 */
class ConfirmacionController extends Controller
{

    /**
     * Lists all Confirmacion entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ParroquiaCertificadoBundle:Confirmacion')->findAll();

        return $this->render('ParroquiaCertificadoBundle:Confirmacion:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Confirmacion entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Confirmacion();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            
            $message = $this->container->getParameter('message_success');        
            $this->get('session')->getFlashBag()->add('success',$message);            

            return $this->redirect($this->generateUrl('confirmacion_show', array('id' => $entity->getId())));
        }

        $message = $this->container->getParameter('message_error');
        $this->get('session')->getFlashBag()->add('error',$message);        
        
        return $this->render('ParroquiaCertificadoBundle:Confirmacion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Confirmacion entity.
    *
    * @param Confirmacion $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Confirmacion $entity)
    {
        $form = $this->createForm(new ConfirmacionType(), $entity, array(
            'action' => $this->generateUrl('confirmacion_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear'));

        return $form;
    }

    /**
     * Displays a form to create a new Confirmacion entity.
     *
     */
    public function newAction()
    {
        $entity = new Confirmacion();
        $form   = $this->createCreateForm($entity);

        return $this->render('ParroquiaCertificadoBundle:Confirmacion:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Confirmacion entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ParroquiaCertificadoBundle:Confirmacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Confirmacion entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ParroquiaCertificadoBundle:Confirmacion:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Confirmacion entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ParroquiaCertificadoBundle:Confirmacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Confirmacion entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ParroquiaCertificadoBundle:Confirmacion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Confirmacion entity.
    *
    * @param Confirmacion $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Confirmacion $entity)
    {
        $form = $this->createForm(new ConfirmacionType(), $entity, array(
            'action' => $this->generateUrl('confirmacion_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar'));

        return $form;
    }
    /**
     * Edits an existing Confirmacion entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ParroquiaCertificadoBundle:Confirmacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Confirmacion entity.');
        }

        $originalPadrinos = array();
        $originalCelebrantes = array();
        $originalCatequistas = array();
        
        foreach ($entity->getConfirmacionesPadrinos() as $padrino) {
            $originalPadrinos[] = $padrino;
        }
        foreach ($entity->getConfirmacionesCelebrantes() as $celebrante) {
            $originalCelebrantes[] = $celebrante;
        }        
        foreach ($entity->getConfirmacionesCatequistas() as $catequista) {
            $originalCatequistas[] = $catequista;
        }        
        
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            foreach ($entity->getConfirmacionesPadrinos() as $padrino) {
                foreach ($originalPadrinos as $key => $toDel) {
                    if ($toDel->getId() === $padrino->getId()) {
                        unset($originalPadrinos[$key]);
                    }
                }
            }
            
            foreach ($originalPadrinos as $padrino) {
                $em->remove($padrino);
            }                        
            
            
            foreach ($entity->getConfirmacionesCelebrantes() as $celebrante) {
                foreach ($originalCelebrantes as $key => $toDel) {
                    if ($toDel->getId() === $celebrante->getId()) {
                        unset($originalCelebrantes[$key]);
                    }
                }
            }
            
            foreach ($originalCelebrantes as $celebrante) {
                $em->remove($celebrante);
            }            

            
            foreach ($entity->getConfirmacionesCatequistas() as $catequista) {
                foreach ($originalCatequistas as $key => $toDel) {
                    if ($toDel->getId() === $catequista->getId()) {
                        unset($originalCatequistas[$key]);
                    }
                }
            }
            
            foreach ($originalCatequistas as $catequista) {
                $em->remove($catequista);
            }            
            
            
            $em->persist($entity);
            $em->flush();
            
            $message = $this->container->getParameter('message_success');        
            $this->get('session')->getFlashBag()->add('success',$message);            

            return $this->redirect($this->generateUrl('confirmacion_show', array('id' => $id)));
        }

        $message = $this->container->getParameter('message_error');
        $this->get('session')->getFlashBag()->add('error',$message);        
        
        return $this->render('ParroquiaCertificadoBundle:Confirmacion:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Confirmacion entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ParroquiaCertificadoBundle:Confirmacion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Confirmacion entity.');
            }

            $em->remove($entity);
            $em->flush();
            
            $message = $this->container->getParameter('message_delete');
            $this->get('session')->getFlashBag()->add('success',$message);            
        }

        return $this->redirect($this->generateUrl('confirmacion'));
    }

    /**
     * Creates a form to delete a Confirmacion entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('confirmacion_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar'))
            ->getForm()
        ;
    }
}
