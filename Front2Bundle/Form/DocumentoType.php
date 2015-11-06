<?php

namespace Casa\Front2Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DocumentoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', 'file', array(
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    'icon' => 'file-o'
                    )
                ))
            ->add('note', null, array(
                'attr' => array(
                    'class' => 'form-control', 
                    )
                ))
            ->add('contratto', 'hidden', array(
                'attr' => array(
                    'class' => 'form-control', 
                    )
                ))
            ->add('tipo', 'hidden', array(
                'attr' => array(
                    'class' => 'form-control', 
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
            'data_class' => 'Casa\Front2Bundle\Entity\Documento'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'casa_corebundle_documento';
    }
}
