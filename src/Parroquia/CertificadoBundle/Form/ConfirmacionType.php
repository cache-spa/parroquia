<?php

namespace Parroquia\CertificadoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ConfirmacionType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('persona',null,array('label' => 'Confirmado'))
            ->add('libro')
            ->add('hoja')
            ->add('inscripcion')
            ->add('lugar')
            ->add('fecha',null,array(
                        'widget' => 'single_text',
                        'format' => 'dd-MM-yyyy',
                        'required' => false,
                        'attr' => array('class' => 'date')
                    ))            
            ->add('notas')
            ->add('confirmaciones_padrinos','collection',array(
                        'label' => ' ',
                        'type' => new PadrinoType(),
                        'allow_add' => true,
                        'allow_delete' => true,
                        'by_reference' => false,
                        'required' => false,
                        'options' => array('data_class' => 'Parroquia\CertificadoBundle\Entity\ConfirmacionPadrino')
                    ))
            ->add('confirmaciones_celebrantes','collection',array(
                        'label' => ' ',                
                        'type' => new CelebranteType(),
                        'allow_add' => true,
                        'allow_delete' => true,
                        'by_reference' => false,
                        'required' => false,                
                        'options' => array('data_class' => 'Parroquia\CertificadoBundle\Entity\ConfirmacionCelebrante')
                    ))
            ->add('confirmaciones_catequistas','collection',array(
                        'label' => ' ',                
                        'type' => new CatequistaType(),
                        'allow_add' => true,
                        'allow_delete' => true,
                        'by_reference' => false,
                        'required' => false,                
                        'options' => array('data_class' => 'Parroquia\CertificadoBundle\Entity\ConfirmacionCatequista')
                    ))                 
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Parroquia\CertificadoBundle\Entity\Confirmacion'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'parroquia_certificadobundle_confirmacion';
    }
}
