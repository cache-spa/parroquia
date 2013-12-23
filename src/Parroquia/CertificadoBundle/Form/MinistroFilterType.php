<?php

namespace Parroquia\CertificadoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Lexik\Bundle\FormFilterBundle\Filter\Query\QueryInterface;

class MinistroFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('persona', 'filter_entity',array(                    
                        'label' => 'Persona',
                        'class' => 'ParroquiaComunidadBundle:Persona',
                        'property' => 'nombreRut'
                    ))
            ->add('vigencia', 'filter_choice',array(
                        'choices' => array('CADUCADO' => 'CADUCADO', 'VIGENTE' => 'VIGENTE'),
                        'label' => 'Vigencia',
                        'mapped' => false,
                        'apply_filter' => array($this,'vigenciaFieldCallback')
                    ))
            ->add('fecha_vigencia_termino', 'filter_date_range',array(
                        'label' => 'Término de vigencia entre',
                        'left_date_options' => array(
                                'widget' => 'single_text',
                                'format' => 'dd-MM-yyyy',
                                'attr' => array('class' => 'date filter-date-left')                            
                            ),
                        'right_date_options' => array(
                                'widget' => 'single_text',
                                'format' => 'dd-MM-yyyy',
                                'attr' => array('class' => 'date filter-date-right')
                            ),
                    ))                
            ;
    }

    public function getName()
    {
        return 'ministro_filter';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection'   => false,
            'validation_groups' => array('filtering') // avoid NotBlank() constraint-related message
        ));
    }
    
    public function vigenciaFieldCallback(QueryInterface $filterQuery, $field, $values)
    {
        if (!empty($values['value'])) {
            $qb = $filterQuery->getQueryBuilder();
            
            $today = new \DateTime("now");
            $today = $today->format('Y-m-d');
            
            $field = 'm.fecha_vigencia_termino';
            
            if($values['value'] == 'VIGENTE')
            {                
                $qb->andWhere($filterQuery->getExpr()->gte($field, $today ));
            }
            elseif($values['value'] == 'CADUCADO')
            {
                $qb->andWhere($filterQuery->getExpr()->lt($field, $today));
            }
        }
    }      
}
