<?php

namespace Parroquia\CertificadoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MatrimonioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {        
        $builder
            ->add('conyuge1',null,array(
                        'label' => 'Cónyuge 1',
                        'property' => 'nombreRut'
                    ))
            ->add('conyuge2',null,array(
                        'label' => 'Cónyuge 2',
                        'property' => 'nombreRut'
                    ))                
            ->add('libro')
            ->add('hoja')
            ->add('inscripcion')
            ->add('lugar')
            ->add('fecha',null,array(
                        'widget' => 'single_text',
                        'format' => 'dd-MM-yyyy',
                        'required' => false,
                        'attr' => array('class' => 'date')
                    ))            ->add('notas')
            ->add('inscripcion_civil')
            ->add('fecha_civil',null,array(
                        'widget' => 'single_text',
                        'format' => 'dd-MM-yyyy',
                        'required' => false,
                        'attr' => array('class' => 'date')
                    ))                        
            ->add('matrimonios_padrinos','collection',array(
                        'label' => ' ',
                        'type' => new PadrinoType(),
                        'allow_add' => true,
                        'allow_delete' => true,
                        'by_reference' => false,
                        'required' => false,
                        'prototype_name' => '__padrinosname__',
                        'options' => array('data_class' => 'Parroquia\CertificadoBundle\Entity\MatrimonioPadrino')
                    ))
            ->add('matrimonios_celebrantes','collection',array(
                        'label' => ' ',                
                        'type' => new CelebranteType(),
                        'allow_add' => true,
                        'allow_delete' => true,
                        'by_reference' => false,
                        'required' => false,    
                        'prototype_name' => '__celebrantesname__',                
                        'options' => array('data_class' => 'Parroquia\CertificadoBundle\Entity\MatrimonioCelebrante')
                    ))
            ->add('matrimonios_catequistas','collection',array(
                        'label' => ' ',                
                        'type' => new CatequistaType(),
                        'allow_add' => true,
                        'allow_delete' => true,
                        'by_reference' => false,
                        'required' => false,
                        'prototype_name' => '__catequistasname__',
                        'options' => array('data_class' => 'Parroquia\CertificadoBundle\Entity\MatrimonioCatequista')
                    ))
            ->add('matrimonios_testigos','collection',array(
                        'label' => ' ',                
                        'type' => new TestigoType(),
                        'allow_add' => true,
                        'allow_delete' => true,
                        'by_reference' => false,
                        'required' => false, 
                        'prototype_name' => '__testigosname__',                
                        'options' => array('data_class' => 'Parroquia\CertificadoBundle\Entity\MatrimonioTestigo')
                    ))
            ->add('notas')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Parroquia\CertificadoBundle\Entity\Matrimonio',
            'cascade_validation' => true            
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'parroquia_certificadobundle_matrimonio';
    }
}
