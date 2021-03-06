<?php

namespace Parroquia\CertificadoBundle\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\EntityRepository;

class AddConfirmadoFieldSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        // Tells the dispatcher that you want to listen on the form.pre_set_data
        // event and that the preSetData method should be called.
        return array(FormEvents::PRE_SET_DATA => 'preSetData');
    }

    public function preSetData(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        if ($form->isRoot()) {
            $form->add('persona',null,array('label' => 'Confirmado', 
                'class' => 'ParroquiaComunidadBundle:Persona',
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('p')
                        ->orderBy('p.apellido_p', 'ASC')
                        ->addOrderBy('p.apellido_m', 'ASC')                                    
                        ->addOrderBy('p.nombres', 'ASC');
                },                
                'property' => 'nombreRut')); 
        }
    }
}
