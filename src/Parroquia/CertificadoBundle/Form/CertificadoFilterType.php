<?php

namespace Parroquia\CertificadoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Lexik\Bundle\FormFilterBundle\Filter\Query\QueryInterface;

class CertificadoFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tipo', 'filter_choice',array(
                        'choices' => array('Bautizo' => 'Bautizo', 'Confirmación' => 'Confirmación', 'Matrimonio' => 'Matrimonio'),
                        'label' => 'Tipo de Certificado'
                    ))
            ->add('fecha_emision', 'filter_date',array(
                        'label' => 'Fecha de Emisión',
                        'widget' => 'single_text',
                        'format' => 'dd-MM-yyyy',
                        'attr' => array('class' => 'date'),
                        'apply_filter' => array($this,'fecha_emisionFieldCallback')
                    ))
            ->add('emisor', 'filter_entity',array(                    
                        'label' => 'Emitido por',
                        'class' => 'ParroquiaComunidadBundle:Persona', //debería ser Usuario
                        'property' => 'nombreRut'
                    ))
            ;
    }

    public function getName()
    {
        return 'certificado_filter';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection'   => false,
            'validation_groups' => array('filtering') // avoid NotBlank() constraint-related message
        ));
    }
     
    public function fecha_emisionFieldCallback(QueryInterface $filterQuery, $field, $values)
    {
        if (!empty($values['value'])) {
            $qb = $filterQuery->getQueryBuilder();
            $qb->andWhere($filterQuery->getExpr()->between($field, "'".$values['value']->format('Y-m-d').' 00:00:00'."'", "'".$values['value']->format('Y-m-d').' 23:59:59'."'"));
        }
    }
}

