<?php

namespace Parroquia\CertificadoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

class CatequistaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('catequista',null,array('label' => ' ', 
                    'class' => 'ParroquiaComunidadBundle:Persona',
                    'query_builder' => function(EntityRepository $er) {
                        return $er->createQueryBuilder('p')
                            ->orderBy('p.apellido_p', 'ASC')
                            ->addOrderBy('p.apellido_m', 'ASC')                                    
                            ->addOrderBy('p.nombres', 'ASC');
                    },
                    'property' => 'nombreRut'));
    }
    
    public function getName()
    {
        return 'catequista';
    }
}
