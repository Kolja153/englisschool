<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LessonsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
             ->add('title', null, array(
                'required' => true,
                'label' => 'Назва уроку'
            ))
             ->add('content', 'ckeditor', array(
                'required' => false,
                'label' => ' '
            ))
            ->add('coursesId', null, array(
                'required' => false,
                'label' => 'Курс'
            ))
            ->add('isActive', null, array(
                'required' => false,
                'label' => 'На сайті'
            ))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\Lessons'
        ));
    }
}
