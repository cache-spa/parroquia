<?php

namespace Parroquia\CertificadoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Parroquia\CertificadoBundle\Entity\Bautizo;
use Parroquia\CertificadoBundle\Form\BautizoType;

/**
 * Bautizo controller.
 *
 */
class BautizoController extends Controller
{

    /**
     * Lists all Bautizo entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ParroquiaCertificadoBundle:Bautizo')->findAll();

        return $this->render('ParroquiaCertificadoBundle:Bautizo:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Bautizo entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Bautizo();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('bautizo_show', array('id' => $entity->getId())));
        }

        return $this->render('ParroquiaCertificadoBundle:Bautizo:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Bautizo entity.
    *
    * @param Bautizo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Bautizo $entity)
    {
        $form = $this->createForm(new BautizoType(), $entity, array(
            'action' => $this->generateUrl('bautizo_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear'));

        return $form;
    }

    /**
     * Displays a form to create a new Bautizo entity.
     *
     */
    public function newAction()
    {
        $entity = new Bautizo();
        $form   = $this->createCreateForm($entity);

        return $this->render('ParroquiaCertificadoBundle:Bautizo:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Bautizo entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ParroquiaCertificadoBundle:Bautizo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bautizo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ParroquiaCertificadoBundle:Bautizo:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Bautizo entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ParroquiaCertificadoBundle:Bautizo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bautizo entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ParroquiaCertificadoBundle:Bautizo:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Bautizo entity.
    *
    * @param Bautizo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Bautizo $entity)
    {
        $form = $this->createForm(new BautizoType(), $entity, array(
            'action' => $this->generateUrl('bautizo_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar'));

        return $form;
    }
    /**
     * Edits an existing Bautizo entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ParroquiaCertificadoBundle:Bautizo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Bautizo entity.');
        }

        $originalPadrinos = array();
        $originalCelebrantes = array();
        $originalCatequistas = array();
        
        foreach ($entity->getBautizosPadrinos() as $padrino) {
            $originalPadrinos[] = $padrino;
        }
        foreach ($entity->getBautizosCelebrantes() as $celebrante) {
            $originalCelebrantes[] = $celebrante;
        }        
        foreach ($entity->getBautizosCatequistas() as $catequista) {
            $originalCatequistas[] = $catequista;
        }        
        
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            foreach ($entity->getBautizosPadrinos() as $padrino) {
                foreach ($originalPadrinos as $key => $toDel) {
                    if ($toDel->getId() === $padrino->getId()) {
                        unset($originalPadrinos[$key]);
                    }
                }
            }
            
            foreach ($originalPadrinos as $padrino) {
                $em->remove($padrino);
            }                        
            
            
            foreach ($entity->getBautizosCelebrantes() as $celebrante) {
                foreach ($originalCelebrantes as $key => $toDel) {
                    if ($toDel->getId() === $celebrante->getId()) {
                        unset($originalCelebrantes[$key]);
                    }
                }
            }
            
            foreach ($originalCelebrantes as $celebrante) {
                $em->remove($celebrante);
            }            

            
            foreach ($entity->getBautizosCatequistas() as $catequista) {
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

            return $this->redirect($this->generateUrl('bautizo_edit', array('id' => $id)));
        }

        return $this->render('ParroquiaCertificadoBundle:Bautizo:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Bautizo entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ParroquiaCertificadoBundle:Bautizo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Bautizo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('bautizo'));
    }

    /**
     * Creates a form to delete a Bautizo entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('bautizo_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar'))
            ->getForm()
        ;
    }
}
