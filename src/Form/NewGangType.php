<?php

namespace App\Form;

use App\Entity\Gangs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Controller\RecruitmentController;


class NewGangType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pseudo')
            ->add('gang_name')
            ->add('houseId', ChoiceType::class, [
                'choices' => $this->getHouse()
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Gangs::class,
        ]);
    }

    private function getHouse()
    {
        $types = RecruitmentController::HOUSES;
        $output = [];

        foreach($types as $k => $v) {
            $output[$v] = $k;
        }

        return $output;
    }
}
