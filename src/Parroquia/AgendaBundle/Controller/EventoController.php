<?php

namespace Parroquia\AgendaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

use Parroquia\AgendaBundle\Entity\Evento;
use Parroquia\AgendaBundle\Form\EventoType;

/**
 * Evento controller.
 *
 */
class EventoController extends Controller
{

    /**
     * Lists all Evento entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ParroquiaAgendaBundle:Evento')->findAll();

        return $this->render('ParroquiaAgendaBundle:Evento:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Evento entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Evento();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            
            $message = $this->container->getParameter('message_success');        
            $this->get('session')->getFlashBag()->add('success',$message);               

            return $this->redirect($this->generateUrl('evento_show', array('id' => $entity->getId())));
        }

        $message = $this->container->getParameter('message_error');
        $this->get('session')->getFlashBag()->add('error',$message);        
        
        return $this->render('ParroquiaAgendaBundle:Evento:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Evento entity.
    *
    * @param Evento $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Evento $entity)
    {
        $form = $this->createForm(new EventoType(), $entity, array(
            'action' => $this->generateUrl('evento_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear'));

        return $form;
    }

    /**
     * Displays a form to create a new Evento entity.
     *
     */
    public function newAction()
    {
        $entity = new Evento();
        $form   = $this->createCreateForm($entity);

        return $this->render('ParroquiaAgendaBundle:Evento:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Evento entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ParroquiaAgendaBundle:Evento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Evento entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ParroquiaAgendaBundle:Evento:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Evento entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ParroquiaAgendaBundle:Evento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Evento entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ParroquiaAgendaBundle:Evento:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Evento entity.
    *
    * @param Evento $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Evento $entity)
    {
        $form = $this->createForm(new EventoType(), $entity, array(
            'action' => $this->generateUrl('evento_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar'));

        return $form;
    }
    /**
     * Edits an existing Evento entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ParroquiaAgendaBundle:Evento')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Evento entity.');
        }

        $originalArchivos = array();
        $originalImagenes = array();

        foreach ($entity->getArchivos() as $archivo) {
            $originalArchivos[] = $archivo;
        }
        
        foreach ($entity->getImagenes() as $imagen) {
            $originalImagenes[] = $imagen;
        }        
        
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            
            foreach ($entity->getArchivos() as $archivo) {
                foreach ($originalArchivos as $key => $toDel) {
                    if ($toDel->getId() === $archivo->getId()) {
                        unset($originalArchivos[$key]);
                    }
                }
            }
            
            foreach ($originalArchivos as $archivo) {
                $em->remove($archivo);
            }
            
            
            
            foreach ($entity->getImagenes() as $imagen) {
                foreach ($originalImagenes as $key => $toDel) {
                    if ($toDel->getId() === $imagen->getId()) {
                        unset($originalImagenes[$key]);
                    }
                }
            }
            
            foreach ($originalImagenes as $imagen) {
                $em->remove($imagen);
            }            
            
            $em->flush();
            
            $message = $this->container->getParameter('message_success');        
            $this->get('session')->getFlashBag()->add('success',$message);            

            return $this->redirect($this->generateUrl('evento_show', array('id' => $id)));
        }
        
        $message = $this->container->getParameter('message_error');
        $this->get('session')->getFlashBag()->add('error',$message);        

        return $this->render('ParroquiaAgendaBundle:Evento:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Evento entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ParroquiaAgendaBundle:Evento')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Evento entity.');
            }

            $em->remove($entity);
            $em->flush();
            
            $message = $this->container->getParameter('message_delete');
            $this->get('session')->getFlashBag()->add('success',$message);            
        }

        return $this->redirect($this->generateUrl('evento'));
    }

    /**
     * Creates a form to delete a Evento entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('evento_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar'))
            ->getForm()
        ;
    }
    
    /**
     * Actualiza los valores del evento modificado en el calendario, vía ajax
     * 
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ajaxUpdateAction(Request $request){
        
        $id = $request->request->get('id');
        $day_delta = $request->request->get('dayDelta');
        $minute_delta = $request->request->get('minuteDelta');
        $all_day = ($request->request->get('allDay') === 'true');
        $type = $request->request->get('type');

        $em = $this->getDoctrine()->getManager();

        $evento = $em->getRepository('ParroquiaAgendaBundle:Evento')->find($id);

        if (!$evento)
        {
            $response = new JsonResponse(null,500); //Error
            return $response;
        }
        else
        {
            if($type == 'drop')
            {
                $evento->setTodoElDia($all_day);
                
                $fecha_inicio = $evento->getInicio();
                $fecha_inicio->modify($day_delta.' day');
                $fecha_inicio->modify($minute_delta.' minute');
                $evento->setInicio($fecha_inicio);
            }   
            
            if($type == 'drop' || $type == 'resize')
            {
                $fecha_termino = $evento->getTermino();
                $fecha_termino->modify($day_delta.' day');
                $fecha_termino->modify($minute_delta.' minute');
                $evento->setTermino($fecha_termino);                
            }
            
            $em->persist($evento);
            $em->flush();
            
            $response = new JsonResponse(null,200); //Ok
            return $response;
            
        }
    }

    /**
     * Crea un evento desde el calendario, vía ajax
     * 
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function ajaxCreateAction(Request $request){
        
        $title = $request->request->get('title');
        $start = \DateTime::createFromFormat('Y-m-d H:i:s',$request->request->get('start'));
        $end = \DateTime::createFromFormat('Y-m-d H:i:s',$request->request->get('end'));
        $all_day = ($request->request->get('allDay') === 'true');

        $em = $this->getDoctrine()->getManager();

        $evento = new Evento();
        $evento->setNombre($title);
        $evento->setInicio($start);
        $evento->setTermino($end);
        $evento->setTodoElDia($all_day);
        $evento->setLiturgico(false);

        $em->persist($evento);
        $em->flush();         

        $response = new JsonResponse(array('id' => $evento->getId(),'color' => '#'.$evento->getColor(),'url' => $this->generateUrl('evento_edit', array('id' => $evento->getId()))),200); //Ok
        return $response;
   }
}
