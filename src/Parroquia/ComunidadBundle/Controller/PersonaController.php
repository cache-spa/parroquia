<?php

namespace Parroquia\ComunidadBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

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
            
            $message = $this->container->getParameter('message_success');        
            $this->get('session')->getFlashBag()->add('success',$message);            

            return $this->redirect($this->generateUrl('persona_show', array('id' => $entity->getId())));
        }
        
        $message = $this->container->getParameter('message_error');
        $this->get('session')->getFlashBag()->add('error',$message);        

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
        
        /**** Sacramentos ****/
        $sacramentos = array('bautizo','confirmacion','matrimonios');
        foreach($sacramentos as $sacramento)
        {
            $originalPadrinos[$sacramento] = array();
            $originalCelebrantes[$sacramento] = array();
            $originalCatequistas[$sacramento] = array();
            $originalTestigos[$sacramento] = array();
        }
        $originalMatrimonios = array();        
        
        /**** Bautizo ****/        
        if($entity->getBautizo())
        {
            $sacramento = $entity->getBautizo();
            foreach ($sacramento->getBautizosPadrinos() as $padrino) {
                $originalPadrinos['bautizo'][] = $padrino;
            }
            foreach ($sacramento->getBautizosCelebrantes() as $celebrante) {
                $originalCelebrantes['bautizo'][] = $celebrante;
            }        
            foreach ($sacramento->getBautizosCatequistas() as $catequista) {
                $originalCatequistas['bautizo'][] = $catequista;
            }            
        }        
        
        /**** Confirmación ****/        
        if($entity->getConfirmacion())
        {
            $sacramento = $entity->getConfirmacion();
            foreach ($sacramento->getConfirmacionesPadrinos() as $padrino) {
                $originalPadrinos['confirmacion'][] = $padrino;
            }
            foreach ($sacramento->getConfirmacionesCelebrantes() as $celebrante) {
                $originalCelebrantes['confirmacion'][] = $celebrante;
            }        
            foreach ($sacramento->getConfirmacionesCatequistas() as $catequista) {
                $originalCatequistas['confirmacion'][] = $catequista;
            }            
        }
        
        /**** Matrimonios ****/        
        if($entity->getMatrimonios())
        {
            foreach($entity->getMatrimonios() as $sacramento) {
                foreach ($sacramento->getMatrimoniosPadrinos() as $padrino) {
                    $originalPadrinos['matrimonios'][] = $padrino;
                }
                foreach ($sacramento->getMatrimoniosCelebrantes() as $celebrante) {
                    $originalCelebrantes['matrimonios'][] = $celebrante;
                }        
                foreach ($sacramento->getMatrimoniosCatequistas() as $catequista) {
                    $originalCatequistas['matrimonios'][] = $catequista;
                }            
                foreach ($sacramento->getMatrimoniosTestigos() as $testigo) {
                    $originalTestigos['matrimonios'][] = $testigo;
                }    
                $originalMatrimonios[] = $sacramento;                
            }
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
            
            
            /**** Bautizo ****/
            if($entity->getBautizo())
            { 
                $sacramento = $entity->getBautizo();

                foreach ($sacramento->getBautizosPadrinos() as $padrino) {
                    foreach ($originalPadrinos['bautizo'] as $key => $toDel) {
                        if ($toDel->getId() === $padrino->getId()) {
                            unset($originalPadrinos['bautizo'][$key]);
                        }
                    }
                }

                foreach ($originalPadrinos['bautizo'] as $padrino) {
                    $em->remove($padrino);
                }                        


                foreach ($sacramento->getBautizosCelebrantes() as $celebrante) {
                    foreach ($originalCelebrantes['bautizo'] as $key => $toDel) {
                        if ($toDel->getId() === $celebrante->getId()) {
                            unset($originalCelebrantes['bautizo'][$key]);
                        }
                    }
                }

                foreach ($originalCelebrantes['bautizo'] as $celebrante) {
                    $em->remove($celebrante);
                }            


                foreach ($sacramento->getBautizosCatequistas() as $catequista) {
                    foreach ($originalCatequistas['bautizo'] as $key => $toDel) {
                        if ($toDel->getId() === $catequista->getId()) {
                            unset($originalCatequistas['bautizo'][$key]);
                        }
                    }
                }

                foreach ($originalCatequistas['bautizo'] as $catequista) {
                    $em->remove($catequista);
                }            
            }
            
            
            /**** Confirmación ****/
            if($entity->getConfirmacion())
            { 
                $sacramento = $entity->getConfirmacion();

                foreach ($sacramento->getConfirmacionesPadrinos() as $padrino) {
                    foreach ($originalPadrinos['confirmacion'] as $key => $toDel) {
                        if ($toDel->getId() === $padrino->getId()) {
                            unset($originalPadrinos['confirmacion'][$key]);
                        }
                    }
                }

                foreach ($originalPadrinos['confirmacion'] as $padrino) {
                    $em->remove($padrino);
                }                        


                foreach ($sacramento->getConfirmacionesCelebrantes() as $celebrante) {
                    foreach ($originalCelebrantes['confirmacion'] as $key => $toDel) {
                        if ($toDel->getId() === $celebrante->getId()) {
                            unset($originalCelebrantes['confirmacion'][$key]);
                        }
                    }
                }

                foreach ($originalCelebrantes['confirmacion'] as $celebrante) {
                    $em->remove($celebrante);
                }            


                foreach ($sacramento->getConfirmacionesCatequistas() as $catequista) {
                    foreach ($originalCatequistas['confirmacion'] as $key => $toDel) {
                        if ($toDel->getId() === $catequista->getId()) {
                            unset($originalCatequistas['confirmacion'][$key]);
                        }
                    }
                }

                foreach ($originalCatequistas['confirmacion'] as $catequista) {
                    $em->remove($catequista);
                }            
            }            
                      
            
            /**** Matrimonios ****/
            if($entity->getMatrimonios())
            { 
                foreach($entity->getMatrimonios() as $sacramento)
                {
                    foreach ($sacramento->getMatrimoniosPadrinos() as $padrino) {
                        foreach ($originalPadrinos['matrimonios'] as $key => $toDel) {
                            if ($toDel->getId() === $padrino->getId()) {
                                unset($originalPadrinos['matrimonios'][$key]);
                            }
                        }
                    }

                    foreach ($originalPadrinos['matrimonios'] as $padrino) {
                        $em->remove($padrino);
                    }                        


                    foreach ($sacramento->getMatrimoniosCelebrantes() as $celebrante) {
                        foreach ($originalCelebrantes['matrimonios'] as $key => $toDel) {
                            if ($toDel->getId() === $celebrante->getId()) {
                                unset($originalCelebrantes['matrimonios'][$key]);
                            }
                        }
                    }

                    foreach ($originalCelebrantes['matrimonios'] as $celebrante) {
                        $em->remove($celebrante);
                    }            


                    foreach ($sacramento->getMatrimoniosCatequistas() as $catequista) {
                        foreach ($originalCatequistas['matrimonios'] as $key => $toDel) {
                            if ($toDel->getId() === $catequista->getId()) {
                                unset($originalCatequistas['matrimonios'][$key]);
                            }
                        }
                    }

                    foreach ($originalCatequistas['matrimonios'] as $catequista) {
                        $em->remove($catequista);
                    }
                    
                    
                    foreach ($sacramento->getMatrimoniosTestigos() as $testigo) {
                        foreach ($originalTestigos['matrimonios'] as $key => $toDel) {
                            if ($toDel->getId() === $testigo->getId()) {
                                unset($originalTestigos['matrimonios'][$key]);
                            }
                        }
                    }

                    foreach ($originalTestigos['matrimonios'] as $testigo) {
                        $em->remove($testigo);
                    } 
                }
            }            

            foreach ($editForm->get('matrimonios')->getData() as $matrimonio) {
                foreach ($originalMatrimonios as $key => $toDel) {
                    if ($toDel->getId() === $matrimonio->getId()) {
                        unset($originalMatrimonios[$key]);
                    }
                }
            }            
            
            foreach ($originalMatrimonios as $matrimonio) {
                if($entity == $matrimonio->getConyuge1())
                {
                    $matrimonio->setConyuge1(null);
                    $em->persist($matrimonio);

                }
                if($entity == $matrimonio->getConyuge2())
                {
                    $matrimonio->setConyuge2(null);
                    $em->persist($matrimonio);
                }               
            }            
            
            $em->persist($entity);
            $em->flush();

            $message = $this->container->getParameter('message_success');        
            $this->get('session')->getFlashBag()->add('success',$message);
            
            return $this->redirect($this->generateUrl('persona_show', array('id' => $id)));
        }

        $message = $this->container->getParameter('message_error');
        $this->get('session')->getFlashBag()->add('error',$message);
        
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

            $message = $this->container->getParameter('message_delete');
            $this->get('session')->getFlashBag()->add('success',$message);
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
       
            $content = $this->renderView('ParroquiaComunidadBundle:Persona:list.html.twig', array(
                'entities' => $entities,
            ));
            
            return new Response($content);
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
    
    /**
     * Remove a foro of a Persona entity.
     *
     */
    public function removefotoAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('ParroquiaComunidadBundle:Persona')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Persona entity.');
        }

        $entity->removeUpload();
        $entity->setPath(null);
        $em->persist($entity);
        $em->flush();

        $message = $this->container->getParameter('message_delete');
        $this->get('session')->getFlashBag()->add('success',$message);

        return $this->redirect($this->generateUrl('persona_edit', array('id' => $id)));
    }        
    
}
