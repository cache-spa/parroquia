<?php

namespace Parroquia\ComunidadBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Parroquia\ComunidadBundle\Form\EventListener\AddPadreFieldSubscriber;

class GrupoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('personas','entity',array(
                      'class'    => 'ParroquiaComunidadBundle:Persona' ,
                      'expanded' => false ,
                      'multiple' => true ,
                      'required' => false
                    ))
        ;
        $builder->addEventSubscriber(new AddPadreFieldSubscriber());
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Parroquia\ComunidadBundle\Entity\Grupo'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'parroquia_comunidadbundle_grupo';
    }
}
