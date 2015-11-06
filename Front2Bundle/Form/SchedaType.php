<?php

namespace Casa\Front2Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Casa\Front2Bundle\Form\ContrattoType;

class SchedaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tipologia', null, array(
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    )
                ))
            ->add('indirizzo', null, array(
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    'icon' => 'font'
                    )
                ))
            ->add('localita', null, array(
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    'icon' => 'font'
                    )
                ))
            ->add('locali', 'integer', array(
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    'icon' => 'font'
                    )
                ))
            ->add('cap', null, array(
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    'icon' => 'font'
                    )
                ))
            ->add('descrizione', null, array(
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    )
                ))
            ->add('difformita', null, array(
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    )
                ))
            ->add('asta', 'checkbox', array(
                    'label' => 'Asta pubblica',
                    'attr' => array(
                        'class' => 'form-control',
                    ),
                    'required' => false,
                ))
            ->add('lat', 'hidden', array(
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    )
                ))
            ->add('lon', 'hidden', array(
                'attr' => array(
                    'class' => 'form-control', 
                    'placeholder' => "",
                    )
                ))
            ->add('contratti','collection', array(
                    'type' => new ContrattoType(),
                'allow_add'    => true,))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Casa\Front2Bundle\Entity\Scheda'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'casa_corebundle_scheda';
    }
}
