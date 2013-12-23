<?php

namespace Parroquia\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Parroquia\UserBundle\Form\EventListener\AddPasswordFieldSubscriber;

class UserType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',null,array('label' => 'Nombre de Usuario'))
            ->add('email',null,array('label' => 'E-mail'))
            ->add('enabled',null,array(
                    'required' => false,
                    'label' => 'Habilitado'
                ))
            ->add('locked',null,array(
                    'required' => false,
                    'label' => 'Bloqueado'
                ))
            ->add('admin', 'checkbox', array(
                    'label'     => '¿Administrador?',
                    'required'  => false,                    
                ))             
            ->add('persona',null,array('property'=> 'nombreRut'))
        ;
        
        $builder->addEventSubscriber(new AddPasswordFieldSubscriber());
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Parroquia\UserBundle\Entity\User'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'parroquia_userbundle_user';
    }
}
