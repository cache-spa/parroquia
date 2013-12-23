<?php

namespace Parroquia\CertificadoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MinistroType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('persona')                
            ->add('fecha_curso_inicio',null,array(
                    'label' => 'Inicio Curso',
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy',
                    'required' => true,
                    'attr' => array('class' => 'date')                
                ))
            ->add('fecha_curso_termino',null,array(
                    'label' => 'Término Curso',
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy',
                    'required' => true,
                    'attr' => array('class' => 'date')                
                ))
            ->add('fecha_vigencia_inicio',null,array(
                    'label' => 'Inicio Vigencia',
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy',
                    'required' => true,
                    'attr' => array('class' => 'date')                
                ))
            ->add('fecha_vigencia_termino',null,array(
                    'label' => 'Término Vigencia',
                    'widget' => 'single_text',
                    'format' => 'dd-MM-yyyy',
                    'required' => true,
                    'attr' => array('class' => 'date')                
                ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Parroquia\CertificadoBundle\Entity\Ministro'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'parroquia_certificadobundle_ministro';
    }
}
