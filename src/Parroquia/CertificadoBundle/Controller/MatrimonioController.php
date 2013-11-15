<?php

namespace Parroquia\CertificadoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Parroquia\CertificadoBundle\Entity\Matrimonio;
use Parroquia\CertificadoBundle\Form\MatrimonioType;

/**
 * Matrimonio controller.
 *
 */
class MatrimonioController extends Controller
{

    /**
     * Lists all Matrimonio entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ParroquiaCertificadoBundle:Matrimonio')->findAll();

        return $this->render('ParroquiaCertificadoBundle:Matrimonio:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Matrimonio entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Matrimonio();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('matrimonio_show', array('id' => $entity->getId())));
        }

        return $this->render('ParroquiaCertificadoBundle:Matrimonio:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Matrimonio entity.
    *
    * @param Matrimonio $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Matrimonio $entity)
    {
        $form = $this->createForm(new MatrimonioType(), $entity, array(
            'action' => $this->generateUrl('matrimonio_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear'));

        return $form;
    }

    /**
     * Displays a form to create a new Matrimonio entity.
     *
     */
    public function newAction()
    {
        $entity = new Matrimonio();
        $form   = $this->createCreateForm($entity);

        return $this->render('ParroquiaCertificadoBundle:Matrimonio:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Matrimonio entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ParroquiaCertificadoBundle:Matrimonio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Matrimonio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ParroquiaCertificadoBundle:Matrimonio:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Matrimonio entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ParroquiaCertificadoBundle:Matrimonio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Matrimonio entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ParroquiaCertificadoBundle:Matrimonio:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Matrimonio entity.
    *
    * @param Matrimonio $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Matrimonio $entity)
    {
        $form = $this->createForm(new MatrimonioType(), $entity, array(
            'action' => $this->generateUrl('matrimonio_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar'));

        return $form;
    }
    /**
     * Edits an existing Matrimonio entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ParroquiaCertificadoBundle:Matrimonio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Matrimonio entity.');
        }

        $originalPadrinos = array();
        $originalCelebrantes = array();
        $originalCatequistas = array();
        $originalTestigos = array();
        
        foreach ($entity->getMatrimoniosPadrinos() as $padrino) {
            $originalPadrinos[] = $padrino;
        }
        foreach ($entity->getMatrimoniosCelebrantes() as $celebrante) {
            $originalCelebrantes[] = $celebrante;
        }        
        foreach ($entity->getMatrimoniosCatequistas() as $catequista) {
            $originalCatequistas[] = $catequista;
        }        
        foreach ($entity->getMatrimoniosTestigos() as $testigo) {
            $originalTestigos[] = $testigo;
        }
        
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            foreach ($entity->getMatrimoniosPadrinos() as $padrino) {
                foreach ($originalPadrinos as $key => $toDel) {
                    if ($toDel->getId() === $padrino->getId()) {
                        unset($originalPadrinos[$key]);
                    }
                }
            }
            
            foreach ($originalPadrinos as $padrino) {
                $em->remove($padrino);
            }                        
            
            
            foreach ($entity->getMatrimoniosCelebrantes() as $celebrante) {
                foreach ($originalCelebrantes as $key => $toDel) {
                    if ($toDel->getId() === $celebrante->getId()) {
                        unset($originalCelebrantes[$key]);
                    }
                }
            }
            
            foreach ($originalCelebrantes as $celebrante) {
                $em->remove($celebrante);
            }            

            
            foreach ($entity->getMatrimoniosCatequistas() as $catequista) {
                foreach ($originalCatequistas as $key => $toDel) {
                    if ($toDel->getId() === $catequista->getId()) {
                        unset($originalCatequistas[$key]);
                    }
                }
            }
            
            foreach ($originalCatequistas as $catequista) {
                $em->remove($catequista);
            }
            
            
            foreach ($entity->getMatrimoniosTestigos() as $testigo) {
                foreach ($originalTestigos as $key => $toDel) {
                    if ($toDel->getId() === $testigo->getId()) {
                        unset($originalTestigos[$key]);
                    }
                }
            }
            
            foreach ($originalTestigos as $testigo) {
                $em->remove($testigo);
            }            
            
            
            $em->persist($entity);
            $em->flush();
        
            return $this->redirect($this->generateUrl('matrimonio_edit', array('id' => $id)));
        }

        return $this->render('ParroquiaCertificadoBundle:Matrimonio:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Matrimonio entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ParroquiaCertificadoBundle:Matrimonio')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Matrimonio entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('matrimonio'));
    }

    /**
     * Creates a form to delete a Matrimonio entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('matrimonio_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar'))
            ->getForm()
        ;
    }
}
