<?php

namespace App\Form;

use App\Entity\Injuries;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InjuriesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mind66', null, ['label' => 'min D66'])
            ->add('maxd66', null, ['label' => 'max D66'])
            ->add('description')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Injuries::class,
        ]);
    }
}
