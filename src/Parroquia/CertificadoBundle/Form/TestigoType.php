<?php

namespace Parroquia\CertificadoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TestigoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('testigo',null,array('label' => ' '));
    }
    
    public function getName()
    {
        return 'testigo';
    }
}
