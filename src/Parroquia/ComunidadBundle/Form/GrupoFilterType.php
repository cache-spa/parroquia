<?php

namespace Parroquia\ComunidadBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Lexik\Bundle\FormFilterBundle\Filter\Query\QueryInterface;

class GrupoFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre', 'filter_entity',array(
                'label' => 'Grupo',
                'class' => 'ParroquiaComunidadBundle:Grupo',
                'query_builder' => function(EntityRepository $er) {
                                        return $er->createQueryBuilder('g')
                                            ->orderBy('g.nombre', 'ASC');
                                            },
                'group_by' => 'padreNombre',
                'apply_filter' => array($this, 'nombreFieldCallback'),
                ))                
            ;
    }

    public function getName()
    {
        return 'grupo_filter';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'csrf_protection'   => false,
            'validation_groups' => array('filtering') // avoid NotBlank() constraint-related message
        ));
    }
    
    public function nombreFieldCallback(QueryInterface $filterQuery, $field, $values)
    {
        if (!empty($values['value'])) {
            $qb = $filterQuery->getQueryBuilder();
            $qb->andWhere($filterQuery->getExpr()->eq($field, "'".$values['value']."'"));
        }
    }    
}
