<?php

namespace Casa\Front2Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DocumentoTipoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('gruppo', null, array(
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    )
                ))
            ->add('tipo', null, array(
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    'icon' => 'font'
                    )
                ))
            ->add('reperibilita', null, array(
                'label' => 'Con reperibilità',
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    )
                ))
            ->add('consegnare', null, array(
                'label' => 'Da consegnare',
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
            'data_class' => 'Casa\Front2Bundle\Entity\DocumentoTipo'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'casa_corebundle_documentotipo';
    }
}
