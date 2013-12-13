<?php

namespace Parroquia\CertificadoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CertificadoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tipo','choice',array(
                        'choices' => array('Bautizo' => 'Bautizo', 'Confirmación' => 'Confirmación', 'Matrimonio' => 'Matrimonio'),
                        'required' => true,
                        'label' => 'Tipo de Certificado'
                    ))
            ->add('persona',null,array(
                        'label' => 'Nombre de la Persona',
                        'property' => 'nombreRut'
                    ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Parroquia\CertificadoBundle\Entity\Certificado'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'parroquia_certificadobundle_certificado';
    }
}
