<?php

namespace Parroquia\CorreoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class MensajeType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('destinatarios','entity',array(
                        'class' => 'ParroquiaComunidadBundle:Persona',
                        'query_builder' => function(EntityRepository $er) {
                            return $er->createQueryBuilder('p')
                                ->orderBy('p.apellido_p', 'ASC')
                                ->addOrderBy('p.apellido_m', 'ASC')                                    
                                ->addOrderBy('p.nombres', 'ASC');
                        },
                      'expanded' => false ,
                      'multiple' => true ,
                      'required' => false,
                      'property' => 'nombreRut'
                    ))
            ->add('grupos','entity',array(
                      'class' => 'ParroquiaComunidadBundle:Grupo',
                      'expanded' => false ,
                      'multiple' => true ,
                      'required' => false,
                    ))
            ->add('asunto')
            ->add('cuerpo',null,array(
                        'attr' => array('class' => 'tinymce', 'data-theme' => 'advanced')
                    ))
            ->add('adjuntos','collection',array(
                        'label' => ' ',                
                        'type' => new AdjuntoType(),
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
            'data_class' => 'Parroquia\CorreoBundle\Entity\Mensaje',
            'cascade_validation' => true
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'parroquia_correobundle_mensaje';
    }
}
