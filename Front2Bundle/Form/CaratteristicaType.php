<?php

namespace Casa\Front2Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CaratteristicaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('caratteristica', null, array(
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    'icon' => 'font'
                    )
                ))
            ->add('tipo', 'choice', array(
                'choices' => array(
                    'text' => 'Testo',
                    'textarea' => 'Testo lungo',
                    'number' => 'Numero',
                    'select' => 'Scelta unica',
                    'checkbox' => 'Scelta multipla',
                    'boolean' => 'Sì/No',
                    'file' => 'Allegato',
                ),
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    )
                ))
            ->add('uumm', null, array(
                'label' => 'Unità di misura',
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    )
                ))
            ->add('multiriga', null, array(
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    )
                ))
            ->add('params', 'textarea', array(
                'required' => false,
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    )
                ))
            ->add('js', null, array(
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    )
                ))
            ->add('idTagPattern', null, array(
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    'icon' => 'font'
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
            'data_class' => 'Casa\Front2Bundle\Entity\Caratteristica'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'casa_corebundle_caratteristica';
    }
}
