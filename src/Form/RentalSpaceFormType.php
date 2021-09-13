<?php

namespace App\Form;

use App\Entity\City;
use App\Entity\RentalSpace;
use App\Entity\RentalSpaceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
 * Associating the form with RentalSpace entity
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
            ->add('rentalSpaceType', EntityType::class, [
                'label' => "Type d'espace locatif :",
                'placeholder' => "-- Choisir un type d'espace locatif --",
                'class' => RentalSpaceType::class,
                'choice_label' => 'designation',
                'constraints' => [
                    new NotBlank([
                        'message' => "Veuillez saisir un type d'espace locatif",
                    ])
                ]
            ])
            ->add('city', EntityType::class, [
                'label' => 'Ville :',
                'placeholder' => '-- Choisir une ville --',
                'class' => City::class,
                'choice_label' => 'name',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir une ville',
                    ])
                ]
            ])
            ->add('quantity', NumberType::class, [
                'label' => 'Quantité :',
                'required' => false,
                'attr' => [
                    'placeholder' => "Nombre d'espace(s)"
                ],
                'invalid_message' => 'Veuillez saisir un nombre'
            ])
            ->add('minimumDurationRule', NumberType::class, [
                'label' => 'Durée minimale :',
                'required' => false,
                'attr' => [
                    'placeholder' => "Nombre d'heure(s)"
                ],
                'invalid_message' => 'Veuillez saisir un nombre'
            ])
            ->add('maximumDurationRule', NumberType::class, [
                'label' => 'Durée maximale :',
                'required' => false,
                'attr' => [
                    'placeholder' => "Nombre d'heure(s)"
                ],
                'invalid_message' => 'Veuillez saisir un nombre'
            ])
            ->add('dayPrice', NumberType::class, [
                'label' => 'Tarif à la journée :',
                'required' => false,
                'attr' => [
                    'placeholder' => "€"
                ],
                'invalid_message' => 'Veuillez saisir un nombre'
            ])
            ->add('weekPrice', NumberType::class, [
                'label' => 'Tarif à la semaine :',
                'required' => false,
                'attr' => [
                    'placeholder' => "€"
                ],
                'invalid_message' => 'Veuillez saisir un nombre'
            ])
            ->add('weekendPrice', NumberType::class, [
                'label' => 'Tarif au week-end :',
                'required' => false,
                'attr' => [
                    'placeholder' => "€"
                ],
                'invalid_message' => 'Veuillez saisir un nombre'
            ])
            ->add('monthPrice', NumberType::class, [
                'label' => 'Tarif au mois :',
                'required' => false,
                'attr' => [
                    'placeholder' => "€"
                ],
                'invalid_message' => 'Veuillez saisir un nombre'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RentalSpace::class
        ]);
    }
}
