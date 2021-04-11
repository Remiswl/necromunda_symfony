<?php

namespace App\Form;

use App\Entity\Weapons;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\WeaponsCategories;

class WeaponsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('cost')
            ->add('category', EntityType::class, [
                'class' => WeaponsCategories::class,
                'choice_label' => 'name',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Weapons::class,
        ]);
    }
}
