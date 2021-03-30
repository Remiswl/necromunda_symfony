<?php

namespace App\Form;

use App\Entity\MyGangers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MyGangersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('typeId')
            //->add('gangId')
            //->add('credits')
            ->add('move')
            ->add('weaponSkill')
            ->add('ballisticSkill')
            ->add('strength')
            ->add('toughness')
            ->add('wounds')
            ->add('initiative')
            ->add('attacks')
            ->add('leadership')
            ->add('cool')
            ->add('willpower')
            ->add('intelligence')
            ->add('cost')
            ->add('adv')
            ->add('xp')
            ->add('image')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MyGangers::class,
        ]);
    }
}
