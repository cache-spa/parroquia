<?php

namespace Parroquia\ComunidadBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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
            ->add('apellido_p')
            ->add('apellido_m')
            ->add('rut')
            ->add('sexo','choice',array(
                        'choices' => array('M' => 'Masculino', 'F' => 'Femenino'),
                        'required' => false,
                    ))
            ->add('fecha_nacimiento','birthday',array(
                        'widget' => 'single_text',
                        'format' => 'dd-MM-yyyy',
                        'required' => false,
                        'attr' => array('class' => 'date')
                    ))
            ->add('padre')
            ->add('madre')
            ->add('telefono')
            ->add('celular')
            ->add('email')
            ->add('direccion')
            ->add('estado_civil','choice',array(
                        'choices' => array('Soltero'=>'Soltero','Casado'=>'Casado','Divorciado'=>'Divorciado','Viudo'=>'Viudo'),
                        'required' => false
                    ))
            ->add('categorias','entity',array(
                      'class'    => 'ParroquiaComunidadBundle:Categoria' ,
                      'expanded' => true ,
                      'multiple' => true , 
                    ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Parroquia\ComunidadBundle\Entity\Persona'
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
