<?php

namespace Casa\Front2Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContattoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome', null, array(
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    'icon' => 'user'
                    )
                ))
            ->add('cognome', null, array(
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    'icon' => 'user'
                    )
                ))
            ->add('email', null, array(
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    'icon' => 'envelope-o'
                    )
                ))
            ->add('telefono', null, array(
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    'icon' => 'phone'
                    )
                ))
            ->add('indirizzo', null, array(
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    'icon' => 'font'
                    )
                ))
            ->add('citta', null, array(
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    'icon' => 'font'
                    )
                ))
            ->add('dataNascita', 'birthday', array(
                'required' => false,
                'widget' => 'single_text',
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    ''
                    )
                ))
            ->add('cliente', 'hidden')
            ->add('proprietario', 'hidden')
            ->add('note', null, array(
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    )
                ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Casa\Front2Bundle\Entity\Contatto'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'contatto';
    }
}
