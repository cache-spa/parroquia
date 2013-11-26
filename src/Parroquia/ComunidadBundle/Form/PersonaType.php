<?php

namespace Parroquia\ComunidadBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Parroquia\CertificadoBundle\Form\BautizoType;
use Parroquia\CertificadoBundle\Form\ConfirmacionType;
use Parroquia\CertificadoBundle\Form\MatrimonioConyugeType;

class PersonaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombres')
            ->add('apellido_p',null,array('label' => 'Apellido Paterno'))
            ->add('apellido_m',null,array('label' => 'Apellido Materno'))
            ->add('sexo','choice',array(
                        'choices' => array('M' => 'Masculino', 'F' => 'Femenino'),
                        'required' => true,
                    ))
            ->add('rut')                
            ->add('fecha_nacimiento','birthday',array(
                        'label' => 'Fecha de Nacimiento',
                        'widget' => 'single_text',
                        'format' => 'dd-MM-yyyy',
                        'required' => false,
                        'attr' => array('class' => 'date')
                    ))
            ->add('padre','entity',array(
                        'class'    => 'ParroquiaComunidadBundle:Persona',
                        'required' => false,
                        'query_builder' => function(EntityRepository $er) {
                            return $er->createQueryBuilder('p')
                                        ->where('p.sexo = :s')
                                        ->setParameter('s',"m");
                            },
                        'property' => 'nombreRut'
                    ))
            ->add('madre','entity',array(
                        'class'    => 'ParroquiaComunidadBundle:Persona',
                        'required' => false,
                        'query_builder' => function(EntityRepository $er) {
                            return $er->createQueryBuilder('p')
                                        ->where('p.sexo = :s')
                                        ->setParameter('s',"f");
                            },
                        'property' => 'nombreRut'
                    ))
            ->add('telefono',null,array('label' => 'Teléfono'))
            ->add('celular')
            ->add('email')
            ->add('direccion',null,array('label' => 'Dirección'))
            ->add('estado_civil','choice',array(
                        'label' => 'Estado Civil',
                        'choices' => array('Soltero'=>'Soltero','Casado'=>'Casado','Divorciado'=>'Divorciado','Viudo'=>'Viudo'),
                        'required' => false
                    ))
            ->add('grupos','entity',array(
                        'label' => 'Grupos',
                        'class'    => 'ParroquiaComunidadBundle:Grupo' ,
                        'expanded' => true ,
                        'multiple' => true ,
                        'required' => false
                    ))
             ->add('bautizo', new BautizoType())
             ->add('confirmacion', new ConfirmacionType())
             ->add('matrimonios','collection',array(
                        'label' => ' ',                
                        'type' => new MatrimonioConyugeType(),
                        'allow_add' => true,
                        'allow_delete' => true,
                        'by_reference' => false,
                        'required' => false,
                        'options' => array('data_class' => 'Parroquia\CertificadoBundle\Entity\Matrimonio')
                    ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Parroquia\ComunidadBundle\Entity\Persona',
            'cascade_validation' => true
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'parroquia_comunidadbundle_persona';
    }
}
