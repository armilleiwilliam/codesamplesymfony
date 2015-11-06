<?php

namespace Casa\Front2Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PrezzoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('vendita', null, array(
                'label' => 'In vendita',
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    )
                ))
            ->add('prezzoVendita', null, array(
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    'icon' => 'money'
                    )
                ))
            ->add('affitto', null, array(
                'label' => 'In affitto',
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    )
                ))
            ->add('prezzoAffitto', null, array(
                'label' => 'Affitto mensile',
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    'icon' => 'money'
                    )
                ))
            ->add('trattabili', null, array(
                'label' => 'Prezzi trattabili',
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
            'data_class' => 'Casa\Front2Bundle\Entity\Prezzo'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'casa_corebundle_prezzo';
    }
}
