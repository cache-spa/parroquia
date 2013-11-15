<?php

namespace Parroquia\CertificadoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class BautizoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('persona',null,array('label' => 'Bautizado'))
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
            ->add('bautizos_padrinos','collection',array(
                        'label' => ' ',
                        'type' => new PadrinoType(),
                        'allow_add' => true,
                        'allow_delete' => true,
                        'by_reference' => false,
                        'required' => false,
                        'options' => array('data_class' => 'Parroquia\CertificadoBundle\Entity\BautizoPadrino')
                    ))
            ->add('bautizos_celebrantes','collection',array(
                        'label' => ' ',                
                        'type' => new CelebranteType(),
                        'allow_add' => true,
                        'allow_delete' => true,
                        'by_reference' => false,
                        'required' => false,                
                        'options' => array('data_class' => 'Parroquia\CertificadoBundle\Entity\BautizoCelebrante')
                    ))
            ->add('bautizos_catequistas','collection',array(
                        'label' => ' ',                
                        'type' => new CatequistaType(),
                        'allow_add' => true,
                        'allow_delete' => true,
                        'by_reference' => false,
                        'required' => false,                
                        'options' => array('data_class' => 'Parroquia\CertificadoBundle\Entity\BautizoCatequista')
                    ))                
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Parroquia\CertificadoBundle\Entity\Bautizo'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'parroquia_certificadobundle_bautizo';
    }
}
