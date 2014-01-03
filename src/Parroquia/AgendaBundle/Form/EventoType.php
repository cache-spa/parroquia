<?php

namespace Parroquia\AgendaBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EventoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('inicio',null,array(
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy HH:mm',
                    'with_seconds' => false,
                    'attr' => array('class' => 'datetime')                
                ))
            ->add('termino',null,array(
                    'label' => 'Término',
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy HH:mm',
                    'with_seconds' => false,
                    'attr' => array('class' => 'datetime')                
                ))
            ->add('todo_el_dia',null,array(
                    'label' => '¿Todo el día?',
                    'required' => false
                ))
            ->add('lugar')
            ->add('descripcion',null,array(
                    'label' => 'Descripción',
                ))
            ->add('liturgico',null,array(
                    'label' => '¿Es litúrgico?',
                    'required'=>false
                ))
            ->add('color')
            ->add('archivos','collection',array(
                        'label' => ' ',                
                        'type' => new ArchivoType(),
                        'allow_add' => true,
                        'allow_delete' => true,
                        'by_reference' => false,
                        'required' => false,
                    ))
            ->add('imagenes','collection',array(
                        'label' => ' ',                
                        'type' => new ImagenType(),
                        'allow_add' => true,
                        'allow_delete' => true,
                        'by_reference' => false,
                        'required' => false,
                    ))                
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Parroquia\AgendaBundle\Entity\Evento',
            'cascade_validation' => true
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'parroquia_agendabundle_evento';
    }
}
