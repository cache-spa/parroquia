<?php

namespace Parroquia\ComunidadBundle\Form\EventListener;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\EntityRepository;

class AddPadreFieldSubscriber implements EventSubscriberInterface
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

        // check if the grupo object is "new"
        // If you didn't pass any data to the form, the data is "null".
        // This should be considered a new "Grupo"
        if (!$data || !$data->getId()) {
            $formOptions = array(
                'class' => 'Parroquia\ComunidadBundle\Entity\Grupo',                
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('g')
                            ->orderBy('g.nombre','ASC');
                    },
                'label' => 'Categoría Padre',
                'required' => false,
            );

            $form->add('padre', 'entity', $formOptions); 
        }
        else
        {
            $formOptions = array(
                'class' => 'Parroquia\ComunidadBundle\Entity\Grupo',                
                'query_builder' => function(EntityRepository $er) use ($data) {
                    return $er->createQueryBuilder('g')
                            ->orderBy('g.nombre','ASC')
                            ->where('g.id != :id')
                            ->setParameter('id', $data->getId());
                    },
                'label' => 'Categoría Padre',
                'required' => false
            );

            $form->add('padre', 'entity', $formOptions);            

        }
    }
}
