<?php

namespace Parroquia\CorreoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Parroquia\CorreoBundle\Entity\Mensaje;
use Parroquia\CorreoBundle\Form\MensajeType;
use Parroquia\CorreoBundle\Form\MensajeFilterType;

/**
 * Mensaje controller.
 *
 */
class MensajeController extends Controller
{

    /**
     * Lists all Mensaje entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ParroquiaCorreoBundle:Mensaje')->findBy(array(),array('fecha_envio' => 'DESC'));
        
        return $this->render('ParroquiaCorreoBundle:Mensaje:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Mensaje entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Mensaje();

        //Emisor es la persona asociada a usuario conectado
        if($this->getUser() && $this->getUser()->getPersona())
        {
            $entity->setEmisor($this->getUser()->getPersona());
        }        
        
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            $em->persist($entity);
            $em->flush();
            
            $failures = $this->sendMessage($entity);
            
            $message = $this->container->getParameter('mail_success');        
            $this->get('session')->getFlashBag()->add('success',$message); 
            
            if(count($failures)>0)
            {
                $message = "<p>El e-mail no pudo ser enviado a las siguientes personas:</p>";
                $message .= "<ul>";
                foreach($failures as $mensaje_destinatario)
                {
                    $message .= "<li>".$mensaje_destinatario->getDestinatario()->__toString()." (".$mensaje_destinatario->getMotivo().")</li>";
                }
                $message .= "</ul>";
                
                $this->get('session')->getFlashBag()->add('warning',$message); 
            }
                    
            return $this->redirect($this->generateUrl('mensaje_show', array('id' => $entity->getId())));
        }

        $message = $this->container->getParameter('mail_error');
        $this->get('session')->getFlashBag()->add('error',$message);        
        
        return $this->render('ParroquiaCorreoBundle:Mensaje:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Mensaje entity.
    *
    * @param Mensaje $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Mensaje $entity)
    {
        $form = $this->createForm(new MensajeType(), $entity, array(
            'action' => $this->generateUrl('mensaje_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Enviar'));

        return $form;
    }

    /**
     * Displays a form to create a new Mensaje entity.
     *
     */
    public function newAction()
    {
        $entity = new Mensaje();
        $form   = $this->createCreateForm($entity);
        
        if($this->getUser() && !$this->getUser()->getPersona())
        {
            $message = $this->container->getParameter('user_persona_error');
            $this->get('session')->getFlashBag()->add('error',$message);
        }        

        return $this->render('ParroquiaCorreoBundle:Mensaje:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Mensaje entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ParroquiaCorreoBundle:Mensaje')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Mensaje entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ParroquiaCorreoBundle:Mensaje:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Deletes a Mensaje entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ParroquiaCorreoBundle:Mensaje')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Mensaje entity.');
            }

            $em->remove($entity);
            $em->flush();
            
            $message = $this->container->getParameter('message_delete');
            $this->get('session')->getFlashBag()->add('success',$message);            
        }

        return $this->redirect($this->generateUrl('mensaje'));
    }

    /**
     * Creates a form to delete a Mensaje entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('mensaje_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Borrar'))
            ->getForm()
        ;
    }
    
    
    private function sendMessage(\Parroquia\CorreoBundle\Entity\Mensaje $entity)
    {
        $em = $this->getDoctrine()->getManager();
        
        $mailer = $this->get('mailer');
        
        $failures = array();
        
        $emisor_email = $this->container->getParameter('mailer_from_address');
        $emisor_nombre = $this->container->getParameter('mailer_from_sender');
        /*if($entity->getEmisor() && $entity->getEmisor()->getEmail())
        {
            $emisor_email = $entity->getEmisor()->getEmail();
            $emisor_nombre = $entity->getEmisor()->__toString();
        }*/
        
        $cuerpo_email = $this->renderView('ParroquiaCorreoBundle:Mensaje:plantilla.html.twig', array('cuerpo' => $entity->getCuerpo()));
        
        $message = \Swift_Message::newInstance()
                    ->setSubject($entity->getAsunto())
                    ->setFrom(array($emisor_email => $emisor_nombre))
                    ->setBody($cuerpo_email,'text/html'); //Sólo se está enviando en formato html
        
        foreach($entity->getAdjuntos() as $adjunto)
        {
            if($adjunto->getPath() != 'inline')
            {
                $message->attach(\Swift_Attachment::fromPath($adjunto->getWebPath())->setFilename($adjunto->getName()));
            }
        }
                
        foreach($entity->getMensajesDestinatarios() as $mensaje_destinatario)
        {
            if($mensaje_destinatario->getDestinatario()->getEmail())
            {

                $message->setTo($mensaje_destinatario->getDestinatario()->getEmail());

                //Aqui se envía el e-mail
                if($mailer->send($message))
                {
                    $mensaje_destinatario->setEnviado(true);
                }
                else
                {
                    $mensaje_destinatario->setEnviado(false);
                    $mensaje_destinatario->setMotivo($this->container->getParameter('mail_error_envio'));
                    $failures[] = $mensaje_destinatario;
                }
            }
            else
            {
                $mensaje_destinatario->setEnviado(false);
                $mensaje_destinatario->setMotivo($this->container->getParameter('mail_error_mail'));
                $failures[] = $mensaje_destinatario;
            }
            $em->persist($mensaje_destinatario);
        }
        
        $em->flush(); 
        
        return $failures;
    }
    
    public function filterAction(Request $request)
    {
        $form = $this->createFilterForm();
        $form->handleRequest($request);
        
        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            
            $filterBuilder = $em
                ->getRepository('ParroquiaCorreoBundle:Mensaje')
                ->createQueryBuilder('m')
                ->orderBy('m.fecha_envio','DESC');     

            $this->get('lexik_form_filter.query_builder_updater')->addFilterConditions($form, $filterBuilder);

            $entities = $filterBuilder->getQuery()->getResult();

            $content = $this->renderView('ParroquiaCorreoBundle:Mensaje:list.html.twig', array(
                'entities' => $entities,
            ));
            
            return new Response($content);
        }
        else
        {
            if($request->isMethod('POST'))
            {
                $content = $this->renderView('ParroquiaCorreoBundle:Mensaje:list.html.twig', array(
                    'entities' => array(),
                ));

                return new Response($content);
            }
        }        

        return $this->render('ParroquiaCorreoBundle:Mensaje:filter.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    private function createFilterForm()
    {
        $form = $this->createForm(new MensajeFilterType(), null, array(
            'action' => $this->generateUrl('mensaje_filter'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Buscar'));

        return $form;
    }    
}
