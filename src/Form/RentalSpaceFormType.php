<?php

namespace App\Form;

use App\Entity\RentalSpace;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RentalSpaceFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantity')
            ->add('minimumDurationRule')
            ->add('maximumDurationRule')
            ->add('dayPrice')
            ->add('weekPrice')
            ->add('weekendPrice')
            ->add('monthPrice')
            ->add('rentalSpaceType')
            ->add('city')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RentalSpace::class,
        ]);
    }
}
