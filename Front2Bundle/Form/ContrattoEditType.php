<?php

namespace Casa\Front2Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ContrattoEditType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('esclusivita', null, array(
                    'label' => 'In esclusiva',
                    'attr' => array(
                        'class' => 'form-control',
                    )
                ))
                ->add('pullicazioneFoto', null, array(
                    'label' => 'Pubblica foto',
                    'attr' => array(
                        'class' => 'form-control',
                    )
                ))
                ->add('collaborazioni', null, array(
                    'label' => 'Collaborazioni',
                    'attr' => array(
                        'class' => 'form-control',
                    )
                ))
                ->add('prezzi', 'collection', array(
                    'label' => 'RICHIESTA ECONOMICA',
                    'type' => new PrezzoType())
                )
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Casa\Front2Bundle\Entity\Contratto'
        ));
    }

    /**
     * @return string
     */
    public function getName() {
        return 'casa_corebundle_contratto';
    }

}
