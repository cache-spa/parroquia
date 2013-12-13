<?php

namespace Parroquia\ComunidadBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Lexik\Bundle\FormFilterBundle\Filter\FilterOperands;

class PersonaFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombres', 'filter_text',array(
                'condition_pattern' => FilterOperands::STRING_BOTH
                ))
            ->add('apellido_p', 'filter_text',array(
                'label' => 'Apellido Paterno',
                'condition_pattern' => FilterOperands::STRING_BOTH
                ))
            ->add('apellido_m', 'filter_text',array(
                'label' => 'Apellido Materno',
                'condition_pattern' => FilterOperands::STRING_BOTH
                ))                
            ;
    }

    public function getName()
    {
        return 'persona_filter';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection'   => false,
            'validation_groups' => array('filtering') // avoid NotBlank() constraint-related message
        ));
    }
}
