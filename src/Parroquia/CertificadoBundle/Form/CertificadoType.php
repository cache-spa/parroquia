<?php

namespace Parroquia\CertificadoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;

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
                        'class' => 'ParroquiaComunidadBundle:Persona',
                        'query_builder' => function(EntityRepository $er) {
                            return $er->createQueryBuilder('p')
                                ->orderBy('p.apellido_p', 'ASC')
                                ->addOrderBy('p.apellido_m', 'ASC')                                    
                                ->addOrderBy('p.nombres', 'ASC');
                        },                
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
