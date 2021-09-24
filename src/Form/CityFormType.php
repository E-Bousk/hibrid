<?php

namespace App\Form;

use App\Entity\City;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

/**
 * Class CityFormType | file CityFormType.php
 *
 * This class is used to create form for the city page
 * In this class, we have methods for :
 *
 * Building the form to send it to view
 * Associating the form with City entity
 * 
 */
class CityFormType extends AbstractType
{
    /**
     * build the form : add label, placeholder etc...
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Ville :',
                'attr' => [
                    'placeholder' => 'Moulinsart',
                ],
            ])
            ->add('postalCode', NumberType::class, [
                'label' => 'Code postal :',
                'attr' => [
                    'placeholder' => '12345'
                ],
                'invalid_message' => 'Veuillez saisir un code postal (chiffre)'
            ]);
    }

    /**
     * Associate with CITY entity
     *
     * @param OptionsResolver $resolver
     * @return void
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => City::class
        ]);
    }
}
