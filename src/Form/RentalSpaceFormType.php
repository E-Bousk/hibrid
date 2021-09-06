<?php

namespace App\Form;

use App\Entity\RentalSpace;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

/**
 * Class RentalSpaceFormType | file RentalSpaceFormType.php
 *
 * This class is used to create form for the rental space management page
 * In this class, we have methods for :
 *
 * Building the form to send it to view
 * Associating the form with an entity
 * 
 */
class RentalSpaceFormType extends AbstractType
{
    /**
     * build the form : add label, constraints, placeholder etc...
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('rentalSpaceType', null, [
                'label' => "Type d'espace locatif :",
                'constraints' => [
                    new NotBlank([
                        'message' => "Veuillez saisir un type d'espace locatif",
                    ])
                ]
            ])
            ->add('city', null, [
                'label' => 'Ville :',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir une ville',
                    ])
                ]
            ])
            ->add('quantity', NumberType::class, [
                'label' => 'Quantité :',
            ])
            ->add('minimumDurationRule', NumberType::class, [
                'label' => 'Durée minimale :',
                'attr' => [
                    'placeholder' => "Nombre d'heure(s)"
                ],
            ])
            ->add('maximumDurationRule', NumberType::class, [
                'label' => 'Durée maximale :',
                'attr' => [
                    'placeholder' => "Nombre d'heure(s)"
                ],
            ])
            ->add('dayPrice', NumberType::class, [
                'label' => 'Tarif à la journée :',
                'attr' => [
                    'placeholder' => "€"
                ],
            ])
            ->add('weekPrice', NumberType::class, [
                'label' => 'Tarif à la semaine :',
                'attr' => [
                    'placeholder' => "€"
                ],
            ])
            ->add('weekendPrice', NumberType::class, [
                'label' => 'Tarif au week-end :',
                'attr' => [
                    'placeholder' => "€"
                ],
            ])
            ->add('monthPrice', NumberType::class, [
                'label' => 'Tarif au mois :',
                'attr' => [
                    'placeholder' => "€"
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RentalSpace::class,
        ]);
    }
}
