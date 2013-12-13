<?php

namespace Parroquia\CorreoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Lexik\Bundle\FormFilterBundle\Filter\Query\QueryInterface;

class MensajeFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('emisor', 'filter_entity',array(                    
                        'label' => 'Emisor',
                        'class' => 'ParroquiaComunidadBundle:Persona', //debería ser Usuario
                        'property' => 'nombreRut'
                    ))
            ->add('fecha_envio', 'filter_date_range',array(
                        'left_date_options' => array(
                                'label' => 'Fecha de Emisión (desde)',
                                'widget' => 'single_text',
                                'format' => 'dd-MM-yyyy',
                                'attr' => array('class' => 'date')
                            ),
                        'right_date_options' => array(
                                'label' => 'Fecha de Emisión (hasta)',
                                'widget' => 'single_text',
                                'format' => 'dd-MM-yyyy',                                
                                'attr' => array('class' => 'date'),                                
                            ),
                        'label' => 'Fecha de Envío',
                        'apply_filter' => array($this,'fecha_envioFieldCallback')
                    ))
            ;
    }

    public function getName()
    {
        return 'mensaje_filter';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection'   => false,
            'validation_groups' => array('filtering') // avoid NotBlank() constraint-related message
        ));
    }

    public function fecha_envioFieldCallback(QueryInterface $filterQuery, $field, $values)
    {
        if (!empty($values['value']['right_date'][0])) {
            $qb = $filterQuery->getQueryBuilder();
            $qb->andWhere($filterQuery->getExpr()->lte($field,"'".$values['value']['right_date'][0]->format('Y-m-d').' 23:59:59'."'"));
        }
        
        if (!empty($values['value']['left_date'][0])) {
            $qb = $filterQuery->getQueryBuilder();
            $qb->andWhere($filterQuery->getExpr()->gte($field,"'".$values['value']['left_date'][0]->format('Y-m-d').' 00:00:00'."'"));
        }
        
    }    
    
}

