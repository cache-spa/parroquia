<?php

namespace Parroquia\ComunidadBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Parroquia\ComunidadBundle\Form\EventListener\AddPadreFieldSubscriber;
use Doctrine\ORM\EntityRepository;

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
                      'class'    => 'ParroquiaComunidadBundle:Persona',
                      'query_builder' => function(EntityRepository $er) {
                          return $er->createQueryBuilder('p')
                              ->orderBy('p.apellido_p', 'ASC')
                              ->orderBy('p.apellido_m', 'ASC')                                    
                              ->orderBy('p.nombres', 'ASC');
                      },
                      'expanded' => false ,
                      'multiple' => true ,
                      'required' => false,
                      'property' => 'nombreRut'
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
